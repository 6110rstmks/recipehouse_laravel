<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory;
    use softDeletes;

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
