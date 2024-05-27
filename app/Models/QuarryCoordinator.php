<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuarryCoordinator extends Model
{
    use HasFactory;
    protected $table="quarry_coordinator";
    protected $fillable=[
        'id',
        'coupon',
        'storage_location',
        'material_type',

    ];
}
