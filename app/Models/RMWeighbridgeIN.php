<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RMWeighbridgeIN extends Model
{
    use HasFactory;
    protected $table="rm_weighbridge_in";
    protected $fillable=[
        'id',
        'coupon',
        'weigh_in',

    ];
}
