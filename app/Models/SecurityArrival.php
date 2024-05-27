<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SecurityArrival extends Model
{
    use HasFactory;
    protected $table="security_arrival";
    protected $fillable=[
        'id',
        'coupon',
        'arrival',

    ];
}
