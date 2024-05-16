<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Veelasky\LaravelHashId\Eloquent\HashableId;
use Illuminate\Foundation\Auth\User as Authenticatable;
class CustomerContact extends Authenticatable
{
    use HasFactory , HashableId;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email',
        'password',
        'name',
        'position',
        'phone',
        'mobile',
        'customer_id','is_verified',
        'status'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'customer_id' => 'integer',
    ];


    public function customer()
    {
        return $this->belongsTo(\App\Models\Customer::class);
    }
}
