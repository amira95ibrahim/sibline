<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class QuarryCoordinator extends Model
{
    use HasFactory;
    protected $table="quarry_coordinator";
    protected $fillable=[
        'id',
        'user_id',
        'coupon',
        'storage_location',
        'material_type',

    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
