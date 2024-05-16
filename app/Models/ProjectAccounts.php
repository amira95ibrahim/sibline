<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Veelasky\LaravelHashId\Eloquent\HashableId;
class ProjectAccounts extends Model
{
    use HasFactory , HashableId;

    protected $table = 'project_accounts';


    protected $fillable = [
        'account_name',
        'account_number',
        'currency',
        'ob_debit',
        'ob_credit',
        'm_debit',
        'm_credit','balance','project_id','account_type','ac_name' ,'ac_phone' ,'ac_email','ac_address','authorization_request',
        'authorization_status','authorization_comment','authorizationSent_date_time'
        ,'type_replay','is_replay','confirmation_email','is_replay','attachement','comment'
        ,'c_first_name','c_last_name','c_email','c_position'
    ];
    protected $casts = [
        'attachement' =>'array'
    ];
    public function project()
    {
        return $this->belongsTo(\App\Models\Project::class);
    }
    public function typeReplyStatus(){
        return [
            $this->type_replay  => 'More info',
            1             => 'Reply',
            2             => 'Decline',
         ][$this->type_replay];
    }

}
