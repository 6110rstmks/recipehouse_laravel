<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Requests\CategoryRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CategoryController extends Controller
{

    public function index()
    {
        $categories = Category::latest()->get();

        return view('index')
            ->with(['categories' => $categories]);
    }

    public function show(Category $category)
    {
        // $posts = Category::orderby('pos', 'desc')->get();

        $posts = Category::latest()->get();

        return view('posts.show')
            ->with([
                'category' => $category,
                'posts' => $posts,
            ]);
    }

    public function store(CategoryRequest $request)
    {
        $category = new Category();

        // Log::debug('aa');

        $category->title = $request->title;

        $category->save();

        return response()->json(['id' => Category::max('id')]);

    }

    public function update(CategoryRequest $request, Category $category)
    {
        $category->title = $request->title;
        $category->save();
    }

    public function destroy(Category $category)
    {
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
