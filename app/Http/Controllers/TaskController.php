<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Task;

class TaskController extends Controller
{
    /**
     *
     *
     */
    public function store(Request $request, Post $post)
    {
        $request->validate([
            'body' => 'required',
        ]);

        $task = new Task();

        $task->body = $request->body;
        
        $task->save();

        $post->tasks()->syncWithoutDetaching($task->id);

        return redirect()
            ->route('posts.show', $post);
    }

    public function destroy(Task $task)
    {
        $task->delete();

        return redirect()
            ->route('posts.show', $task->post);
    }
}
