<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Notification extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'description',
        'receiver_id',
        'receiver_model',
        'reference_id',
        'reference_model',
        'reference_url',
        'is_read'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'created_at' => 'date:Y-m-d',
    ];

    public function receiver()
    {
        $model_name = __NAMESPACE__ . '\\' . $this->receiver_model;

        return $this->belongsTo($model_name)->withDefault([
            'name' => ''
        ]);
    }

    public function reference()
    {
        $model_name = __NAMESPACE__ . '\\' . $this->reference_model;

        return $this->belongsTo($model_name)->withDefault([
            'name' => ''
        ]);
    }
}
