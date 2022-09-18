<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //
    public function index()
    {
        return view('auth.login');
    }

    public function handle()
    {
        $success = Auth::guard('web')->attempt([
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

        return redirect()->route('login');
    }
}
