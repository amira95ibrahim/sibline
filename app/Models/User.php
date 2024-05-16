<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email',
        'password',
        'first_name',
        'last_name',
        'role_id',
        'image',
        'status',
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
        'created_at' => 'date:Y-m-d',
        'role_id' => 'integer',
    ];
    public $appends = ["user_name"];

    public function permissions()
    {
        return $this->belongsToMany(\App\Models\Permission::class);
    }

    public function role()
    {
        return $this->belongsTo(\App\Models\Role::class);
    }

    public function getUserNameAttribute()
    {
        return  $this->first_name . ' '. $this->last_name ;
    }
    public function projects()
    {
        return $this->belongsToMany(Project::class)->using(ProjectUser::class);
    }
}
