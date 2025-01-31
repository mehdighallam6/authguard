<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HomeController extends Controller
{

    public function home()
    {
        // temporary redirect to dashboard
        return to_route('dashboard');
    }

    public function dashboard()
    {
        $users_count =  User::count();

        $stats = array('users_count' => $users_count);

        return Inertia::render('Dashboard', [
            'stats' =>  $stats,
        ]);
    }
}
