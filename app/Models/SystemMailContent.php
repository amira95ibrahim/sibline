<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SystemMailContent extends Model
{
    use HasFactory;
    protected $table="system_mail_contents";
    protected $fillable = [
        'subject',
        'name_mail',
        'content',
    ];
}
