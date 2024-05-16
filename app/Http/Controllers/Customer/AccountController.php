<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\SystemMailContent;
use Illuminate\Http\Request;
use App\Models\ProjectAccounts;
use App\DataTables\Customer\ProjectAccountDataTable;
use App\DataTables\Customer\PendingAccountsDataTable;
use App\DataTables\Customer\ApproveAccountsDataTable;
use App\DataTables\Customer\RefuseAccountsDataTable;
use App\DataTables\Customer\ApproveMissingDataTable;
use \Mail;
use App\Models\SystemSetting;
use App\Models\EmailTemplate;
use Auth, Hash, Session, Route;

class AccountController extends Controller
{
    public function __construct()
    {
        $this->guard = explode('.', Route::currentRouteName())[0];
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ProjectAccountDataTable $dataTable)
    {
        // dd(auth('customer')->user()->customer);
        return $dataTable->render('customer.accounts.index');
    }
    public function pending_accounts(PendingAccountsDataTable $dataTable)
    {

        return $dataTable->render('customer.accounts.pending-accounts');
    }

    public function approve_missing_accounts(ApproveMissingDataTable $dataTable)
    {

        return $dataTable->render('customer.accounts.approve-missing-accounts');
    }
    public function approve_accounts(ApproveAccountsDataTable $dataTable)
    {

        return $dataTable->render('customer.accounts.approve-accounts');
    }
    public function refuse_accounts(RefuseAccountsDataTable $dataTable)
    {

        return $dataTable->render('customer.accounts.refuse-accounts');
    }
    public function update_accounts(Request $request)
    { 
        //    return  $request->array_data ;
        $request->validate([
            'array_data' => 'array'
        ]);
        $send_data = [];
        // dd($request->array_data);
        foreach ($request->array_data as $key => $data) {

            ProjectAccounts::updateOrCreate(['id' => $data['id']], $data);
            $project_accounts = ProjectAccounts::where('id', $data['id'])->first();
            //send email to admin
            $admins = $project_accounts->project->users;
            $project_name = $project_accounts->project->name;
            $customer_email = auth('customer')->user()->email ?? $project_accounts->project->customer->email;
            $customer_name = auth('customer')->user()->name ?? $project_accounts->project->customer->name;
        }

        $subject = 'Project Data Update';

        foreach ($admins as  $user) {
            // $content_mail = SystemMailContent::where('name_mail','Project Data Update')->first();
            $emailTemplate = EmailTemplate::where('title','Project Data Update')->first();
                       $title = $emailTemplate->title;
                       $body =$emailTemplate->body; 
                    Mail::send('emails.authorization_request_email_from_customer',
                        [ 'title' => $title, 
                        'body' => $body, 
                        'token' => route('admin.login'),
                         'project_name' =>$project_name  ,'user_name' => $user->first_name ." " . $user->last_name
                         , 'guard' => $this->guard],
                        function ($message) use ( $user,$key,$customer_name , $customer_email ,$title, $subject) {
                            $message->from($customer_email, $customer_name);
                            $message->to($user->email)->subject($title ??$subject);
                        }
                    );
                }


        return 'success';
    }


    public function update_approve_missing_accounts(Request $request)
    {
        //    return  $request->array_data ;
        $request->validate([
            'array_data' => 'array'
        ]);
       
        $send_data = [];
        foreach ($request->array_data as $key => $data) {
            $project_accounts = ProjectAccounts::where('id', $data['id'])->first();
            $project_accounts->ac_name = $data['ac_name'];
            $project_accounts->ac_phone = $data['ac_phone'];
            $project_accounts->ac_email = $data['ac_email'];
            $project_accounts->ac_address = $data['ac_address'];
            if ($data['ac_name'] != null && $data['ac_phone'] != null && $data['ac_email'] != null) {
                $project_accounts->authorization_status = 3;
            }

            $project_accounts->save();

            //send email to admin

            $subject = 'Project Data Update';
            $admins = $project_accounts->project->users;
            // dd($admins);
            $project_name = $project_accounts->project->name;
            $customer_email = auth('customer')->user()->email ?? $project_accounts->project->customer->email;
            $customer_name = auth('customer')->user()->name ?? $project_accounts->project->customer->name;
        }

        foreach ($admins as  $user) {
            // $content_mail = SystemMailContent::where('name_mail','Project Data Update')->first();
          $emailTemplate = EmailTemplate::where('title','Project Data Update')->first();
                       $title = $emailTemplate->title;
                       $body =$emailTemplate->body; 
            Mail::send(
                'emails.authorization_request_email_from_customer',
                ['token' => route('admin.login'),
                'title'=>$title,'body'=>$body,
                 'project_name' =>$project_name  ,'user_name' => $user->first_name ." " . $user->last_name, 'guard' => $this->guard],
                function ($message) use ( $user,$key,$customer_name , $title,$customer_email , $subject) {
                    $message->from($customer_email, $customer_name);
                    $message->to($user->email)->subject($title ?? $subject);
                }
            );
            
        }
        return 'success';
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
