<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Recipe extends Model
{
    use HasFactory;
    use softDeletes;


    protected $fillable = [
        'name',
        'body',
        'file_path'
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_recipe');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'recipe_tag');
    }

    public function user()
    {
        return $this->belongsTo(User::class);

    }
}
