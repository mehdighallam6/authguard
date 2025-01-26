<?php

namespace App\Http\Controllers;

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
        return Inertia::render('Dashboard');
    }
}
