<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'address',
        'country_id',
        'city_id',
        'area',
        'gps',
        'street',
        'zip_code',
        'status',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'country_id' => 'integer',
        'city_id' => 'integer',
    ];



    public function customers()
    {
        return $this->hasMany(\App\Models\Customer::class);
    }

    public function country()
    {
        return $this->belongsTo(\App\Models\Country::class)->withDefault([
            'name' => ''
        ]);
    }


    public function city()
    {
        return $this->belongsTo(\App\Models\Country::class)->withDefault([
            'name' => ''
        ]);
    }

    
}
