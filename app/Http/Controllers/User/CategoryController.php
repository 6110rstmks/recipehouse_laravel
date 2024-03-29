<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{

    public function index()
    {
        $authenticated_user = Auth::user();
        $categories = $authenticated_user->categories->paginate(3);
        return view('index')
            ->with(['categories' => $categories]);
    }

    /**
     *　カテゴリが選択された状態でのrecipehouse page
     */
    public function show(Category $category)
    {
        $authenticated_user = Auth::user();

        $categories = $authenticated_user->categories->paginate(3);

        return view('categories.show')
            ->with([
                'category' => $category,
                'categories' => $categories,
            ]);
    }

    public function store(CategoryRequest $request)
    {
        $auth_user = Auth::user();


        $isDuplicate = $auth_user->categories()
                        ->where('title', $request->title)
                        ->exists();

        if ($isDuplicate) {
            return redirect()->back()->withErrors(['title' => 'the title is already created']);
        }

        $category = new Category();

        $category->title = $request->title;

        $category->save();

        // categories()にエラーがでてるけどちゃんとうまくpivot tableに格納されてる。
        // $authed_user->categories()->attach($category->id, ['recipe_id' => null]);
        $auth_user->categories()->syncWithoutDetaching($category->id);

        return redirect()->route('categories.show', $category);

        // return response()->json(['id' => Category::max('id')]);

    }

    /**
     * ajaxで実装できるはず。recipe一覧も非同期で実装する
     */
    public function update(CategoryRequest $request, Category $category)
    {
        $category->title = $request->title;
        $category->save();
    }

    public function destroy(Category $category)
    {
        $authed_user = Auth::user();
        $authed_user->categories()->detach($category->id);
        $category->delete();

        // そもそも非同期で作成してたからここはおきるはずなかった。
        return redirect()
            ->route('categories.index');
    }

    public function purge()
    {
        // これが全削除ができるやつらしい
        DB::table('categories')->delete();

        // そもそも非同期で作成してたからここはおきるはずなかった。
        return redirect()
            ->route('categories.index');
    }
}
