<?php

namespace App\Http\Controllers\staff;

use App\Helper\ImageUploadHelper\ImageUploadHelper;
use App\Http\Controllers\Controller;
use App\Models\Offer\Offer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Flasher\Prime\FlasherInterface;

use App\Models\User;

use Carbon\Carbon;
use DateTime;
use DateTimeZone;

class OfferController extends Controller
{
    private $image_path = "assets/images/offer";
	
	public function index()
    {

				// $date->setTimezone(new DateTimeZone('Asia/Kolkata'));
				// echo $date->format('Y-m-d H:i:s');
		

					$var  = Carbon::now('Asia/Kolkata');
					 $time = $var->toTimeString();
					 $today = Carbon::today();
					// $date->format('U = Y-m-d H:i:s');
				
				
			//dd($today, $time);
					$current = Carbon::now();
					//
			date_default_timezone_set('GMT');				
			$dt = new DateTime('Asia/Kolkata');
			// $date = DateTime::createFromFormat('Y-m-d H:i:s', '2021-10-01 17:30:00', new DateTimeZone('Asia/Kolkata'));
			$date = $dt->format('Y-m-d H:i:s');
			$time = $dt->format('H:i:s');
			//dd($date, $time);
			
        $offer = Offer::get();
		// $admin_id	=	$offer->created_by_id;
		// $admin_n = User::where([['login_id', $admin_id] && ['status', 1]])->get();

		if(isset($_GET['id']))
		{
			if($_GET['id']==1) {
					return view('layout.staff.offer.offers-create');
			}
			else {		
				//$offer = Offer::get();
				return view('layout.staff.offer.offers-list')->with([
					"Offer" => $offer,					
					"date" => $date,
					"time"  => $time
				]);
			}
		}	
		else {
		
				
				return view('layout.staff.offer.offers-list')->with([
					"Offer" => $offer,					
					"date" => $date,
					"time"  => $time
				]);
		
		}
		        
    }
	

	
	
	public function create(FlasherInterface $flasher)
    {
       
		$offer_main = new Offer();
		
		
		if(isset($request)) {

				$file = $request->main_offer_image;

				if ($file !== null) $filename = ImageUploadHelper::storeImage($file, $this->image_path);

				try {
					$offer_main->title = $request->offertitle;
					$offer_main->type = $request->type;
					$offer_main->buy = $request->txtBuyOffer;
					$offer_main->getoffer = $request->txtGetOffer;
					$offer_main->cashbacktype = $request->cashback;
					if($request->cashback=="Fixed")
						$offer_main->cashbackvalue = $request->fixedcashback;
					else
						$offer_main->cashbackvalue = $request->percentagecashback;
					$offer_main->ActiveStartDate = $request->startdate;
					$offer_main->ActiveEndDate = $request->enddate;
					$offer_main->ActiveStartTime = $request->starttime;
					$offer_main->ActiveEndTime = $request->endtime;
					$offer_main->offerType = $request->offertype;
					$offer_main->backgroundimage = $filename ?? "-";
					$offer_main->textalign = $request->txtalign;
					$offer_main->value = $request->txtvalue;
					$offer_main->types = $request->types;
					//$offer_main->created_at = 1;
					//$offer_main->updated_at = getdate();
					
					//print_r($offer_main);
					
					//print_r($request->all);
					
					$offer_main->save();
					$flasher->addSuccess('Data has been saved successfully!');
					return view('layout.staff.offer.offers-list');
				} catch(\Throwable $th) {
					$flasher->addError('Something Error!!' . $th);
					return view('layout.staff.offer.offers-create');
				}
		} 		
		
		return view('layout.staff.offer.offers-create');
    }
	
    public function list()
    {
		
         return view('layout.staff.offer.offers-list');
    }
	
