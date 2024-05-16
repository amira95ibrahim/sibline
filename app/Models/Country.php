<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Country extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'parent_id',
        'name',
        'code',
        'status',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'parent_id' => 'integer',
    ];


    public function addresses()
    {
        return $this->hasMany(\App\Models\Address::class);
    }

    public function parent()
    {
        return $this->belongsTo(\App\Models\Country::class);
    }

    public function childs()
    {
        return $this->hasMany(\App\Models\Country::class,'parent_id');
    }
}
