<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KioskCoordinator extends Model
{
    use HasFactory;
    protected $table="kiosk_coordinator";
    protected $fillable=[
        'id',
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
}
