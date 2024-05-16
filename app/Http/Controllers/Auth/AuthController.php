<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\SystemSetting;
use Auth,Hash,Session,Route;
use \Mail;
use Config;

class AuthController extends Controller
{
   public function __construct()
    {
        $this->guard = explode('.',Route::currentRouteName())[0];

        $this->middleware('guest:'.$this->guard, ['except' => ['logout','login']]);
    }

    public function showLoginForm()
    {

        if($this->guard == 'admin')
            return view('auth.admin.login');

        return view('auth.login',['guard' => $this->guard]);
    }

    public function login(Request $request)
    {

       // dd(auth()->guard());
       // Validate the form data
       $this->validate($request, [
        'email'   => 'required|email',
        'password' => 'required'
      ]);


      $verification_condations = [ 'is_verified' => '1', 'status' => '1' ];
    //  dd($request->all());
      // Attempt to log the user in
      if (Auth::guard($this->guard)->attempt(array_merge(['email' => $request->email, 'password' => $request->password], $verification_condations), $request->remember)) {
            // if successful, then redirect to their intended location
            return redirect()->intended(route($this->guard.'.dashboard.index'));
            // return redirect()->intended(route($this->guard.'.dashboard.index'));
      }

      // if unsuccessful, then redirect back to the login with the form data
      return redirect()->back()
        ->with('error', 'Wrong Credentials or you are deactivated !')
        ->withInput($request->only('email', 'remember'));
    }


    public function showResetForm()
    {
      if($this->guard == 'admin')
            return view('auth.admin.reset');
        return view('auth.reset',['guard' => $this->guard]);
    }


    public function showChangePasswordForm(Request $request)
    {
        $user = Auth::guard($this->guard)->getProvider()->getModel()::where(['reset_token' => $request->token])->first();

        if($user){
          if($this->guard == 'admin')
              return view('auth.admin.change-password',['token' => $request->token]);

            return view('auth.change-password',['token' => $request->token,'guard' => $this->guard]);
        }else{

            Session::flash('error','Please, try again!!');
            return redirect()->back();
        }

    }

    public function storeNewPassword(Request $request)
    {
      $request->validate([
        'password' => 'required|confirmed|min:6'
      ]);

      $user = Auth::guard($this->guard)->getProvider()->getModel()::where(['reset_token' => $request->token])->first();
      $user->password = Hash::make($request->password);
      $user->update();
      Session::flash('success','Password is Changed Successfully!');
      return redirect()->route($this->guard.'.login');
    }


    public function sendmail(Request $request)
    {
        if($this->guard == 'admin')
          $request->validate([
            'email' => 'required|email|exists:users,email'
          ]);
        else
          $request->validate([
            'email' => 'required|email|exists:'.$this->guard.'s,email'
          ]);

        $token = str_replace('/', '', \Hash::make(substr(str_shuffle('abcdefghijklmnopqrstuvwxyz0123456789'),0,6)));;
        $result = Auth::guard($this->guard)->getProvider()->getModel()::where('email',$request->email)->first();
        if(!$result){
          \Session::flash('error',"Email address doesn't exists.");
          return redirect()->back();
        }

        $result->reset_token = $token;
        $result->update();

        $system_info = SystemSetting::orderBy('id','desc')->first();
        $subject = 'Confim Email For Reset Password';
        $to = $request->email;
        $email = $system_info->email;
        $name = $system_info->name;

        Mail::send('emails.reset_email',['token' => $token,'guard' => $this->guard],
                  function ($message) use ($to,$email,$name,$subject){
                      $message->from($email,$name);
                      $message->to($to)->subject($subject);
             });
        \Session::flash('status','A fresh verification link has been sent to your email address.');
        return redirect()->back();
    }

    public function logout()
    {
        Auth::guard($this->guard)->logout();
        return redirect()->route($this->guard.'.login');
    }
}
