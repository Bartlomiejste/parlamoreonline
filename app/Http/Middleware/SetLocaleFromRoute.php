<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class SetLocaleFromRoute
{
    public function handle(Request $request, Closure $next)
    {
        $locale = $request->route('locale');

        $allowed = config('seo.locales', ['pl', 'en', 'it']);

        if (!is_string($locale) || !in_array($locale, $allowed, true)) {
            $locale = config('app.fallback_locale', 'pl');
        }      

        App::setLocale($locale);

        return $next($request);
    }
}