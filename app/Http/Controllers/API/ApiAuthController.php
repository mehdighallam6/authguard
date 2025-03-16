<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\User;

class ApiAuthController extends Controller
{
    public function login(Request $request)
    {
        $fields = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where("email", $fields["email"])->where("password", $fields["password"])->first();

        if ($user) {
            $token = $user->createToken('myapptoken')->plainTextToken;
            $response = [
                'token' => $token,
            ];
            return response($response, 201);
        } else {
            return response([
                'message' => 'Bad creds',
            ]);
        }
    }


    public function logout(Request $request)
    {
        auth()->user()->tokens()->delete();

        return [
            'message' => 'Logged out'
        ];
    }
}
