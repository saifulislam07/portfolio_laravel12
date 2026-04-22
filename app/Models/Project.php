<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    /** @use HasFactory<\Database\Factories\ProjectFactory> */
    use HasFactory;

    protected $fillable = [
        'title', 'slug', 'description', 'problem', 'solution', 
        'tech_stack', 'cover_image', 'is_featured'
    ];

    protected $casts = [
        'tech_stack' => 'array',
        'is_featured' => 'boolean',
    ];

    public function images()
    {
        return $this->hasMany(ProjectImage::class);
    }
}
