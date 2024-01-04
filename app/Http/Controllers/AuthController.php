<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;


class AuthController extends Controller
{

//    public function __construct()
//    {
//        $this->middleware('auth:api', ['except' => ['login', 'register']]);
//    }

    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');
        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Login credentials are invalid.',
                ], 400);
            }
        } catch (JWTException $e) {
//            return $credentials;
            return response()->json([
                'success' => false,
                'message' => 'Could not create token.',
            ], 500);
        }

        return response()->json([
            'success' => true,
            'token' => $token,
        ]);
    }

    public function get_user(Request $request)
    {
//        if($request->token){
//            $this->validate($request, [
//                'token' => 'required'
//            ]);
//        }


        $user = auth()->user();

//        $user = JWTAuth::authenticate($request->token);

//        dd($user);


        return response()->json(['user' => $user]);
    }

    public function error()
    {
        return response()->json([
            'success' => false,
            'message' => 'You do not admin!',
        ], 500);
    }
}
