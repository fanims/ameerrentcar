<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use App\Models\Language;

class SetDefaultLocale
{
    public function handle($request, Closure $next)
    {
        if (!Session::has('locale')) {
            $defaultLang = Language::where('is_default', true)->first();
            if ($defaultLang) {
                Session::put('locale', $defaultLang->code);
            }
        }

        App::setLocale(Session::get('locale', config('app.locale')));

        return $next($request);
    }
}

