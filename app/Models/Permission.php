<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Permission extends Model
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
        'icon',
        'menu_url',
        'president',
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


    public function roles()
    {
        return $this->hasMany(\App\Models\Role::class);
    }

    public function users()
    {
        return $this->hasMany(\App\Models\User::class);
    }

    public function parent()
    {
        return $this->belongsTo(\App\Models\Permission::class);
    }
}
