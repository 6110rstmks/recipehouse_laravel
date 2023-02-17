<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Requests\RecipeRequest;

use App\Models\Category;
use App\Models\Recipe;
use Illuminate\Support\Facades\Log;

class RecipeController extends Controller
{

    public function list()
    {
        $recipes = Recipe::paginate(5);
        $categories = Category::latest()->get();


        return view('recipes.list')
            ->with([
                'recipes' => $recipes,
                'categories' => $categories,
            ]);
    }

    public function show(Recipe $recipe)
    {
        return view('recipes.show')
            ->with(['recipe' => $recipe]);
    }

    /**
     * save a recipe and sync it with a post
     */
    public function store(RecipeRequest $request, Category $category)
    // public function store(Request $request, Category $category)
    {
        // countermeasure for multiple submission

        Log::debug('souzai');

        $request->session()->regenerateToken();

        $request->validate([
            'name' => 'required',
        ]);

        $recipe = new Recipe();

        $recipe->name = $request->name;


        if ($request->has('image'))
        {
            // アップロードされたファイル名を取得
            $file_name = $request->file('image')->getClientOriginalName();

            // アップロードされたファイルの容量を取得
            $file_size = $request->file('image')->getSize();

            $request->file('image')->storeAs('public', $file_name);

            $recipe->file_path = $file_name;
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

        // $recipe->categoriesをデバッグを使用してなんとかidをrouteに渡せたけども
        // これは正規のやり方ではないはず。
        //　正しいやり方はまた後で調べます。

        $category = $recipe->categories[0];

        $recipe->delete();

        Log::debug($category);

        // return redirect()
        //     ->route('categories.show', $category);

        return back();
    }

    public function deletedList()
    {
        $deleted_recipes = Recipe::onlyTrashed()->get();

        Log::info($deleted_recipes);

        return view('recipes.deleted_list')->with(compact('deleted_recipes'));

    }

    // public function restore(Recipe $recipe)
    public function restore($recipeId)
    {
        Log::info($recipeId);
        Recipe::withTrashed()->where('id', $recipeId)->restore();

        // return redirect()->route('recipes.deletedList');
        return back();
    }
}
