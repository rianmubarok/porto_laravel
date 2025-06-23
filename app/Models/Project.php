<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'type',
        'technologies',
        'github_link',
        'live_link'
    ];

    protected $with = ['images'];

    public function images()
    {
        return $this->hasMany(ProjectImage::class)->ordered();
    }

    public function scopeDesign($query)
    {
        return $query->where('type', 'design');
    }

    public function scopeProgramming($query)
    {
        return $query->where('type', 'programming');
    }

    public function isDesign()
    {
        return $this->type === 'design';
    }

    public function isProgramming()
    {
        return $this->type === 'programming';
    }
}
