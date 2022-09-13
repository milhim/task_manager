<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Task;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    //
    public function store(Request $request, $task_id)
    {
        $this->validate($request, [
            'content' => 'required|max:1000'
        ]);

        $comment = new Comment();
        $comment->content = $request->content;
        $comment->user_id = auth()->user()->id;
        $task = Task::find($task_id);
        $task->comments()->save($comment);

        return response()->json($comment, 201);
    }
}
