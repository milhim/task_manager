<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;;

class RegisterController extends Controller
{
    protected $name = 'name';

    public function index(){
        return view('auth.register');
    }



    public function handle()
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
            'role_id'=>request('role_id')
        ]);

        event(new Registered($user));

        return view('auth.login');
    }
  
}
