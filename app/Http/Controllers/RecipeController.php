<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RecipeRequest;

use App\Models\Category;
use App\Models\Recipe;
use Illuminate\Support\Facades\Log;

class RecipeController extends Controller
{

    public function list()
    {
        $recipes = Recipe::paginate(2);
        $categories = Category::latest()->get();



        return view('recipe')
            ->with([
                'recipes' => $recipes,
                'categories' => $categories,
            ]);
    }

    /**
     * save a recipe and sync it with a post
     */
    public function store(RecipeRequest $request, Category $category)
    {
        // countermeasure for multiple submission

        $request->session()->regenerateToken();

        $request->validate([
            'body' => 'required',
        ]);

        $recipe = new Recipe();

        $recipe->body = $request->body;

        $dir = 'sample';

        if ($request->has('image'))
        {

            // アップロードされたファイル名を取得
            $file_name = $request->file('image')->getClientOriginalName();

            // アップロードされたファイルの容量を取得

            $file_size = $request->file('image')->getSize();

            $request->file('image')->storeAs('public/' . $dir, $file_name);
        }

        $recipe->save();

        // https://laravel.com/docs/9.x/eloquent-relationships#inserting-and-updating-related-models
        // 変わりにこれを使うのもよさげ

        $category->recipes()->syncWithoutDetaching($recipe->id);

        return redirect()
            ->route('categories.show', $category);
    }

    /**
     *
     */
    public function destroy(Recipe $recipe)
    {

        // $recipe->postsをデバッグを使用してなんとかidをrouteに渡せたけども
        // これは正規のやり方ではないはず。
        //　正しいやり方はまた後で調べます。

        $aaa = $recipe->categories[0];

        $recipe->delete();

        Log::debug($aaa);

        return redirect()
            ->route('categories.show', $aaa);

    }
}
