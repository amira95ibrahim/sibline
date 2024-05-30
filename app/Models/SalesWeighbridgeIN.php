<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class SalesWeighbridgeIN extends Model
{
    use HasFactory;
    protected $table="sales_weighbridge_in";
    protected $fillable=[
        'id',
        'user_id',
        'coupon',
        'weigh_in',

    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
