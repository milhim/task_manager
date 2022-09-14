<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Traits\FirebaseNotification;

use stdClass;

class TaskController extends Controller
{
    //
    use FirebaseNotification;


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
    public function askforAprov($task_id)
    {
        $task = Task::find($task_id);
        $task->status = 'waiting manager to approval';
        $task->save();
        $manager=User::where('manager_id',auth()->user()->manager_id);

          //send notification 
          $serverKey = 'AAAAwDw-wak:APA91bE6vsEcHFfEyCyOM27Tly2f7ArFJd-piJ5z53XAkLJzeXaAx65GWmSHp-TVF25H93cAmlNfQ3EP1rdeLq0UTNbLJgrTJNHIAapbsleNBpt5KTaXXsPZG1Y95Xqe8_AqOMe6t8sT';
          $notificationTitle='Asking for approval';
          $notificationMessage='Employee' . auth()->user()->name . 'asking you to approve his Task';
  
          $this->sendNotification($serverKey,$notificationTitle,$notificationMessage,$manager->device_key);
    
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
