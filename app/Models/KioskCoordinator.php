<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class KioskCoordinator extends Model
{
    use HasFactory;
    protected $table="kiosk_coordinator";
    protected $fillable=[
        'id',
        'user_id',
        'coupon',
        'purcashe_number',
        'contractor_number',
        'contractor_name',
        'material_num',
        'material_name',
        'RM_source',
        'driver_name',
        'driver_number',
        'truck_plate',
        'registeration_date_time',
        'storage_location'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
