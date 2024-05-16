<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectFiles extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'path',
        'project_id'
    ];
    public function project()
    {
        return $this->belongsTo(\App\Models\Projct::class);
    }
}
