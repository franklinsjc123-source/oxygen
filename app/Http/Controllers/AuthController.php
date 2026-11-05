<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Route;

use App\Helper\CommonHelper;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session as FacadesSession;

class AuthController extends Controller
{
    protected $commonHelper;

    public function __construct(
        CommonHelper $commonHelper
    ) {
        $this->commonHelper = $commonHelper;
    }
    public function adminlogin(Request $request)
    {
        $data['username'] = $request->username;
        $data['password'] = $request->password;
        $remember = $request->boolean('remember') || $request->has('remember') || $request->input('remember') === '1' || $request->input('remember') === 'on';
        
        if (auth()->attempt($data, $remember)) {
            $user = Auth::user();
            if ($user->status == 1) {
                $userId = $user->id;
                $login_id = $user->login_id;                  
                $log_name   = $user->name;                   
                $status   = $user->status;                   
                $log_type   = $user->log_type;

                FacadesSession::put('log_name', $log_name);
                FacadesSession::put('username', $data['username']);
                FacadesSession::put('userId', $userId);
                FacadesSession::put('status', $status);
                FacadesSession::put('log_type', $log_type);
                FacadesSession::put('login_id', $login_id);

                $redirect = redirect()->route('admindashboard', $user->admin_id);

                if ($remember) {
                    Cookie::queue('remember_admin_username', $request->username, 60 * 24 * 30);
                    Cookie::queue('remember_admin_password', $request->password, 60 * 24 * 30);
                    Cookie::queue('remember_admin_check', '1', 60 * 24 * 30);

                    $redirect = $redirect->withCookie(cookie()->make('remember_admin_username', $request->username, 60 * 24 * 30))
                                         ->withCookie(cookie()->make('remember_admin_password', $request->password, 60 * 24 * 30))
                                         ->withCookie(cookie()->make('remember_admin_check', '1', 60 * 24 * 30));
                } else {
                    Cookie::queue(Cookie::forget('remember_admin_username'));
                    Cookie::queue(Cookie::forget('remember_admin_password'));
                    Cookie::queue(Cookie::forget('remember_admin_check'));

                    $redirect = $redirect->withoutCookie('remember_admin_username')
                                         ->withoutCookie('remember_admin_password')
                                         ->withoutCookie('remember_admin_check');
                }

                return $redirect;
            } else {
                Auth::logout();
                return view('auth.adminlogin', ['error' => 'You do not have admin access.']);
            }                
        } else {
            return view('auth.adminlogin', ['error' => 'Invalid username or password.']);
        }
    }


    public function vendorlogin(Request $request)
    {
        $data['username'] = $request->username;
        $data['password'] = $request->password;
        $remember = $request->boolean('remember') || $request->has('remember') || $request->input('remember') === '1' || $request->input('remember') === 'on';
        
        if (auth()->attempt($data, $remember)) {
            $user = Auth::user();
            if ($user->status == 2) {
                FacadesSession::put('username', $data['username']);
                FacadesSession::put('userId', $user->id);
                FacadesSession::put('status', $user->status);
                FacadesSession::put('login_id', $user->login_id);
                FacadesSession::put('log_name', $user->name);
                FacadesSession::put('log_type', $user->log_type ?? 'Vendor');

                $redirect = redirect()->route('vendordashboard', $user->login_id);

                if ($remember) {
                    Cookie::queue('remember_vendor_username', $request->username, 60 * 24 * 30);
                    Cookie::queue('remember_vendor_password', $request->password, 60 * 24 * 30);
                    Cookie::queue('remember_vendor_check', '1', 60 * 24 * 30);

                    $redirect = $redirect->withCookie(cookie()->make('remember_vendor_username', $request->username, 60 * 24 * 30))
                                         ->withCookie(cookie()->make('remember_vendor_password', $request->password, 60 * 24 * 30))
                                         ->withCookie(cookie()->make('remember_vendor_check', '1', 60 * 24 * 30));
                } else {
                    Cookie::queue(Cookie::forget('remember_vendor_username'));
                    Cookie::queue(Cookie::forget('remember_vendor_password'));
                    Cookie::queue(Cookie::forget('remember_vendor_check'));

                    $redirect = $redirect->withoutCookie('remember_vendor_username')
                                         ->withoutCookie('remember_vendor_password')
                                         ->withoutCookie('remember_vendor_check');
                }
                
                return $redirect;
            } else {
                Auth::logout();
                return view('auth.vendorlogin', ['error' => 'You do not have seller access.']);
            }
        } else {
            return view('auth.vendorlogin', ['error' => 'Invalid username or password.']);
        }
    }



