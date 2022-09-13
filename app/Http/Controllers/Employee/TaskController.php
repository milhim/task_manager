<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use stdClass;

class TaskController extends Controller
{
    //
    public function index()
    {
        $user = User::find(auth()->user()->id);
        $tasks = $user->tasks;

        return response()->json($tasks, 200);
    }
    public function updateTaskStatus($task_id, Request $request)
    {
        $task = Task::find($task_id);
        $task->status = $request->status;
        $task->save();
        return response()->json($task, 200);
    }
    public function taskTime()
    {

        $user = auth()->user();
        $tasks = $user->tasks;
        $times = [];
        foreach ($tasks as $task) {

            $time = new stdClass();
            $time->task_name = $task->task_name;
            $time->start_date = $task->start_date;
            $time->end_date = $task->end_date;

            array_push($times, $time);
        }

        return response()->json($times, 200);
    }
}
