<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesWeighbridgeOUT extends Model
{
    use HasFactory;
    protected $table="sales_weighbridge_out";
    protected $fillable=[
        'id',
        'coupon',
        'weigh_out',

    ];
}
