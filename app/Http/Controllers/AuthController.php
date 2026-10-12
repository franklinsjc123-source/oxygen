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
        $remember = $request->boolean('remember');
        
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

                if ($remember) {
                    Cookie::queue('remember_admin_username', $request->username, 60 * 24 * 30);
                    Cookie::queue('remember_admin_password', $request->password, 60 * 24 * 30);
                    Cookie::queue('remember_admin_check', '1', 60 * 24 * 30);
                } else {
                    Cookie::queue(Cookie::forget('remember_admin_username'));
                    Cookie::queue(Cookie::forget('remember_admin_password'));
                    Cookie::queue(Cookie::forget('remember_admin_check'));
                }

                return redirect()->route('admindashboard', $user->admin_id);
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
        $remember = $request->boolean('remember');
        
        if (auth()->attempt($data, $remember)) {
            $user = Auth::user();
            if ($user->status == 2) {
                FacadesSession::put('username', $data['username']);
                FacadesSession::put('userId', $user->id);
                FacadesSession::put('status', $user->status);
                FacadesSession::put('login_id', $user->login_id);
                FacadesSession::put('log_name', $user->name);
                FacadesSession::put('log_type', $user->log_type ?? 'Vendor');

                if ($remember) {
                    Cookie::queue('remember_vendor_username', $request->username, 60 * 24 * 30);
                    Cookie::queue('remember_vendor_password', $request->password, 60 * 24 * 30);
                    Cookie::queue('remember_vendor_check', '1', 60 * 24 * 30);
                } else {
                    Cookie::queue(Cookie::forget('remember_vendor_username'));
                    Cookie::queue(Cookie::forget('remember_vendor_password'));
                    Cookie::queue(Cookie::forget('remember_vendor_check'));
                }
                
                return redirect()->route('vendordashboard', $user->login_id);
            } else {
                Auth::logout();
                return view('auth.vendorlogin', ['error' => 'You do not have vendor access.']);
            }
        } else {
            return view('auth.vendorlogin', ['error' => 'Invalid username or password.']);
        }
    }



    public function stafflogin(Request $request)
    {
        $data['username'] = $request->username;
        $data['password'] = $request->password;
        $remember = $request->boolean('remember');
        
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

                if ($remember) {
                    Cookie::queue('remember_staff_username', $request->username, 60 * 24 * 30);
                    Cookie::queue('remember_staff_password', $request->password, 60 * 24 * 30);
                    Cookie::queue('remember_staff_check', '1', 60 * 24 * 30);
                } else {
                    Cookie::queue(Cookie::forget('remember_staff_username'));
                    Cookie::queue(Cookie::forget('remember_staff_password'));
                    Cookie::queue(Cookie::forget('remember_staff_check'));
                }
                
                return redirect()->route('staffdashboard', $user->login_id);
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
                $redirect = '/vendor/login';
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
}
