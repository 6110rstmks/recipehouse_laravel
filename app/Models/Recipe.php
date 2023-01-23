<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    use HasFactory;

    protected $fillable = [
        'body',
        'file_path'
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_recipe');
    }

}
