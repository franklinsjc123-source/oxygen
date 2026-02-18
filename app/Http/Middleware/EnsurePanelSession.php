<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsurePanelSession
{
    /**
     * Ensure admin/vendor panel requests have an active auth+session.
     */
    public function handle(Request $request, Closure $next)
    {
        $isAdminAuthPage = $request->is('admin') || $request->is('admin/login') || $request->is('admin/register');
        $isVendorAuthPage = $request->is('vendar') || $request->is('vendar/login') || $request->is('vendar/register');

        if ($isAdminAuthPage || $isVendorAuthPage) {
            return $next($request);
        }

        if (!auth()->check() || !$request->session()->has('login_id')) {
            return redirect('/');
        }

        return $next($request);
    }
}

