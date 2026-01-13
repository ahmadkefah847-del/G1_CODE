<?php

namespace App\Http\Controllers;

use App\Models\Content;
use Illuminate\Http\Request;

class AwarenessContentController extends Controller
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
            ->get();

        return view('pages.awareness-content', ['contents' => $contents]);
    }
}
