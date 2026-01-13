<?php

namespace App\Http\Controllers;

use App\Models\Content;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        if ($loc = $request->query('lang')) {
            session(['locale' => $loc]);
        }
        app()->setLocale(session('locale', config('app.locale')));

        $contents = Content::query()
            ->where('published', true)
            ->where('locale', app()->getLocale())
            ->latest()
            ->take(4)
            ->get();

        return view('pages.home', ['contents' => $contents]);
    }
}

