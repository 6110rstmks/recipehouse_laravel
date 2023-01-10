<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'body',
        'pos',
        'is_done',
    ];

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
