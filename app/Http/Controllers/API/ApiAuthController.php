<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ApiAuthController extends Controller
{
    public function login(Request $request)
    {
        $fields = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $user = User::where("email", $fields["email"])->first();

        if ($user || !Hash::check($fields['password'], $user->password)) {
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
