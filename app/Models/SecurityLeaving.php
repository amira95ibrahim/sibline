<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class SecurityLeaving extends Model
{
    use HasFactory;
    protected $table="security_leaving";
    protected $fillable=[
        'id',
        'user_id',
        'coupon',
        'leaving',

    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