    public function stafflogin(Request $request)
    {
        $data['username'] = $request->username;
        $data['password'] = $request->password;
        $remember = $request->boolean('remember') || $request->has('remember') || $request->input('remember') === '1' || $request->input('remember') === 'on';
        
        if (auth()->attempt($data, $remember)) {
            $user = Auth::user();
            $staffExists = \App\Models\Staffcreates::where('employee_id', $user->login_id)->exists();

            if ($staffExists && (int) $user->status !== 3) {
                $user->status = 3;
                if (empty($user->log_type)) {
                    $user->log_type = 'Staff';
                }
                $user->save();
                $user = $user->fresh();
            }

            if ($user->status == 3) {
                FacadesSession::put('username', $data['username']);
                FacadesSession::put('userId', $user->id);
                FacadesSession::put('level', $user->level);
                FacadesSession::put('login_id', $user->login_id);
                FacadesSession::put('status', $user->status);
                FacadesSession::put('log_type', $user->log_type ?? 'Staff');
                FacadesSession::put('log_name', $user->name);
                
                $staffCreates = \App\Models\Staffcreates::where('employee_id', $user->login_id)->first();
                if ($staffCreates) {
                    $roll = \App\Models\Roll::where('roll', $staffCreates->department)->get();
                    FacadesSession::put('roll', $roll);
                }

                $redirect = redirect()->route('staffdashboard', $user->login_id);

                if ($remember) {
                    Cookie::queue('remember_staff_username', $request->username, 60 * 24 * 30);
                    Cookie::queue('remember_staff_password', $request->password, 60 * 24 * 30);
                    Cookie::queue('remember_staff_check', '1', 60 * 24 * 30);

                    $redirect = $redirect->withCookie(cookie()->make('remember_staff_username', $request->username, 60 * 24 * 30))
                                         ->withCookie(cookie()->make('remember_staff_password', $request->password, 60 * 24 * 30))
                                         ->withCookie(cookie()->make('remember_staff_check', '1', 60 * 24 * 30));
                } else {
                    Cookie::queue(Cookie::forget('remember_staff_username'));
                    Cookie::queue(Cookie::forget('remember_staff_password'));
                    Cookie::queue(Cookie::forget('remember_staff_check'));

                    $redirect = $redirect->withoutCookie('remember_staff_username')
                                         ->withoutCookie('remember_staff_password')
                                         ->withoutCookie('remember_staff_check');
                }
                
                return $redirect;
            }

            Auth::logout();
            return view('auth.stafflogin', ['error' => 'You do not have staff access.']);
        }

        return view('auth.stafflogin', ['error' => 'Invalid username or password.']);
    }

    
    public function userlogin(Request $request)
    {
        $data['username'] = $request->username;
        $data['password'] = $request->password;
        $remember = $request->boolean('remember');
        
        if (auth()->attempt($data, $remember)) {
            $user = Auth::user();
            if ($user->status == 4) {
                FacadesSession::put([
                    'username' => $data['username'],
                    'userId' => $user->id,
                    'level' => $user->level,
                    'status' => $user->status,
                    'login_id' => $user->login_id,
                    'log_name' => $user->name,
                ]);

                if ($remember) {
                    Cookie::queue('remember_user_username', $request->username, 60 * 24 * 30);
                    Cookie::queue('remember_user_password', $request->password, 60 * 24 * 30);
                    Cookie::queue('remember_user_check', '1', 60 * 24 * 30);
                } else {
                    Cookie::queue(Cookie::forget('remember_user_username'));
                    Cookie::queue(Cookie::forget('remember_user_password'));
                    Cookie::queue(Cookie::forget('remember_user_check'));
                }

                if ($user->login_id) {
                    return redirect()->route('home');
                } else {
                    return redirect()->route('home');
                }
            } else {
                Auth::logout();
                return view('auth.userlogin', ['error' => 'Unauthorized access.']);
            }
        } else {
            return view('auth.userlogin', ['error' => 'Invalid username or password.']);
        }
    }



    public function userlogout(Request $request)
    {
        Auth::logout();
       
       
         FacadesSession::forget('username');
         FacadesSession::forget('userId');
         FacadesSession::forget('level');         
         FacadesSession::forget('status');
        return redirect('/');
    }

    public function logout(Request $request)
    {
        $redirect = '/admin/login';
        
        if (Auth::check()) {
            $user = Auth::user();
            if ($user->status == 2) {
                $redirect = '/seller/login';
            } elseif ($user->status == 3) {
                $redirect = '/staff/login';
            }
        }
        
        Auth::logout();
        FacadesSession::flush();
        return redirect($redirect);
    }
    
