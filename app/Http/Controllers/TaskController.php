<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Task;
use Illuminate\Support\Facades\Log;

class TaskController extends Controller
{

    public function list()
    {
        // $tasks = Task::latest()->get();
        $tasks = Task::paginate(2);

        return view('task')
            ->with(['tasks' => $tasks]);
    }

    /**
     * save a task and sync it with a post
     */
    public function store(Request $request, Post $post)
    {
        // countermeasure for multiple submission

        $request->session()->regenerateToken();

        $request->validate([
            'body' => 'required',
        ]);

        $task = new Task();

        $task->body = $request->body;

        $task->save();

        // https://laravel.com/docs/9.x/eloquent-relationships#inserting-and-updating-related-models
        // 変わりにこれを使うのもよさげ

        $post->tasks()->syncWithoutDetaching($task->id);

        return redirect()
            ->route('posts.show', $post);
    }

    /**
     *
     */
    public function destroy(Task $task)
    {

        // $task->postsをデバッグを使用してなんとかidをrouteに渡せたけども
        // これは正規のやり方ではないはず。
        //　正しいやり方はまた後で調べます。

        $aaa = $task->posts[0]->id;

        $task->delete();

        Log::debug($aaa);

        return redirect()
            ->route('posts.show', $aaa);

    }
}
