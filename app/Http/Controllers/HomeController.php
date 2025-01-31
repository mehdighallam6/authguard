<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{

    public function home()
    {
        // temporary redirect to dashboard
        return to_route('dashboard');
    }

    public function dashboard()
    {
        $auth = Auth::user();

        // standard user
        if (! $auth->hasRole('admin'))
            return to_route('stags.index');

        // admin user
        $users_count =  User::count();

        $stats = array('users_count' => $users_count);

        return Inertia::render('Dashboard', [
            'stats' =>  $stats,
        ]);
    }
}
