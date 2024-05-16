<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Carbon\Carbon;

class Customer extends Authenticatable
{
    use HasFactory, SoftDeletes;
    protected $shouldHashPersist = true;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email',
        'website',
        'name',
        'birth_date',
        'phone',
        'mobile',
        'wallet',
        'address_id',
        'image',
        'uuid',
        'platform',
        'version',
        'is_verified',
        'status','note','password'
        
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'birth_date' => 'date:Y-m-d',
        'address_id' => 'integer',
        'created_at' => 'date:Y-m-d',
    ];


    public function address()
    {
        return $this->belongsTo(\App\Models\Address::class);
    }

    public function castomerContacts()
    {
        return $this->hasMany(\App\Models\CustomerContact::class , 'customer_id' , 'id');
    }

    public function scopeBetween($query, Carbon $from, Carbon $to)
    {
        $query->whereBetween('created_at', [$from, $to]);
    }


}
