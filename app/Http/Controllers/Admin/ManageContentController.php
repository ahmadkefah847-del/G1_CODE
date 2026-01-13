<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ManageContentController extends Controller
{
    public function index(Request $request)
    {
        if ($loc = $request->query('lang')) {
            session(['locale' => $loc]);
        }
        app()->setLocale(session('locale', config('app.locale')));

        return view('admin.manage-content');
    }
}

