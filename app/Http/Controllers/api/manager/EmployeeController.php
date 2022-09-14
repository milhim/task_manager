<?php

namespace App\Http\Controllers\api\manager;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    //
    public function index()
    {
        $users = User::where('role_id', 1)->get();
        return response()->json($users, 200);
    }
    public function changeTaskStatus(Request $request, $t_id)
    {
        $task = Task::find($t_id);
        
        $task->status = $request->status;
        $task->save();

        return response()->json($task, 200);
    }
}
