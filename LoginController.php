<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function show()
    {
        return view('auth.login');
    }

    public function submit(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $remember = (bool) $request->boolean('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            Auth::user()->update(['last_login_at' => now()]);
            $langParam = ['lang' => app()->getLocale()];
            
            // Redirect admin to admin dashboard
            if (Auth::user()->role === 'admin') {
                return redirect()->intended(route('admin.dashboard', $langParam))->with('status', 'logged_in');
            }
            
            return redirect()->intended(route('dashboard', $langParam))->with('status', 'logged_in');
        }

        return back()->withInput(['email' => $request->email])->with('error', __('login.messages.login_error'));
    }

    public function logout(Request $request)
    {
        $locale = app()->getLocale();
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home', ['lang' => $locale]);
    }
}
