<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class SecurityArrival extends Model
{
    use HasFactory;
    protected $table="security_arrival";
    protected $fillable=[
        'id',
        'user_id',
        'coupon',
        'arrival',

    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
