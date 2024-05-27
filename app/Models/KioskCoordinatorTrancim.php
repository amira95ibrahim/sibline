<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KioskCoordinatorTrancim extends Model
{
    use HasFactory;
    protected $table="kiosk_coordinator_trancium";
    protected $fillable=[
        'id',
        'coupon',
        'sales_order',
        'customer_phone',
        'customer_name',
        'material_num',
        'material_name',
        'destination',
        'Qty_loaded',
        'driver_name',
        'driver_number',
        'truck_plate',
        'registeration_date_time',
        'truck_license'
    ];
}
