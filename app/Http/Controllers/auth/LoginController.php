<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    //
    public function index()
    {
        return view('admin.login');
    }

    public function handle()
    {
        $success = auth()->attempt([
            'email' => request('email'),
            'password' => request('password')
        ], request()->has('remember'));

        if ($success) {
            return redirect()->to('/dashboard');
        } else {
            return back()->withErrors([
                'error' => 'The provided credentials do not match our records.',
            ]);
        }
    }

    public function logout()
    {
        auth()->logout();

        return redirect()->route('login.page');
    }
}
