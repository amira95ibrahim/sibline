<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class CouponsGenerating extends Model
{
    use HasFactory;
    protected $table="coupons_generating";
    protected $fillable = [
        'id',
        'user_id',
        'purchase_order',
        'total_quantity',
        'contractor_name',
        'contractor_number',
        'material_num',
        'material_name',
        'RM_source',
        'storage_location',
        'truck_Av_load_weight'


    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
