<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Requests\RecipeRequest;

use App\Models\Category;
use App\Models\Recipe;
use Illuminate\Support\Facades\Log;
use illuminate\Support\Facades\Auth;


class RecipeController extends Controller
{
    public function list()
    {
        $recipes = Recipe::paginate(5);

        return view('recipes.list')
            ->with([
                'recipes' => $recipes,
                // 'categories' => $categories,
            ]);
    }

    public function show(Recipe $recipe)
    {

        return view('recipes.show')
            ->with(['recipe' => $recipe]);
    }

    public function showFromList(Recipe $recipe)
    {
        $previous = session()->get('_previous');

        // 前に戻る」ボタン用のlistページのページャーの番号を取得
        // 詳細ページでリロードした際は、
        if (strpos($previous['url'], '/recipes/list'))
        {
            $previous_page_url_number = substr($previous['url'], -1);
            session()->put('previous_page_url_number', $previous_page_url_number);

        } elseif (strpos($previous['url'], '/recipes/show'))
        {
            $previous_page_url_number = session()->get('previous_page_url_number');
        }

        $now_authenticated_user_id = Auth::user()->id;

        // consume points when viewing other's recipe
        // レシピ作成者以外の人がそのレシピを閲覧した場合、viewカウント(目のマーク)を増やす

        if ($now_authenticated_user_id !== $recipe->user_id
            && !strpos($previous['url'], '/recipes/show')
        )
        {
            Auth::user()->point = Auth::user()->point - config('recipe.options.consumption_point');
            Auth::user()->save();

            $recipe->view = $recipe->view + 1;
            $recipe->save();
        }
        logger($previous_page_url_number);

        return view('recipes.show')
            ->with([
                'recipe' => $recipe,
                'previous_page_url_number' => $previous_page_url_number
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

        $recipe->body = $request->body;

        $recipe->user_id = Auth::user()->id;


        $recipe->save();

        // https://laravel.com/docs/9.x/eloquent-relationships#inserting-and-updating-related-models
        // 変わりにこれを使うのもよさげ

        $category->recipes()->syncWithoutDetaching($recipe->id);

        return redirect()
            ->route('recipes.show', $recipe);
    }

    /**
     *
     */
    public function destroy(Recipe $recipe)
    {

        // $recipe->categoriesをデバッグを使用してなんとかidをrouteに渡せたけども
        // これは正規のやり方ではないはず。
        //　正しいやり方はまた後で調べます。

        // setting time to forcedelete 2 minutes after レシピのtrashed pageから2分後に物理削除するための時間を設定
        $recipe->expiration = now()->addMinutes(2);
        $recipe->save();

        $recipe->delete();

        return back();
    }

    // trash page
    public function deletedList()
    {
        $deleted_recipes = Recipe::onlyTrashed()->get();

        Log::info($deleted_recipes);

        return view('recipes.deleted_list')->with(compact('deleted_recipes'));

    }

    // 削除したレシピを復活
    public function restore($recipeId)
    {
        Log::info($recipeId);
        Recipe::withTrashed()->where('id', $recipeId)->restore();

        // return redirect()->route('recipes.deletedList');
        return back();
    }
}
