<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'image_url',
        'public_id',
        'order'
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    // Scope to order images by their order field
    public function scopeOrdered($query)
    {
        return $query->orderBy('order');
    }
}
