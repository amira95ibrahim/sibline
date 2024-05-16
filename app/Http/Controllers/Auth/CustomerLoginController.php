<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Address;
use App\Models\Customer;
use Auth,Hash,Session,Route;
use \Mail;
use App\Models\SystemSetting;
use Config;


class CustomerLoginController extends Controller
{

    public function __construct()
    {
      $this->middleware('guest:customer', ['except' => ['logout']]);
    }

    public function showRegisterForm()
    {
      return view('auth.register');
    }

    public function register(Request $request)
    {

      // Validate the form data
      $customer = $this->validate($request, [
        'email'   => 'required|email|unique:customers,email,NULL,NULL,deleted_at,NULL',
        'first_name' => 'required|string',
        'last_name' => 'required|string',
        'day' => 'required|integer',
        'month' => 'required|integer',
        'year' => 'required|integer',
        'country_code' => 'required',
        'phone' => 'required',
        'country_id' => ['required','exists:countries,id'],
        'city_id' => ['required','exists:countries,id'],
        'password' => 'required|min:6',
        'password_confirmation' => 'required_with:password|same:password|min:6'
      ]);

      $customer['password'] = \Hash::make($request->password);
      $customer['name'] = $request->first_name.' '.$request->last_name;
      $customer['phone'] = $request->country_code.$request->phone;
      $customer['mobile'] = $request->country_code.$request->phone;
      $customer['birth_date'] = $request->year.'-'.$request->month.'-'.$request->day;
      $customer['image'] = "avater.jpg";
      $customer['status'] = "1";
      $customer['is_verified'] = "0";

      $address = Address::create($customer);

      $customer = Customer::create($customer);

      $customer->address()->associate($address);

      $customer->save();

      $token = str_replace('/', '', \Hash::make(substr(str_shuffle('abcdefghijklmnopqrstuvwxyz0123456789'),0,6)));;

      $customer->reset_token = $token;
      $customer->update();

      $system_info = SystemSetting::orderBy('id','desc')->first();
      $subject = 'Confim Email For Verification';
      $to = $customer->email;
      $email = $system_info->email;
      $name = $system_info->name;

      Mail::send('emails.confirm_email',['token' => $token,'name' => $customer->name], 
                function ($message) use ($to,$email,$name,$subject){
                    $message->from($email,$name);
                    $message->to($to)->subject($subject);
                }
      );

      \Session::flash('status','A fresh verification link has been sent to your email address.');
      return redirect()->back();
      
    }


    public function Activate(Request $request)
    { 
        $user = Customer::where(['reset_token' => $request->token])->first();
        
        

        if($user){

          $user->is_verified = '1';

          $user->update();

          return redirect()->route('customer.login');
          
        }else{
            
            Session::flash('error','Please, try again!!');
            return redirect()->back(); 
        }
        
    }
}
