<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Page extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'url',
        'name',
        'title',
        'content',
        'brief',
        'open_in_new_tab',
        'display_top_menu',
        'display_sidebar',
        'president',
        'parent_id',
        'icon',
        'image',
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


    public function parent()
    {
        return $this->belongsTo(\App\Models\Page::class);
    }

    public function childs()
    {
        return $this->hasMany(\App\Models\Page::class,'parent_id');
    }
}