    public function register(Request $request)
    {
        $listAgents = ['MSIE', 'Firefox', 'Chrome', 'Safari', 'Opera', 'Netscape'];
        $userAgent = $request->header('User-Agent');
        $getUseragent = $this->commonHelper->findString($userAgent, $listAgents);
        return $getUseragent;
    }

    public function staffSendForgotOtp(Request $request)
    {
        $identifier = trim($request->input('identifier', ''));
        if (empty($identifier)) {
            return response()->json([
                'status' => 'error',
                'msg' => 'Please enter your username, employee ID, or email address.'
            ]);
        }

        $staff = \App\Models\Staffcreates::where('username', $identifier)
            ->orWhere('employee_id', $identifier)
            ->orWhere('email', $identifier)
            ->first();

        $user = null;
        if ($staff) {
            $user = \App\Models\User::where('login_id', $staff->employee_id)
                ->orWhere('username', $staff->username)
                ->first();
        } else {
            $user = \App\Models\User::where(function($q) use ($identifier) {
                    $q->where('username', $identifier)
                      ->orWhere('email', $identifier)
                      ->orWhere('login_id', $identifier);
                })
                ->where(function($q) {
                    $q->where('status', 3)->orWhere('log_type', 'Staff');
                })
                ->first();
            if ($user) {
                $staff = \App\Models\Staffcreates::where('employee_id', $user->login_id)->first();
            }
        }

        if (!$staff && !$user) {
            return response()->json([
                'status' => 'error',
                'msg' => 'No active staff account found matching that username, employee ID, or email.'
            ]);
        }

        $email = !empty($staff->email) ? $staff->email : ($user->email ?? null);
        $fullname = !empty($staff->fullname) ? $staff->fullname : ($user->name ?? 'Staff');
        $employeeId = !empty($staff->employee_id) ? $staff->employee_id : ($user->login_id ?? '');
        $username = !empty($staff->username) ? $staff->username : ($user->username ?? '');

        if (empty($email)) {
            return response()->json([
                'status' => 'error',
                'msg' => 'No registered email address found for this staff account. Please contact an Administrator.'
            ]);
        }

        $otp = rand(100000, 999999);

        session([
            'staff_forgot_otp' => $otp,
            'staff_forgot_email' => $email,
            'staff_forgot_emp_id' => $employeeId,
            'staff_forgot_username' => $username,
            'staff_forgot_expiry' => now()->addMinutes(10),
            'staff_forgot_verified' => false,
        ]);

        $maskedEmail = preg_replace('/(?<=.{2}).(?=.*@)/', '*', $email);

        try {
            \Illuminate\Support\Facades\Mail::to($email)->send(new \App\Mail\ForgotPasswordOtpMail($otp, $fullname));
            return response()->json([
                'status' => 'success',
                'msg' => "A 6-digit OTP code has been sent to your registered email ({$maskedEmail}).",
                'masked_email' => $maskedEmail
            ]);
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error("Staff forgot mail error: " . $e->getMessage());
            \Illuminate\Support\Facades\Log::info("Staff forgot OTP for {$email} is: {$otp}");
            return response()->json([
                'status' => 'success',
                'msg' => "OTP generated. (Email server offline/unreachable. Dev OTP: {$otp})",
                'masked_email' => $maskedEmail,
                'dev_otp' => $otp
            ]);
        }
    }

    public function staffVerifyForgotOtp(Request $request)
    {
        $otp = trim($request->input('otp', ''));
        if (empty($otp)) {
            return response()->json(['status' => 'error', 'msg' => 'Please enter the 6-digit OTP code.']);
        }

        $sessionOtp = session('staff_forgot_otp');
        $sessionExpiry = session('staff_forgot_expiry');

        if (!$sessionOtp || !$sessionExpiry) {
            return response()->json(['status' => 'error', 'msg' => 'OTP session expired. Please request a new OTP.']);
        }

        if (now()->greaterThan($sessionExpiry)) {
            session()->forget(['staff_forgot_otp', 'staff_forgot_email', 'staff_forgot_emp_id', 'staff_forgot_username', 'staff_forgot_expiry', 'staff_forgot_verified']);
            return response()->json(['status' => 'error', 'msg' => 'The OTP code has expired. Please request a new OTP.']);
        }

        if ((string) $otp !== (string) $sessionOtp) {
            return response()->json(['status' => 'error', 'msg' => 'Invalid OTP code. Please check and try again.']);
        }

        session(['staff_forgot_verified' => true]);
        return response()->json(['status' => 'success', 'msg' => 'OTP verified successfully! Please enter your new password.']);
    }

