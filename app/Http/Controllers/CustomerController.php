<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Ecom_Product;
use App\Models\Ecom_Customer_info;
use App\Models\Ecom_Orders;
use App\Models\Ecom_Order_product;
use Image;
use Auth;
use Illuminate\Support\Facades\Session;
use DB;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }
    public function getCustomerId(Request $request)
    {
        $pId =  $request->ecom_customer_contactno;
        $productList = Ecom_Customer_info::where('customer_mobileno', $pId)->first();
        echo json_encode($productList);
    }
    public function register(Request $request)
    {
        $customer_mobileno = $request->customer_mobileno;
        $userlogin = Ecom_Customer_info::where(['customer_mobileno' => $customer_mobileno])->get();
        $count1 = $userlogin->count();


        if ($count1 > 0) {
            return response()->json(['msg' => 'Failed'], 200);
        } else {
            $statement = DB::select("SHOW TABLE STATUS LIKE 'ecom_customer_info'");
            $next_customer_id = $statement[0]->Auto_increment;
            $customer_id = "OXY-C" . str_pad($next_customer_id, 5, "0", STR_PAD_LEFT);
            $customer = new Ecom_Customer_info;
            $customer->customer_id = $customer_id;
            $customer->customer_firstname = $request->customer_name;
            $customer->customer_email = $request->customer_email;
            $customer->customer_mobileno = $request->customer_mobileno;
            $customer->customer_password = base64_encode(base64_encode($request->customer_password));
            $customer->save();
            Session::put('customer_id', $customer_id);

            $details = [

                'customer_name' => $request->customer_name,    
                'customer_email' => $request->customer_email,
                'customer_mobileno' => $request->customer_mobileno,
                'customer_password' => $request->customer_password
    
            ];
            
    
           // $sendmail= \Mail::to($request->customer_email)->send(new \App\Mail\RegisterMail($details));
    

            return response()->json(['msg' => 'Success'], 200);
        }
    }
    public function updateaddress(Request $request)
    {

        $customer_id = Session::get('customer_id');
        // customer shipping address update start
        Ecom_Customer_info::where('customer_id', $customer_id)->update(
            [
                'customer_firstname' => $request->customer_firstname,
                'customer_company_name' => $request->customer_company_name,                
                'customer_lastname' => $request->customer_lastname,
                'customer_mobileno' => $request->customer_mobileno,
                'customer_email' => $request->customer_email,
                'customer_address' => $request->customer_address,
                'customer_address1' => $request->customer_address1,
                'customer_city' => $request->customer_city,
                'customer_state' => $request->customer_state,
                'customer_pincode' => $request->customer_pincode
            ]
        );
        session()->flash('success', 'Account Details Updated Successfully.');
        return redirect('myAccount');
        
    }

    public function changepassword(Request $request)
    {

        $customer_id = Session::get('customer_id');
        Ecom_Customer_info::where('customer_id', $customer_id)->update(
            ['customer_password' => base64_encode(base64_encode($request->new_password))]
        );
        session()->flash('success', 'Password Updated Successfully.');
        return redirect('/myAccount');
      
    }

    public function loginverify(Request $request)
    {

        $username = $request->username;
        $password = base64_encode(base64_encode($request->password));
        $userlogin = Ecom_Customer_info::where(['customer_mobileno' => $username, 'customer_password' => $password])->get();
        $count1 = $userlogin->count();


        if ($count1 == 0) {


            return response()->json(['msg' => 'Failed'], 200);
        } else {
            //Session::flash('success', 'Login Successfully');
            Session::put('customer_id', $userlogin[0]->customer_id);
            Session::put('customer_name', $userlogin[0]->customer_firstname);

            return response()->json(['msg' => 'Success'], 200);
        }
    }
    public function checkEmailExists(Request $request)
    {
        $email = $request->email;
        if (empty($email)) {
            return response()->json(['status' => 'error', 'msg' => 'Please enter your email address.']);
        }

        $customer = Ecom_Customer_info::where('customer_email', $email)->first();
        if (!$customer) {
            return response()->json(['status' => 'error', 'msg' => 'No account found with this email address.']);
        }

        // Generate 6-digit OTP
        $otp = rand(100000, 999999);

        // Store OTP in session with expiry (10 minutes)
        session([
            'forgot_otp' => $otp,
            'forgot_otp_email' => $email,
            'forgot_otp_expiry' => now()->addMinutes(10),
            'forgot_otp_verified' => false,
        ]);

        // Send OTP via email
        try {
            \Illuminate\Support\Facades\Mail::to($email)->send(new \App\Mail\ForgotPasswordOtpMail($otp, $customer->customer_firstname));
        } catch (\Exception $e) {
            \Log::error("Mail sending failed: " . $e->getMessage() . "\n" . $e->getTraceAsString());
            return response()->json(['status' => 'error', 'msg' => 'Failed to send OTP email: ' . $e->getMessage()]);
        }

        return response()->json(['status' => 'success', 'msg' => 'OTP sent to your email address.']);
    }

    public function verifyForgotOtp(Request $request)
    {
        $otp = $request->otp;
        $email = $request->email;

        if (empty($otp)) {
            return response()->json(['status' => 'error', 'msg' => 'Please enter the OTP.']);
        }

        $sessionOtp = session('forgot_otp');
        $sessionEmail = session('forgot_otp_email');
        $sessionExpiry = session('forgot_otp_expiry');

        if (!$sessionOtp || !$sessionEmail) {
            return response()->json(['status' => 'error', 'msg' => 'OTP session expired. Please request a new OTP.']);
        }

        if (now()->greaterThan($sessionExpiry)) {
            session()->forget(['forgot_otp', 'forgot_otp_email', 'forgot_otp_expiry', 'forgot_otp_verified']);
            return response()->json(['status' => 'error', 'msg' => 'OTP has expired. Please request a new OTP.']);
        }

        if ($email !== $sessionEmail) {
            return response()->json(['status' => 'error', 'msg' => 'Email mismatch. Please try again.']);
        }

        if ((string) $otp !== (string) $sessionOtp) {
            return response()->json(['status' => 'error', 'msg' => 'Invalid OTP. Please check and try again.']);
        }

        // Mark OTP as verified
        session(['forgot_otp_verified' => true]);

        return response()->json(['status' => 'success', 'msg' => 'OTP verified successfully.']);
    }

    public function resetPasswordByEmail(Request $request)
    {
        $email = $request->email;
        $newPassword = $request->new_password;
        $confirmPassword = $request->confirm_password;

        if (empty($email) || empty($newPassword) || empty($confirmPassword)) {
            return response()->json(['status' => 'error', 'msg' => 'All fields are required.']);
        }

        // Check OTP was verified
        if (!session('forgot_otp_verified') || session('forgot_otp_email') !== $email) {
            return response()->json(['status' => 'error', 'msg' => 'OTP not verified. Please verify your email first.']);
        }

        if (strlen($newPassword) < 8) {
            return response()->json(['status' => 'error', 'msg' => 'Password must be at least 8 characters.']);
        }

        if ($newPassword !== $confirmPassword) {
            return response()->json(['status' => 'error', 'msg' => 'Passwords do not match.']);
        }

        $customer = Ecom_Customer_info::where('customer_email', $email)->first();
        if (!$customer) {
            return response()->json(['status' => 'error', 'msg' => 'No account found with this email address.']);
        }

        Ecom_Customer_info::where('customer_email', $email)->update([
            'customer_password' => base64_encode(base64_encode($newPassword))
        ]);

        // Clear OTP session
        session()->forget(['forgot_otp', 'forgot_otp_email', 'forgot_otp_expiry', 'forgot_otp_verified']);

        return response()->json(['status' => 'success', 'msg' => 'Password updated successfully! You can now login.']);
    }

    public function forgetmail(Request $request)
    {

        $email = $request->email;
        
        $userlogin = Ecom_Customer_info::where(['customer_email' => $email])->get();
        $count1 = $userlogin->count();


        if ($count1 == 0) {


            return response()->json(['msg' => 'Failed'], 200);
        } else {
            
            $details = [

                'customer_name' => $userlogin[0]->customer_firstname,    
                'customer_email' => $userlogin[0]->customer_email,
                'customer_mobileno' => $userlogin[0]->customer_mobileno,
                'customer_password' => base64_decode(base64_decode($userlogin[0]->customer_password))
    
            ];
            
    
            $sendmail= \Mail::to($email)->send(new \App\Mail\ForgetMail($details));
    
            return response()->json(['msg' => 'Success'], 200);
        }
    }
    public function myaccount()
    {
        $customer_id = Session::get('customer_id');
        $customer = Ecom_Customer_info::where('customer_id', $customer_id)->first();
        $orderList = Ecom_Orders::where('customer_id', $customer_id)->get();
        
        if($customer)
        return view('front_end/site/myaccount_dashboard', compact('customer', 'orderList'));    
        else
        return Redirect('/404');
    }
    public function myorders()
    {
        $customer_id = Session::get('customer_id');
        $customer = Ecom_Customer_info::where('customer_id', $customer_id)->first();
        $orderList = Ecom_Orders::where('customer_id', $customer_id)->get();
       
        if($customer)
        return view('front_end/site/myaccount_orders', compact('customer', 'orderList'));   
        else
        return Redirect('/404');
    }
    public function ordersuccess()
    {
        $orderId = Session::get('order_id');

        if ($orderId) {
            return redirect()->route('order_success', ['orders_id' => $orderId]);
        }

        return redirect('/');
    }
    public function myprofile()
    {
        $customer_id = Session::get('customer_id');
        $customer = Ecom_Customer_info::where('customer_id', $customer_id)->first();

        
        if($customer)
        return view('front_end/site/myaccount_profile', compact('customer'));
        else
        return Redirect('/404');
    }
    public function usersettings()
    {
        $customer_id = Session::get('customer_id');
        $customer = Ecom_Customer_info::where('customer_id', $customer_id)->first();

        
        if($customer)
        return view('front_end/site/myaccount_settings', compact('customer'));
        else
        return Redirect('/404');
    }
    public function viewcustomer($id)
    {
        $customer = Ecom_Customer_info::where('customer_id', $id)->first();
        $orderList = Ecom_Orders::where('customer_id', $id)->get();
        
        if($customer)
        return view('adminpanel/customerdetails', compact('customer', 'orderList'));
        else
        return Redirect('/404-PageNotFound');
    }
    public function myorder(Request $request, $id)
    {
        $customer_id = Session::get('customer_id');
        $customer = Ecom_Customer_info::where('customer_id', $customer_id)->first();

        $vieworder = Ecom_Orders::where('order_id', $id)->first();
		$order_products = Ecom_Order_product::where('order_id', $id)->get();
		
        if($vieworder)
        return view('front_end/site/myaccount_orderdetails', compact('customer','vieworder', 'order_products'));
        else
        return Redirect('/404');
    }
    public function logout()
    {
        //Auth::logout();
        Session::forget('customer_id');
        return redirect('/');
    }
    public function CheckoutLogout()
    {
        //Auth::logout();
        Session::forget('customer_id');
        return redirect('/Checkout');
    }
}
