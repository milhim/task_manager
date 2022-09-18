<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //
    public function registerNewUser()
    {
        request()->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['string', 'max:255'],
            'password' => ['required', 'string', 'confirmed']
        ]);

        $user = User::create([
            'name' => request('name'),
            'email' => request('email'),
            'phone' => request('phone'),
            'password' => Hash::make(request('password')),
            'role_id' => request('role_id')
        ]);

        event(new Registered($user));

        return response()->json($user, 201);
    }

    public function updateExistingUser(Request $request){
        $user=User::find($request->id);
        $user->name=$request->name;
        $user->email=$request->email;
        $user->phone=$request->phone;
        if($request->password){
            $user->password=Hash::make($request->password);
        }
        $user->role_id=$request->role_id;
        $user->save();

        return response()->json($user);

    }

    public function showUserInformation($id){
        $user=User::find($id);
        return response()->json($user);
    }
    public function destroyUser(Request $request, $id){
        $user=User::find($request->id);
        $user->delete();

        return response()->json(['message'=>'user has been deleted','id'=>$id]);
    }
}
