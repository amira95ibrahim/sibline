<?php

namespace App\Jobs;

use App\Models\ProjectAccounts;
use App\Models\SystemSetting;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Mail;

class sendRememberMails implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        $accounts  = ProjectAccounts::where([['authorization_status' , '!=' , 3] , ['authorization_status' , '!=' , 4]])->groupBy('project_id')->get();
        $system_info = SystemSetting::orderBy('id', 'desc')->first();
        $subject = 'Athorization Request';
        $email = $system_info->email;
        $name = $system_info->name;
        if($accounts){
            foreach($accounts as $account){
                Mail::send('emails.remember_email', [
                    'token'      => route('customer.login'), 'customer_name' => $account->project->cfo_name,
                ],
                    function ($message) use ($account, $email, $name, $subject) {
                        $message->from($email, $name);
                        $message->to($account->project->cfo_email)->subject($subject);
                    });

            }
        }

    }
}
