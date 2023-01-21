<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'body',
        'pos',
    ];

    public function recipes()
    {
        return $this->belongsToMany(Recipe::class, 'category_recipe');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'category_user');
    }
}
