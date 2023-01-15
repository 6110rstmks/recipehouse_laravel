<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Recipe;
use Illuminate\Support\Facades\Log;

class TaskController extends Controller
{

    public function list()
    {
        // $tasks = Task::latest()->get();
        $tasks = Recipe::paginate(2);

        return view('task')
            ->with(['tasks' => $tasks]);
    }

    /**
     * save a task and sync it with a post
     */
    public function store(Request $request, Category $category)
    {
        // countermeasure for multiple submission

        $request->session()->regenerateToken();

        $request->validate([
            'body' => 'required',
        ]);

        $task = new Recipe();

        $task->body = $request->body;

        $task->save();

        // https://laravel.com/docs/9.x/eloquent-relationships#inserting-and-updating-related-models
        // 変わりにこれを使うのもよさげ

        $category->tasks()->syncWithoutDetaching($task->id);

        return redirect()
            ->route('posts.show', $category);
    }

    /**
     *
     */
    public function destroy(Recipe $recipe)
    {

        // $task->postsをデバッグを使用してなんとかidをrouteに渡せたけども
        // これは正規のやり方ではないはず。
        //　正しいやり方はまた後で調べます。

        $aaa = $recipe->posts[0]->id;

        $recipe->delete();

        Log::debug($aaa);

        return redirect()
            ->route('posts.show', $aaa);

    }
}
