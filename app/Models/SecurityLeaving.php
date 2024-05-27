<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SecurityLeaving extends Model
{
    use HasFactory;
    protected $table="security_leaving";
    protected $fillable=[
        'id',
        'coupon',
        'leaving',

    ];
}
