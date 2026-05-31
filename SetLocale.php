<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    private const SUPPORTED_LOCALES = ['ar', 'en'];

    public function handle(Request $request, Closure $next): Response
    {
        $locale = $request->query('lang');

        if (is_string($locale) && in_array($locale, self::SUPPORTED_LOCALES, true)) {
            $request->session()->put('locale', $locale);
        }

        app()->setLocale($request->session()->get('locale', config('app.locale')));

        return $next($request);
    }
}