    public function staffResetPassword(Request $request)
    {
        if (!session('staff_forgot_verified')) {
            return response()->json(['status' => 'error', 'msg' => 'Session not verified. Please verify OTP first.']);
        }

        $newPassword = $request->input('new_password');
        $confirmPassword = $request->input('confirm_password');

        if (empty($newPassword) || empty($confirmPassword)) {
            return response()->json(['status' => 'error', 'msg' => 'Please fill in both password fields.']);
        }

        if (strlen($newPassword) < 5) {
            return response()->json(['status' => 'error', 'msg' => 'Password must be at least 5 characters long.']);
        }

        if ($newPassword !== $confirmPassword) {
            return response()->json(['status' => 'error', 'msg' => 'Passwords do not match.']);
        }

        $empId = session('staff_forgot_emp_id');
        $username = session('staff_forgot_username');
        $email = session('staff_forgot_email');

        if (!empty($empId) || !empty($username) || !empty($email)) {
            // Update staffother table
            \App\Models\Staffcreates::where(function($q) use ($empId, $username, $email) {
                if ($empId) $q->orWhere('employee_id', $empId);
                if ($username) $q->orWhere('username', $username);
                if ($email) $q->orWhere('email', $email);
            })->update(['password' => $newPassword]);

            // Update users table
            \App\Models\User::where(function($q) use ($empId, $username, $email) {
                if ($empId) $q->orWhere('login_id', $empId);
                if ($username) $q->orWhere('username', $username);
                if ($email) $q->orWhere('email', $email);
            })->update(['password' => Hash::make($newPassword)]);
        }

        $savedUsername = $username ?: $empId;

        // Clean up session
        session()->forget(['staff_forgot_otp', 'staff_forgot_email', 'staff_forgot_emp_id', 'staff_forgot_username', 'staff_forgot_expiry', 'staff_forgot_verified']);

        return response()->json([
            'status' => 'success',
            'msg' => 'Your password has been reset successfully! You can now log in.',
            'username' => $savedUsername
        ]);
    }

    public function vendorSendForgotOtp(Request $request)
    {
        $identifier = trim($request->input('identifier', ''));
        if (empty($identifier)) {
            return response()->json([
                'status' => 'error',
                'msg' => 'Please enter your seller username, shop ID, or email address.'
            ]);
        }

        // Try finding in User table first with status = 2
        $user = \App\Models\User::where('status', 2)
            ->where(function($q) use ($identifier) {
                $q->where('username', $identifier)
                  ->orWhere('email', $identifier)
                  ->orWhere('login_id', $identifier);
            })
            ->first();

        $vendor = null;
        if ($user) {
            $vendor = \App\Models\vendor\vendorcreate::where('id', $user->login_id)->first();
        } else {
            // Try finding in vendor_details
            $vendor = \App\Models\vendor\vendorcreate::where('id', $identifier)
                ->orWhere('shop_name', $identifier)
                ->orWhere('email', $identifier)
                ->orWhere('primary_email', $identifier)
                ->orWhere('mobile', $identifier)
                ->first();

            if ($vendor) {
                $user = \App\Models\User::where('status', 2)
                    ->where(function($q) use ($vendor) {
                        $q->where('login_id', $vendor->id)
                          ->orWhere('username', $vendor->shop_name)
                          ->orWhere('email', $vendor->email);
                    })
                    ->first();
            }
        }

        if (!$user && !$vendor) {
            return response()->json([
                'status' => 'error',
                'msg' => 'No active seller account found matching that username, shop ID, or email.'
            ]);
        }

        $email = !empty($user->email) ? $user->email : ($vendor->email ?? ($vendor->primary_email ?? null));
        $sellerName = !empty($vendor->shop_name) ? $vendor->shop_name : ($user->name ?? 'Seller');
        $loginId = !empty($user->login_id) ? $user->login_id : ($vendor->id ?? '');
        $username = !empty($user->username) ? $user->username : ($vendor->shop_name ?? '');

        if (empty($email)) {
            return response()->json([
                'status' => 'error',
                'msg' => 'No registered email address found for this seller account. Please contact Support/Admin.'
            ]);
        }

        $otp = rand(100000, 999999);

        session([
            'vendor_forgot_otp' => $otp,
            'vendor_forgot_email' => $email,
            'vendor_forgot_login_id' => $loginId,
            'vendor_forgot_username' => $username,
            'vendor_forgot_expiry' => now()->addMinutes(10),
            'vendor_forgot_verified' => false,
        ]);

        $maskedEmail = preg_replace('/(?<=.{2}).(?=.*@)/', '*', $email);

        try {
            \Illuminate\Support\Facades\Mail::to($email)->send(new \App\Mail\ForgotPasswordOtpMail($otp, $sellerName));
            return response()->json([
                'status' => 'success',
                'msg' => "A 6-digit verification code has been sent to your registered email ({$maskedEmail}).",
                'masked_email' => $maskedEmail
            ]);
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error("Vendor forgot mail error: " . $e->getMessage());
            \Illuminate\Support\Facades\Log::info("Vendor forgot OTP for {$email} is: {$otp}");
            return response()->json([
                'status' => 'success',
                'msg' => "OTP generated. (Email server offline/unreachable. Dev OTP: {$otp})",
                'masked_email' => $maskedEmail,
                'dev_otp' => $otp
            ]);
        }
    }

