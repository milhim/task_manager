<?php

namespace App\Http\Controllers\api\auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class LoginController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }
    public function login(Request $request)
    {

        $user=User::where('email',$request->email)->first();
        if($user->is_login){
            return response()->json(['error'=>'there is a nother device has been loggin in']);
        }
        $input = $request->only('email', 'password');
        
        $validator = Validator::make($input, [
            'email' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        if (!$token = Auth::guard('api')->attempt($validator->validated())) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        auth()->user()->is_login=1;
        auth()->user()->save();
        return $this->createNewToken($token);
    }
    public function logout()
    {
        auth()->user()->is_login=0;
        auth()->user()->save();
        auth()->logout();
        return response()->json(['message' => 'User successfully signed out']);
    }
    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->createNewToken(auth()->refresh());
    }
    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function userProfile()
    {
        return response()->json(auth()->user());
    }
    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function createNewToken($token)
    {

        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 500,
            'user' => auth()->user()
        ]);
    }
}
