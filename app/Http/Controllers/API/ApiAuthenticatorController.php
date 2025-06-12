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

        $query = Authenticator::where('name', $request->name);

        // Admin can get all authenticators, others only their own
        if(!$user->hasRole('Admin')) {
            $query->where('user_id', Auth::user()->id);
        }

        $authenticator = $query->first();


        if ($authenticator) {
            return response([
                'otp' => $authenticator?->otp,
            ]);
        }

        return response([
            'message' => 'Authenticator not found',
        ]);
    }
}