    public function vendorVerifyForgotOtp(Request $request)
    {
        $otp = trim($request->input('otp', ''));
        if (empty($otp)) {
            return response()->json(['status' => 'error', 'msg' => 'Please enter the 6-digit OTP code.']);
        }

        $sessionOtp = session('vendor_forgot_otp');
        $sessionExpiry = session('vendor_forgot_expiry');

        if (!$sessionOtp || !$sessionExpiry) {
            return response()->json(['status' => 'error', 'msg' => 'OTP session expired. Please request a new OTP.']);
        }

        if (now()->greaterThan($sessionExpiry)) {
            session()->forget(['vendor_forgot_otp', 'vendor_forgot_email', 'vendor_forgot_login_id', 'vendor_forgot_username', 'vendor_forgot_expiry', 'vendor_forgot_verified']);
            return response()->json(['status' => 'error', 'msg' => 'The OTP code has expired. Please request a new OTP.']);
        }

        if ((string) $otp !== (string) $sessionOtp) {
            return response()->json(['status' => 'error', 'msg' => 'Invalid OTP code. Please check and try again.']);
        }

        session(['vendor_forgot_verified' => true]);
        return response()->json(['status' => 'success', 'msg' => 'OTP verified successfully! Please enter your new password.']);
    }

    public function vendorResetPassword(Request $request)
    {
        if (!session('vendor_forgot_verified')) {
            return response()->json(['status' => 'error', 'msg' => 'Session not verified. Please verify OTP first.']);
        }

        $newPassword = $request->input('new_password');
        $confirmPassword = $request->input('confirm_password');

        if (empty($newPassword) || empty($confirmPassword)) {
            return response()->json(['status' => 'error', 'msg' => 'Please fill in both password fields.']);
        }

        if (strlen($newPassword) < 5) {
            return response()->json(['status' => 'error', 'msg' => 'Password must be at least 5 characters long.']);
        }

        if ($newPassword !== $confirmPassword) {
            return response()->json(['status' => 'error', 'msg' => 'Passwords do not match.']);
        }

        $loginId = session('vendor_forgot_login_id');
        $username = session('vendor_forgot_username');
        $email = session('vendor_forgot_email');

        if (!empty($loginId) || !empty($username) || !empty($email)) {
            // Update users table for status = 2
            \App\Models\User::where('status', 2)
                ->where(function($q) use ($loginId, $username, $email) {
                    if ($loginId) $q->orWhere('login_id', $loginId);
                    if ($username) $q->orWhere('username', $username);
                    if ($email) $q->orWhere('email', $email);
                })->update(['password' => Hash::make($newPassword)]);

            // Update vendor_details if password column exists
            if (\Illuminate\Support\Facades\Schema::hasColumn('vendor_details', 'password')) {
                \App\Models\vendor\vendorcreate::where(function($q) use ($loginId, $email) {
                    if ($loginId) $q->orWhere('id', $loginId);
                    if ($email) $q->orWhere('email', $email)->orWhere('primary_email', $email);
                })->update(['password' => $newPassword]);
            }
        }

        $savedUsername = $username ?: $loginId;

        // Clean up session
        session()->forget(['vendor_forgot_otp', 'vendor_forgot_email', 'vendor_forgot_login_id', 'vendor_forgot_username', 'vendor_forgot_expiry', 'vendor_forgot_verified']);

        return response()->json([
            'status' => 'success',
            'msg' => 'Your password has been reset successfully! You can now log in.',
            'username' => $savedUsername
        ]);
    }
}
