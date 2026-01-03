<?php

namespace App\Http\Controllers\offer;

use App\Helper\ImageUploadHelper\ImageUploadHelper;
use App\Http\Controllers\Controller;
use App\Models\offer\Offer;
use Illuminate\Http\Request;
use Flasher\Prime\FlasherInterface;

use Carbon\Carbon;
use DateTime;


class OfferController extends Controller
{
	
	private $image_path = "assets/images/offer";
	
	
	public function index()
    {

		$current = Carbon::now();
		 dd($current);
		date_default_timezone_set('GMT');

$date = new DateTime();
$created_at = $date->format('U = Y-m-d H:i:s');
$unixTimestamp = time() + 1800; // 30 * 60 

$date = new DateTime();
$date->setTimestamp($unixTimestamp);
$is_expired = $date->format('U = Y-m-d H:i:s');


        $offer = Offer::get();
        return view('layout.admin.master.offer')->with("Offer", $offer);
    }
	
	
    public function create()
    {
        
		$offer_main = new Offer();
		
		
		

        $file = $request->main_offer_image;

        if ($file !== null) $filename = ImageUploadHelper::storeImage($file, $this->image_path);

        try {
            $offer_main->title = $request->offertitle;
			$offer_main->type = $request->type;
			$offer_main->buy = $request->txtBuyOffer;
			$offer_main->getoffer = $request->txtGetOffer;
			$offer_main->cashbacktype = $request->cashback;
			if($request->cashback=="fixed")
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
            $offer_main->created_at = 1;
			$offer_main->updated_at = 1;
            
			//print_r($offer_main);
			
			//formSubmit($request->all);
			
			$offer_main->save();
            $flasher->addSuccess('Data has been saved successfully!');
            return view('layout.admin.offer.offers-list');
        } catch(Throwable $th) {
            $flasher->addError('Something Error!!' . $th);
            return view('layout.admin.offer.offers-create');
        }
		
		return view('layout.admin.offer.offers-create');
    }
	
    public function list()
    {
        return view('layout.admin.offer.offers-list');
    }
	
	public function store(Request $request, FlasherInterface $flasher)
    {

        $offer_main = new Offer();

        $file = $request->main_offer_image;

        if ($file !== null) $filename = ImageUploadHelper::storeImage($file, $this->image_path);

        try {
            $offer_main->title = $request->offertitle;
			$offer_main->type = $request->type;
			$offer_main->buy = $request->txtBuyOffer;
			$offer_main->getoffer = $request->txtGetOffer;
			$offer_main->cashbacktype = $request->cashback;
			if($request->cashback=="fixed")
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
            $offer_main->created_at = 1;
			$offer_main->updated_at = 1;
            
			//print_r($offer_main);
			
			
			//formSubmit($request->all);
			
			
			$offer_main->save();
            $flasher->addSuccess('Data has been saved successfully!');
            return view('layout.admin.offer.offers-list');
        } catch(Throwable $th) {
            $flasher->addError('Something Error!!' . $th);
            return view('layout.admin.offer.offers-list');
        }
    }
	
	public function formSubmit(Request $request){

        $input = Input::all();
        $form_data = array();
		
		print_r(compact('form_data'));
        //return view('layout.admin.offer.offers-list', compact('form_data'));
    }
}
