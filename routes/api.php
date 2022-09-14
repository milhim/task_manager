<?php

use App\Http\Controllers\api\auth\LoginController;
use App\Http\Controllers\api\CommentController;
use App\Http\Controllers\api\manager\EmployeeController;
use App\Http\Controllers\api\manager\TaskController;
use App\Http\Controllers\Employee\TaskController as EmployeeTaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::group([
    'middleware' => 'api'
], function ($router) {
    //Auth
    Route::post('/login', [LoginController::class, 'login']);
    Route::post('/logout', [LoginController::class, 'logout']);
    Route::post('/refresh', [LoginController::class, 'refresh']);
    Route::get('/user-profile', [LoginController::class, 'userProfile']);    

    //1) Manager Routes
        //Task
        
        Route::get('/manager/tasks',[TaskController::class,'index']);//get tasks
        Route::post('/manager/tasks',[TaskController::class,'store']);//create task and give it to employees
        Route::get('/manager/tasks/employees/{employee_id}',[TaskController::class,'showTasksForEmp']);//get tasks for an employee
        Route::get('/manager/task/{task_id}/status',[TaskController::class,'taskStatus']);//task staus
        Route::get('/manager/task/{task_id}/time',[TaskController::class,'taskTime']);//task start and end

        //Employees
        Route::get('/manager/employees',[EmployeeController::class,'index']);
        Route::put('/manager/employee/task/{task_id}',[EmployeeController::class,'changeTaskStatus']);
        
    //2)Employee routes
        Route::get('/employee/tasks',[EmployeeTaskController::class,'index']);
        Route::put('/employee/task/{task_id}',[EmployeeTaskController::class,'updateTaskStatus']);
        Route::get('/employee/task/time',[EmployeeTaskController::class,'taskTime']);//task start and end
        Route::put('/employee/task/{task_id}/askforAprov',[EmployeeTaskController::class,'askforAprov']);


    //Comments
    Route::post('/tasks/comments/{task_id}',[CommentController::class,'store']);//add comment

});
