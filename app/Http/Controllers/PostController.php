<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Post;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PostController extends Controller
{

    public function index()
    {
        $posts = Post::latest()->get();

        return view('index')
            ->with(['posts' => $posts]);
    }

    public function show(Post $post)
    {
        // $posts = Post::orderby('pos', 'desc')->get();

        $posts = Post::latest()->get();

        return view('posts.show')
            ->with([
                'post' => $post,
                'posts' => $posts,
            ]);
    }

    public function store(PostRequest $request)
    {
        $post = new Post();

        Log::debug('aa');

        $post->title = $request->title;

        $post->save();

        return response()->json(['id' => Post::max('id')]);

    }

    public function update(PostRequest $request, Post $post)
    {
        $post->title = $request->title;
        $post->save();
    }

    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()
            ->route('posts.index');
    }

    public function purge()
    {

        DB::table('posts')->delete();

        return redirect()
            ->route('posts.index');
    }
}
