<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PostController extends Controller
{

    public function index()
    {
        $posts = Category::latest()->get();

        return view('index')
            ->with(['posts' => $posts]);
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

    public function store(PostRequest $request)
    {
        $category = new Category();

        Log::debug('aa');

        $category->title = $request->title;

        $category->save();

        return response()->json(['id' => Category::max('id')]);

    }

    public function update(PostRequest $request, Category $category)
    {
        $category->title = $request->title;
        $category->save();
    }

    public function destroy(Category $category)
    {
        $category->delete();

        // そもそも非同期で作成してたからここはおきるはずなかった。
        return redirect()
            ->route('posts.index');
    }

    public function purge()
    {
        // これが全削除ができるやつらしい
        DB::table('posts')->delete();

        // そもそも非同期で作成してたからここはおきるはずなかった。
        return redirect()
            ->route('posts.index');
    }
}
