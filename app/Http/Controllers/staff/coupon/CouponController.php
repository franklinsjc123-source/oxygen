<?php

namespace App\Http\Controllers\staff\coupon;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\coupon\coupon;
use Flasher\Prime\FlasherInterface;


use Carbon\Carbon;
use DateTime;
use DateTimeZone;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $coupon = coupon::All();
        return view('layout.staff.coupon.coupon-create')->with('coupon', $coupon);
      //  return view('layout.admin.coupon.coupon-create')->with("package", $package);
      
        //Route::view('URI', 'viewName'); 
    }

    public function couponlisting()
    {
       //echo 1;
       //dd('yik');

       date_default_timezone_set('GMT');
			$dt = new DateTime('Asia/Kolkata');
			// $date = DateTime::createFromFormat('Y-m-d H:i:s', '2021-10-01 17:30:00', new DateTimeZone('Asia/Kolkata'));
			$t = "T";
            $dat = $dt->format('Y-m-d');
			$time = $dt->format('H:i:s');
            $date    = "$dat$t$time";
            //dd($date);
        
        $coupondata = coupon::get();
       
        return view('layout.staff.coupon.list-coupon')
        ->with([
            
            'coupondata' => $coupondata,
            "date" => $date,
			"time"  => $time
         ]);
      
        //Route::view('URI', 'viewName');
    }
   

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, FlasherInterface $flasher)
    {
        date_default_timezone_set('GMT');
        $dt = new DateTime('Asia/Kolkata');
        // $date = DateTime::createFromFormat('Y-m-d H:i:s', '2021-10-01 17:30:00', new DateTimeZone('Asia/Kolkata'));
        $t = "T";
        $dat = $dt->format('Y-m-d');
        $time = $dt->format('H:i:s');
        $date    = "$dat$t$time";

        $request->validate([
            'start_date'=> 'required|after_or_equal:' . $date,
            'end_date'=> 'required|after_or_equal:' . $date
        ]);

        $coupon = new coupon();
       
        $admin_id = session()->get('login_id');

        try {

        $coupon->admin_id = $admin_id;
        $coupon->title=$request->title;
        $coupon->coupon_code =$request->coupon_code;
        $coupon->created_by=$request->created_by;
        $coupon->discount_type =$request->discount_type ;
        $coupon->discount_amount =$request->discount_amount;
        $coupon->discount_percentage =$request->discount_percentage;
        $coupon->minimum_requirment_type=$request->minimum_requirment_type;
        $coupon->minimum_requirment_amount=$request->minimum_requirment_amount;
        $coupon->minimum_requirment_quantity=$request->minimum_requirment_quantity;
        
        $coupon->start_date =$request->start_date ;
        $coupon->end_date =$request->end_date ;
        $coupon->created_by = 1;
      //  $coupon->created_by =;
        $coupon->status=1;
        $coupon->flag =1;
       
        
   //dd($coupon);

      $coupon->save();
        $flasher->addSuccess('coupon Information has been saved successfully!');
        return redirect()->route('staffcoupon.couponlisting');
    } catch (\Throwable $th) {
        //$flasher->addError('Something Error!!');
        $flasher->addError('Something Error!! =>' . $th);
        return redirect()->route('staffcoupon.couponlisting');
    }
        

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $coupon = coupon::find($id);

        return view('layout.staff.coupon.coupon-edit')
        ->with([
          "coupon"   => $coupon
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, FlasherInterface $flasher)
    {

        date_default_timezone_set('GMT');
			$dt = new DateTime('Asia/Kolkata');
			// $date = DateTime::createFromFormat('Y-m-d H:i:s', '2021-10-01 17:30:00', new DateTimeZone('Asia/Kolkata'));
			$t = "T";
            $dat = $dt->format('Y-m-d');
			$time = $dt->format('H:i:s');
            $date    = "$dat$t$time";

            $request->validate([
                'start_date'=> 'required|after_or_equal:' . $date,
                'end_date'=> 'required|after_or_equal:' . $date
            ]);
        
        $coupon = coupon::find($id);
       
        $admin_id = session()->get('login_id');

        try {

        $coupon->admin_id = $admin_id;
        $coupon->title=$request->title;
        $coupon->coupon_code =$request->coupon_code;
        $coupon->created_by=$request->created_by;
        $coupon->discount_type =$request->discount_type;
        if($request->discount_type == "Fixed"){
            $coupon->discount_amount =$request->discount_amount;
        }else{
            $coupon->discount_percentage =$request->discount_percentage;
        }
               
        $coupon->minimum_requirment_type=$request->minimum_requirment_type;
        if($request->minimum_requirment_type == "Amount"){
        $coupon->minimum_requirment_amount=$request->minimum_requirment_amount;
        }elseif($request->minimum_requirment_type == "first no.of customers"){
            $coupon->minimum_requirment_quantity=$request->minimum_requirment_quantity;
        }
        
        
        $coupon->start_date =$request->start_date ;
        $coupon->end_date =$request->end_date ;
        $coupon->created_by = 1;
      //  $coupon->created_by =;
        $coupon->status=1;
        $coupon->flag =1;
       
        
   //dd($coupon);

      $coupon->save();
        $flasher->addSuccess('coupon Information has been saved successfully!');
        return redirect()->route('staffcoupon.couponlisting');
    } catch (\Throwable $th) {
        //$flasher->addError('Something Error!!');
        $flasher->addError('Something Error!! =>' . $th);
        return redirect()->route('staffcoupon.couponlisting');
    }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, FlasherInterface $flasher)
    {
            try {
                $coupon = coupon::find($id);
                $coupon->delete();
                $flasher->addSuccess('coupon Information has been saved successfully!');
                return redirect()->route('staffcoupon.couponlisting');
            } catch (\Throwable $th) {
                //$flasher->addError('Something Error!!');
                $flasher->addError('Something Error!! =>' . $th);
                return redirect()->route('staffcoupon.couponlisting');
            }
}
}