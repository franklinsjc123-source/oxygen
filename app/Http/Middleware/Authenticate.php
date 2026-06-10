<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

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
            // Redirect to the correct login page based on URL prefix
            if ($request->is('vendor/*') || $request->is('vendor')) {
                return '/vendor/login';
            } elseif ($request->is('staff/*') || $request->is('staff')) {
                return '/staff/login';
            } elseif ($request->is('admin/*') || $request->is('admin')) {
                return '/admin/login';
            }
            return route('logout');
        }
    }
}
