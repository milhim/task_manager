<?php

namespace App\Http\Controllers\api\manager;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\User;
use Carbon\Carbon;
use DateTime;
use Dflydev\DotAccessData\Data;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    //
    //
    public function index()
    {
        $tasks = Task::all();
        return response()->json($tasks, 200);
    }
    public function store(Request $request)
    {
        $task = Task::create([
            'task_name' => $request['task_name'],
            'task_period' => $request['task_period'],
            'priority' => $request['priority'],
            'manager_id'=>auth()->user()->id,
            'status'=>'new',
            'start_date'=>new DateTime('now'),
            'end_date'=>Carbon::now()->addDays($request['task_period']),
        ]);

        foreach ($request->user_id as $user_id) {
            $user = User::find($user_id);
            $user->tasks()->attach($task);
        }
        return response()->json($task, 201);
    }

    public function showTasksForEmp($employee_id){
        $user=User::find($employee_id);
        $tasks=$user->tasks;
        return response()->json($tasks, 200);
    }

    public function taskStatus($task_id){

        $task=Task::find($task_id);
        return response()->json($task->status, 200);

    }

    public function taskTime($task_id){

        $task=Task::find($task_id);
        $time=[
            'start'=>$task->start_date,
            'end'=>$task->end_date
        ];
        return response()->json($time, 200);

    }
}
