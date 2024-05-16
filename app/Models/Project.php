<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'customer_id',
        'fiscal_year',
        'status','cfo_name','cfo_email','project_date'
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

    public function users()
    {
        return $this->belongsToMany(User::class , 'project_users');
    }

    public function documents()
    {
        return $this->hasMany(\App\Models\ProjectFiles::class);
    }

    public function accounts()
    {
        return $this->hasMany(\App\Models\ProjectAccounts::class);
    }


}
