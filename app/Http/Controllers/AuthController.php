<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Route;

use App\Helper\CommonHelper;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session as FacadesSession;

class AuthController extends Controller
{
    public function __construct(
        CommonHelper $commonHelper
    ) {
        $this->commonHelper = $commonHelper;
    }
    public function adminlogin(Request $request)
    {
//$status = $id;

        // echo Hash::make('Password!23');
        // die();

        $data['username'] = $request->username;
        $data['password'] = $request->password;
        //$data['status'] = $status;
        // dd($request);
        
            if (auth()->attempt($data)) {
                $userId = Auth::user()->id;
                //return $userId;
                $userLevel = Auth::user()->status;
                $login_id = Auth::user()->login_id;                  
                $log_name   = Auth::user()->name;                   
                $status   = Auth::user()->status;                   
                $log_type   = Auth::user()->log_type;
                $routename = Route::currentRouteName();
                if($status == 1){
                FacadesSession::put('log_name', $log_name);
                FacadesSession::put('username', $data['username']);
                FacadesSession::put('userId', $userId);
                FacadesSession::put('status', $status);
                FacadesSession::put('log_type', $log_type);
                FacadesSession::put('login_id', $login_id);

                    $id   = Auth::user()->admin_id;
                    //return $id;
                return redirect()->route('admindashboard', $id);
                }
                // elseif($status == 2)
                // {   
                //     $id   = Auth::user()->vendor_id;
                //    // return $id;
                //     return redirect()->route('vendordashboard', $id);
                
                // } 
                     else {
                return redirect()->route('/');
                    return view('auth.adminlogin');
                }                

        }       
         
         else {
            return view('auth.adminlogin');
            //return redirect('adminerror');
            $decrypted = Crypt::decryptString('$2y$10$bRNXTmZ9.kCorxD9SPIaw.hrRsme48WT/GOW6QnkNsIjTrTZKzSjW');
            //$decrypted = Crypt::decryptString('YTo0OntzOjY6Il90b2tlbiI7czo0MDoicW5oMTZDcGJRUGRmRm');
			dd($decrypted);
            try {
                $decrypted = decrypt('$2y$10$bRNXTmZ9.kCorxD9SPIaw.hrRsme48WT/GOW6QnkNsIjTrTZKzSjW');
				//$decrypted = decrypt('YTo0OntzOjY6Il90b2tlbiI7czo0MDoicW5oMTZDcGJRUGRmRm');
            } catch (DecryptException $e) {
                //
            }

            $viewBag['error'] = $decrypted;
            return view('auth.adminlogin', $viewBag);
        }
    }


    public function vendorlogin(Request $request)
    {
        //$status = $id;

        $data['username'] = $request->username;
        $data['password'] = $request->password;
        //$data['status'] = $status;
        // dd($request);
        
            if (auth()->attempt($data)) {
                $userId = Auth::user()->id;
                //return $userId;
                $userLevel = Auth::user()->level;
                $login_id = Auth::user()->login_id; 
                $status   = Auth::user()->status;
                
                $routename = Route::currentRouteName();
                // if($status == 1){
                //     //return $id;
                // return redirect()->route('admindashboard');
                // }  vendorerror
                if($status == 2){   
                    FacadesSession::put('username', $data['username']);
                FacadesSession::put('userId', $userId);
                FacadesSession::put('status', $status);
                FacadesSession::put('login_id', $login_id);
                $id   = Auth::user()->login_id;
                //return $id;
                return redirect()->route('vendordashboard', $id);
                return 'vendor';
                }else {
                    return redirect()->route('vendorerror');
                    return view('auth.vendorlogin');
                }

        }       
         
         else {
            return view('auth.vendorlogin');
            //return redirect('/login');
            $decrypted = Crypt::decryptString('$2y$10$bRNXTmZ9.kCorxD9SPIaw.hrRsme48WT/GOW6QnkNsIjTrTZKzSjW');
            //$decrypted = Crypt::decryptString('YTo0OntzOjY6Il90b2tlbiI7czo0MDoicW5oMTZDcGJRUGRmRm');
			dd($decrypted);
            try {
                $decrypted = decrypt('$2y$10$bRNXTmZ9.kCorxD9SPIaw.hrRsme48WT/GOW6QnkNsIjTrTZKzSjW');
				//$decrypted = decrypt('YTo0OntzOjY6Il90b2tlbiI7czo0MDoicW5oMTZDcGJRUGRmRm');
            } catch (DecryptException $e) {
                //
            }

            $viewBag['error'] = $decrypted;
            return view('auth.vendorlogin', $viewBag);
        }
    }



