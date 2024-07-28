<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected $guarded = [];

    // Define the relationship with the Category model
    public function categories()
    {
        return $this->hasMany(Category::class);
    }
    public function plots()
    {
        return $this->hasMany(Plot::class);
    }
}