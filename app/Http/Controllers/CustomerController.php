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
            session()->flash('error', 'Mobile Number Alreader Registered.');
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
            session()->flash('Success', 'Customer Registered Successfully.');

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
