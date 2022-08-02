<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\StoreUserRequest;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Hash;
use Auth;


class AuthController extends Controller
{
    public function login(Request $request)
    {
        $fields= $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);

        $user =User::where(['email' => $fields['email']])->first();

        if(!$user || !Hash::check($fields['password'], $user->password))
            {
                return response([
                    'message' => 'bad Creds'
                ], 401);
            }
        if(!Auth::attempt(['email' => $request->email, 'password' => $request->password]))
            {
                return response()->json([
                    'success'=>false,
                    'status'=>200,
                ]);
            }
        $user = auth()->user();
        $token = $user->createToken('my-app-token')->plainTextToken;

        return response([
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'role' => $user->role,
            'valid' => $user->valid,
            'created_at' => $user->created_at,
            'updated_at' => $user->updated_at,
            'token' => $token
            // 'token_expires_at' => $token->token->expires_at,
        ], 200);
    }

    public function Register(Request $request)
    {
        $fields = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string|confirmed'
        ]);
        $user = User::Create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'password' => bcrypt($fields['password']) ,
            'valid' => 'Non valid',
            'role' => 'User' 
        ]);
        $token = $user->createToken('myapptoken')->plainTextToken;
        $response =[
            'user' => $user,
            'token' => $token
                ];
         return response($response,201);
    }

}