    public function stafflogin(Request $request)
    {
        //$status = $id;

        $data['username'] = $request->username;
        $data['password'] = $request->password;
        //$data['status'] = $status;
         //dd($request);
        
            if (auth()->attempt($data)) {
                $userId = Auth::user()->id;
                //return $userId;
                $userLevel = Auth::user()->level;
                $login_id   = Auth::user()->login_id;
                  
                FacadesSession::put('username', $data['username']);
                FacadesSession::put('userId', $userId);
                FacadesSession::put('level', $userLevel);
                FacadesSession::put('login_id', $login_id);
                //return 'admin';
                $status   = Auth::user()->status;
                $routename = Route::currentRouteName();
               // dd($status);
                // if($status == 1){
                //     //return $id;
                // return redirect()->route('admindashboard');
                // }  vendorerror
                if($status == 3){   
                $id   = Auth::user()->login_id;
                //return $id;
                return redirect()->route('staffdashboard', $id);
                return 'vendor';
                }else {
                    return redirect()->route('stafferror');
                    return view('auth.stafflogin');
                }

        }       
         
         else {
            return view('auth.stafflogin');
            //return redirect('/login');
            $decrypted = Crypt::decryptString('$2y$10$bRNXTmZ9.kCorxD9SPIaw.hrRsme48WT/GOW6QnkNsIjTrTZKzSjW');
            //$decrypted = Crypt::decryptString('YTo0OntzOjY6Il90b2tlbiI7czo0MDoicW5oMTZDcGJRUGRmRm');
			dd($decrypted);
            try {
                $decrypted = decrypt('$2y$10$bRNXTmZ9.kCorxD9SPIaw.hrRsme48WT/GOW6QnkNsIjTrTZKzSjW');
				//$decrypted = decrypt('YTo0OntzOjY6Il90b2tlbiI7czo0MDoicW5oMTZDcGJRUGRmRm');
            } catch (DecryptException $e) {
                //
            }

            $viewBag['error'] = $decrypted;
            return view('auth.vendorlogin', $viewBag);
        }
    }

    
    public function userlogin(Request $request)
    {
    //$status = $id;

        $data['username'] = $request->username;
        $data['password'] = $request->password;
        //$data['status'] = $status;
        // dd($request);
        
            if (auth()->attempt($data)) {
                $userId = Auth::user()->id;
                //return $userId;
                $userLevel = Auth::user()->level;
                $userstatus = Auth::user()->status;
                FacadesSession::put('username', $data['username']);
                FacadesSession::put('userId', $userId);
                FacadesSession::put('level', $userLevel);
                FacadesSession::put('status', $userstatus);
                //return 'admin';
                $status   = Auth::user()->status;
                //$routename = Route::currentRouteName();
                // if($status == 1){
                //     //return $id;
                // return redirect()->route('admindashboard');
                // }  
                if($status == 4){   
               $id   = Auth::user()->login_id;
               // return 'user';
               if($id)
               {
                return redirect()->route('home');
                //return view('website.front-end.index');

                // return redirect()->route('authhome',$id);
               
               }
               else{
                return redirect()->route('home');
                return 'user';
               }
                
                }else {
                    return view('auth.userlogin');
                }

        }       
         
         else {
            return view('auth.userlogin');
            //return redirect('/login');
            $decrypted = Crypt::decryptString('$2y$10$bRNXTmZ9.kCorxD9SPIaw.hrRsme48WT/GOW6QnkNsIjTrTZKzSjW');
            //$decrypted = Crypt::decryptString('YTo0OntzOjY6Il90b2tlbiI7czo0MDoicW5oMTZDcGJRUGRmRm');
			dd($decrypted);
            try {
                $decrypted = decrypt('$2y$10$bRNXTmZ9.kCorxD9SPIaw.hrRsme48WT/GOW6QnkNsIjTrTZKzSjW');
				//$decrypted = decrypt('YTo0OntzOjY6Il90b2tlbiI7czo0MDoicW5oMTZDcGJRUGRmRm');
            } catch (DecryptException $e) {
                //
            }

            $viewBag['error'] = $decrypted;
            return view('auth.userlogin', $viewBag);
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
        Auth::logout();
        return redirect('/');
    }
    
    public function register(Request $request)
    {
        $listAgents = ['MSIE', 'Firefox', 'Chrome', 'Safari', 'Opera', 'Netscape'];
        $userAgent = $request->header('User-Agent');
        $getUseragent = $this->commonHelper->findString($userAgent, $listAgents);
        return $getUseragent;
    }
}