	public function store(Request $request, FlasherInterface $flasher)
    {
		//return ('fhjgfj');
		date_default_timezone_set('GMT');
		$dt = new DateTime('Asia/Kolkata');
		// $date = DateTime::createFromFormat('Y-m-d H:i:s', '2021-10-01 17:30:00', new DateTimeZone('Asia/Kolkata'));
		$t = "T";
		$dat = $dt->format('Y-m-d');
		$time = $dt->format('H:i:s');
		$date    = "$dat$t$time";
 
		$request->validate([
			'startdate'=> 'required|after_or_equal:' . $date,
			'enddate'=> 'required|after_or_equal:' . $request->startdate
		]);
 		
        $offer_main = new Offer();

        //        $file = $request->main_offer_image;
       // if ($file !== null) $filename = ImageUploadHelper::storeImage($file, $this->image_path);  

        try {
			$user_id = session()->get('login_id');
			$offer_main->created_by_id = $user_id;
			$offer_main->catagory_id = $request->catagory_id;
			$offer_main->product_id = $request->product_id;
            $offer_main->title = $request->offertitle;
			$offer_main->type = $request->type;

			if($request->type=="Buy X Get Y Free"){
			$offer_main->buy = $request->BuyOffer;
			$offer_main->getoffer = $request->GetOffer1;
			}else{
				$offer_main->buy = $request->txtBuyOffer;
				$offer_main->getoffer = $request->txtGetOffer;
			}
			

			$offer_main->cashbacktype = $request->cashback;
			if($request->cashback=="Fixed")
				$offer_main->cashbackvalue = $request->fixedcashback;
			else
				$offer_main->cashbackvalue = $request->percentagecashback;
			$offer_main->ActiveStartDate = $request->startdate;
			$offer_main->ActiveEndDate = $request->enddate;

			// $offer_main->ActiveStartTime = $request->starttime;
			// $offer_main->ActiveEndTime = $request->endtime;

			$offer_main->discount_type = $request->discount_type;

			$offer_main->backgroundimage = $filename ?? "-";
            $offer_main->textalign = $request->txtalign;
			if($request->discount_type == "Percentage")
			$offer_main->value = $request->percent_value;
			 else
			 $offer_main->value = $request->amounttxtvalue;

            $offer_main->types = $request->types;
			$offer_main->m_p_a = $request->m_p_a;
            //$offer_main->created_at = 1;
			//$offer_main->updated_at = getdate();
            
			//print_r($offer_main);
			
			
			//formSubmit($request->all);
			
			
			$offer_main->save();
            $flasher->addSuccess('Data has been saved successfully!');
            return redirect()->route('staffoffer.main.index');
        } catch(\Throwable $th) {
            $flasher->addError('Something Error!!' . $th);
            return redirect()->route('staffoffer.main.index');
        }
    }
	
	public function edit($id,  FlasherInterface $flasher){
		try {
			$offer 	=   Offer::find($id);

			return view ('layout.staff.offer.offers-edit')->with([
				'offer' => $offer
			]);

		} catch(\Throwable $th) {
            $flasher->addError('Something Error!!');
            return redirect()->route('staffoffer.main.index');
        }
	}

public function update($id, Request $request,  FlasherInterface $flasher){
	//try {

		//$user_id = session()->get('login_id');
		$offer_main 	=   Offer::find($id);

		// $offer_main->catagory_id = $request->catagory_id;
		// 	$offer_main->product_id = $request->product_id;
		$user_id = session()->get('login_id');
		$offer_main->created_by_id = $user_id;
		$offer_main->catagory_id = $request->catagory_id;
		$offer_main->product_id = $request->product_id;
		$offer_main->title = $request->offertitle;
		$offer_main->type = $request->type;

		if($request->type=="Buy X Get Y Free"){
		$offer_main->buy = $request->BuyOffer;
		$offer_main->getoffer = $request->GetOffer1;
		}else{
			$offer_main->buy = $request->txtBuyOffer;
			$offer_main->getoffer = $request->txtGetOffer;
		}
		

		$offer_main->cashbacktype = $request->cashback;
		if($request->cashback=="Fixed")
			$offer_main->cashbackvalue = $request->fixedcashback;
		else
			$offer_main->cashbackvalue = $request->percentagecashback;
		$offer_main->ActiveStartDate = $request->startdate;
		$offer_main->ActiveEndDate = $request->enddate;

		// $offer_main->ActiveStartTime = $request->starttime;
		// $offer_main->ActiveEndTime = $request->endtime;

		$offer_main->discount_type = $request->discount_type;

		$offer_main->backgroundimage = $filename ?? "-";
		$offer_main->textalign = $request->txtalign;
		if($request->discount_type == "Percentage")
		$offer_main->value = $request->percent_value;
		 else
		 $offer_main->value = $request->amounttxtvalue;

		$offer_main->types = $request->types;
		$offer_main->m_p_a = $request->m_p_a;
			$offer_main->update();
		// $offer->update($input);

		return redirect()->route('staffoffer.main.index');

	// } catch(\Throwable $th) {
	// 	$flasher->addError('Something Error!!');
	// 	return redirect()->route('offer.main.index');
	// }

}

	
	public function destroy($id, FlasherInterface $flasher)
    {
        try {
            Offer::where("id", $id)->delete();
            $flasher->addsuccess('Offer Removed!');
            return redirect()->route('staffoffer.main.index');
        } catch(\Throwable $th) {
            $flasher->addError('Something Error!!');
            return redirect()->route('staffoffer.main.index');
        }
    }
	
}