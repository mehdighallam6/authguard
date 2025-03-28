<?php

namespace App\Http\Controllers\API;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Authenticator;


class ApiAuthenticatorController extends Controller
{
    public function getOTP(Request $request)
    {
        $request->validate([
            'name' => ['required', 'exists:authenticators,name'],
        ]);

        // Ensure the user is the owner of the authenticator
        $authenticator = Authenticator::where('user_id', auth()->user()->id)
            ->where('name', $request->name)
            ->get()
            ->first();

        if ($authenticator) {
            return response([
                'otp' => $authenticator->otp,
            ]);
        } else {
            return response([
                'message' => 'Authenticator not found',
            ]);
        }
    }
}
