<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class SalesWeighbridgeOUT extends Model
{
    use HasFactory;
    protected $table="sales_weighbridge_out";
    protected $fillable=[
        'id',
        'user_id',
        'coupon',
        'weigh_out',

    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
