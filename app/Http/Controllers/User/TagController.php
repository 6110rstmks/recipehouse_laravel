<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;

use App\Models\Tag;

class TagController extends Controller
{
    public function store(Request $request, Recipe $recipe)
    {
        $tag = new Tag();
        
    }
}
