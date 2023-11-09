<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;



class LoginController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'username' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required',
        ]);

        try {
            $user = new User;
            $user->name = $request->name;
            $user->username = $request->username;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->role = 'user';
            $user->save();

            $token = $user->createToken('ApiToken')->plainTextToken;

            $response = [
                'success' => true,
                'user' => $user,
                'token' => $token,
            ];
        } 
        catch (\Exception $e) {
            return response([
                'success' => false,
                'message' => ['Register failed']
            ]);
        }
        return response($response,201);
    }
    
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email',$request->email)->first();

        if(!$user || !Hash::check($request->password, $user->password)){
            return response([
                'success' => false,
                'message' =>['These credentials do not match our records'],
                
            ]);
        }

        $token = $user->createToken('ApiToken')->plainTextToken;

        $response = [
            'success' => true,
            'user' => $user,
            'token' =>$token,
        ];

        return response($response, 201);
    }


    public function logout()
    {   
        auth()->logout();
        return response()->json([
            'success' => true,
        ], 200);
    }
}
