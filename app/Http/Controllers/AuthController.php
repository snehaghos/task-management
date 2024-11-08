<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\SignUpRequest;
use App\Http\Resources\Auth\AuthUserResource;


class AuthController extends Controller
{
    public function register(SignUpRequest $request)
    {
        $data = $request->validated();
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
        $token = $user->createToken('myApp')->plainTextToken;
        $response=[
            'data' => new AuthUserResource($user),
            'token'=>$token,
            'message' => 'Successfully registered'
        ];
        return response()->json($response,201);
    }
    public function login(LoginRequest $request){
        $credentials = $request->validated();
        if (!Auth::attempt($credentials)) {
            return response([
                'message' => 'Provided username or password is incorrect',
            ], 422);

        }

        /** @var \App\Models\User $user */
        $data = Auth::user();
        $token = $data->createToken('myApp')->plainTextToken;
        $response = [
            'data' => new AuthUserResource($data),
            'token' => $token,
            'message' => 'Successfully logged In'
        ];

        return response($response, 200);
        //   return response(compact('data', 'token'));

    }
    public function logout(){
        Auth::logout();
        return response(['message' => 'Successfully logged out'], 200);
    }
}
