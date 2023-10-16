<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $language = 'en';
        if($request->user()) {
            $user = $request->user();
            $language = $user->language;
        } else {
            $localeSession = Session::get('locale');
            if (isset($localeSession)) {
                $language = $localeSession;
            }
        }
        app()->setLocale($language);
        return $next($request);
    }
}
