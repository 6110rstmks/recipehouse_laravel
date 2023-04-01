<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;

use App\Models\Tag;
use App\Models\Recipe;

class TagController extends Controller
{

    public function setNewTag()
    {
        $tags = Tag::select("*")->inRandomOrder()->take(5)->get();

        return response()->json([
            'tags' => $tags,
        ]);
    }

    public function showTag(Request $request)
    {
        $search_word = '%' . $request->keyword . '%';

        if ($request->keyword != '')
        {
            $tag_names = Tag::where("name", 'Like', $request->keyword)->get();
        }

        return response()->json([
            'tag_names' => $tag_names,
        ]);
    }

    public function attach(Request $request, Recipe $recipe)
    {
        $tag = new Tag();

        $tag->name = $request->name;

        $tag->save();

        $recipe->tags()->syncWithoutDetaching($tag->id);

        return redirect()->route('recipes.show', $recipe);

    }

    public function detach(Recipe $recipe, Tag $tag)
    {

    }
}
