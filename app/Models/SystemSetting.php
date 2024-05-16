<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Veelasky\LaravelHashId\Eloquent\HashableId;
class SystemSetting extends Model
{
    use HasFactory  , HashableId;
    // use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
     protected $table='system_settings';
    protected $fillable = [
        'name',
        'short_name',
        'address',
        'footer_text',
        'phone',
        'email',
        'facebook',
        'twitter',
        'youtube',
        'logo_header',
        'logo_footer',
        'logo_login',
        'favicon',
        'status',
        'background_login',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
    ];
}
