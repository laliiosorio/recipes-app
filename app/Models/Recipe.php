<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'publication_date',
        'difficulty',
        'preparation_time',
        'ingredients',
        'author',
        'instructions',
        'image',
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
}
