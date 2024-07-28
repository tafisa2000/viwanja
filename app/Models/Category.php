<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $guarded = [];

    // Define the relationship with the Project model
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function plots()
    {
        return $this->hasMany(Plot::class);
    }
}
