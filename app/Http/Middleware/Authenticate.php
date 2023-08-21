<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            return route('login');
        }
    }

    public function handle($request, Closure $next, ...$guard)
    {
        $userInfo = Auth::user();
        if (empty($userInfo)) {
            $curUrl = url()->full();
            $curUrl = urlencode($curUrl);

            if ($request->ajax()) {
                $data = [
                    'error' => true,
                    'message' => trans('auth.Unauthorized')
                ];
                return response($data, 401)->header('REQUIRES_AUTH', '1');
            } else {
                return redirect(url('/login?_b=' . $curUrl));
            }
        }
        $userInfo = $userInfo->load('roles');

        View::share('userInfo', $userInfo);
        return $next($request);
    }
}
