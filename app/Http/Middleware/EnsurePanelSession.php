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
        // Support correct vendor path and legacy typo path.
        $isVendorAuthPage = $request->is('vendor') || $request->is('vendor/login') || $request->is('vendor/register')
            || $request->is('vendar') || $request->is('vendar/login') || $request->is('vendar/register');
        $isStaffAuthPage = $request->is('staff') || $request->is('staff/login') || $request->is('staff/register');

        if ($isAdminAuthPage || $isVendorAuthPage || $isStaffAuthPage) {
            return $next($request);
        }

        if (!auth()->check() || !$request->session()->has('login_id')) {
            // Redirect to the correct login page based on URL prefix
            if ($request->is('vendor/*') || $request->is('vendor')) {
                return redirect('/vendor/login');
            } elseif ($request->is('staff/*') || $request->is('staff')) {
                return redirect('/staff/login');
            } elseif ($request->is('admin/*') || $request->is('admin')) {
                return redirect('/admin/login');
            }
            return redirect('/');
        }

        return $next($request);
    }
}
