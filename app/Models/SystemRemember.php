<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SystemRemember extends Model
{
    use HasFactory;
    protected $table="system_remembertes";
    protected $fillable = [
        'status_account',
        'time',
    ];
    public function accountStatus(){
        return [
                   $this->status_account  => 'More info',
                   1             => 'Pending',
                   2             => 'Accepted(details missing)',
                   3             => 'Accepted',
                   4            => 'Refused',
               ][$this->status_account];
    }
}
