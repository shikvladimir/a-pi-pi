<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserController extends Controller
{
//    protected $user;

//    public function __construct()
//    {
//        $this->user = JWTAuth::parseToken()->authenticate();
//    }

    public function register(UserCreateRequest $request)
    {
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => bcrypt($request->password),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'User created successfully',
            'data' => $user
        ], 200);
    }

    public function update($id, UserUpdateRequest $request):string
    {
        try {
            $user = User::find($id);
            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'User not found'
                ]);
            }

            if ($user->email !== $request->email) {
                $validator = Validator::make($request->all(), [
                    'email' => 'required|email|unique:users',
                ]);

                if ($validator->fails()) {
                    return response()->json([
                        'success' => false,
                        'message' => $validator->messages()
                    ]);
                }
            }


            User::query()
                ->find($user->id)
                ->update([
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'password' => bcrypt($request->password),
                ]);

            $success = true;
            $message = "User has been updated";

        }catch (\Illuminate\Database\QueryException $ex) {
            $success = false;
            $message = $ex->getMessage();
        }

        $response = [
            'success' => $success,
            'message' => $message
        ];

        return response()->json($response, 200);
    }

    public function delete(Request $request):string
    {
        try {
            $validator = Validator::make($request->all(), [
                'id' => 'required|integer|min:2',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => $validator->messages()
                ]);
            }

            $user = User::find($request->id);

            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'User not found'
                ]);
            }

            User::destroy($user->id);

            $success = true;
            $message = "User has been deleted";

        }catch (\Illuminate\Database\QueryException $ex) {
            $success = false;
            $message = $ex->getMessage();
        }

        $response = [
            'success' => $success,
            'message' => $message
        ];

        return response()->json($response, 200);
    }

    private function checkEmail(string $email, object $user):string
    {
//        dd(123, $user->email , $email);

        if($user->email === $email){
//            dd(123, $user->email == $email);

            return $email;
        }else{
            $validator = Validator::make(array('email'=>$email), [
                'email' => 'unique:users',
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => $validator->messages()
                ]);
            }else{
                dd($validator->email, 1230);
                return $validator->email;
            }
        }
    }
}
