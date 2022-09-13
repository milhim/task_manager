<?php

namespace App\Http\Controllers\api\manager;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    //
    public function index(){
        $users=User::where('role_id',1)->get();
        return response()->json($users,200);
    }
}
