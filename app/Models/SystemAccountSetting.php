<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SystemAccountSetting extends Model
{
    use HasFactory;
    protected $table="system_account_settings";
    protected $fillable = [
        'start_account_no',
        'type',
    ];
}
