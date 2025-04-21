<?php

namespace App\Http\Controllers\API;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Authenticator;
use Illuminate\Support\Facades\Auth;


class ApiAuthenticatorController extends Controller
{
    public function getOTP(Request $request)
    {
        $request->validate([
            'name' => ['required', 'exists:authenticators,name'],
        ]);

        $user = Auth::user();

        $authenticator = Authenticator::where('user_id', $user->id)
            ->where('name', $request->name)
            ->first();


        if ($authenticator || $user->hasRole('admin')) {
            return response([
                'otp' => $authenticator?->otp,
            ]);
        }

        return response([
            'message' => 'Authenticator not found',
        ]);
    }
}
