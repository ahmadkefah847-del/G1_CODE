<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        if ($loc = $request->query('lang')) {
            session(['locale' => $loc]);
        }
        app()->setLocale(session('locale', config('app.locale')));

        return view('dashboard.user-dashboard');
    }
}

