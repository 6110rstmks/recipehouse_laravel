<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;

use App\Models\Tag;
use App\Models\Recipe;

class TagController extends Controller
{
    public function store(Request $request, Recipe $recipe)
    {
        $request->validate([
            'name' => 'unique:tags'
        ]);

        $tag = new Tag();

        $tag->name = $request->name;

        $tag->save();

        $recipe->tags()->syncWithoutDetaching($tag->id);

        return redirect()->route('recipes.show', $recipe);


    }
}
