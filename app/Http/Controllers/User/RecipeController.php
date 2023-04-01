<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Requests\RecipeRequest;

use App\Models\Category;
use App\Models\Recipe;
use App\Models\Tag;
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
            ->with([
                'recipe' => $recipe,
            ]);
    }

    // recipelistから詳細ページに入った場合
    public function showFromList(Recipe $recipe) {
        $previous = session()->get('_previous');

        Log::info($previous);

        if (strpos($previous['url'], '/recipes/list'))
        {
            if (is_numeric(substr($previous['url'], -1))) {

                /**
                 * 「前に戻る」ボタンを押したときに、リストページのページャー番号のページに戻るための変数
                 *  @int
                 */
                $previous_page_url_number = substr($previous['url'], -1);

            } else {
                $previous_page_url_number = 1;
            }

            session()->put('previous_page_url_number', $previous_page_url_number);
            logger($previous_page_url_number);
        } elseif (strpos($previous['url'], '/recipes/show'))
        {
            $previous_page_url_number = session()->get('previous_page_url_number');
        }

        $now_authenticated_user_id = Auth::user()->id;

        // レシピ作成者以外の人がそのレシピを閲覧した場合、viewカウント(目のマーク)を増やす

        if ($now_authenticated_user_id !== $recipe->user_id
            && !strpos($previous['url'], '/recipes/show')
        )
        {
            // ポイント消費はjsからリクエストを送る。
            $recipe->view = $recipe->view + 1;
            $recipe->save();
        }
        return view('recipes.show')
            ->with([
                'recipe' => $recipe,
                'previous_page_url_number' => $previous_page_url_number,
            ]);
    }

    /**
     * save a recipe and sync it with a post
     */
    public function pre_store(RecipeRequest $request, Category $category)
    {
        // countermeasure for multiple submission

        $request->session()->regenerateToken();

        $request->validate([
            'name' => 'required',
        ]);

        $recipe = new Recipe();

        $recipe->name = $request->name;

        $recipe->user_id = Auth::user()->id;
        $recipe->save();

        // https://laravel.com/docs/9.x/eloquent-relationships#inserting-and-updating-related-models
        // 変わりにこれを使うのもよさげ

        $category->recipes()->syncWithoutDetaching($recipe->id);

        return redirect()
            // ->route('recipes.create_page', $recipe);
            ->route('recipes.create_page');
    }

    public function createPage(Recipe $recipe)
    {
        $recipe = Recipe::latest()->first();
        $tags = Tag::select("*")->inRandomOrder()->take(5)->get();

        return view('recipes.create')
            ->with([
                'tags' => $tags,
                'recipe' => $recipe,
                'state' => "create",
            ]);
    }

    // 作成途中のレシピを破棄
    public function discard(Category $category)
    {
        $maxid = Recipe::max('id');
        Recipe::find($maxid)->delete();
        return redirect()->route('categories.show', $category);
    }
    public function store(Request $request, Recipe $recipe)
    {
        $request->validate([
            'body' => 'required',
        ]);

        $recipe = Recipe::latest()->first();

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

        // $recipe->tag_id = $request->tag_id;
        $recipe->tags()->syncWithoutDetaching($request->tag_id);


        $recipe->save();

        $category = $recipe->categories[0];

        return redirect()->route('categories.show', $category);
    }

    public function editPage(Recipe $recipe)
    {
        $tags = Tag::select("*")->inRandomOrder()->take(5)->get();

        $attachedtags = $recipe->tags[0];
        // dd($attachedtags->name);

        return view('recipes.edit')
            ->with([
                'tags' => $tags,
                'recipe' => $recipe,
                'outlet' => $attachedtags,
                'state' => "edit",
            ]);
    }

    public function edit(Recipe $recipe, Request $request)
    {
        $request->validate([
            'body' => 'required',
        ]);

        $recipe->body = $request->body;

        $recipe->save();

        $category = $recipe->categories[0];

        return redirect()->route('categories.show', $category);
    }

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
        $deleted_recipes = Recipe::onlyTrashed()->paginate(6);

        Log::info($deleted_recipes);

        return view('recipes.deleted_list')->with(compact('deleted_recipes'));

    }

    // 削除したレシピを復活
    public function restore($recipeId)
    {
        Log::info($recipeId);
        Recipe::withTrashed()->where('id', $recipeId)->restore();
        return back();
    }
}
