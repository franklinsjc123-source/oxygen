<?php

namespace App\Http\Controllers\staff\Auction;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Flasher\Prime\FlasherInterface;

use App\Models\auction\auction;

use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ImportUser;
use Illuminate\Support\Facades\Validator;

use Carbon\Carbon;
use DateTime;
use DateTimeZone;

class auctionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('layout.staff.auction.create-auction');
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
                'end_date'=> 'required|after_or_equal:start_date'
            ]);

       // try{
            
            $auction   =  new auction();


            $auction->admin_id     =   session()->get('login_id');
            $auction->product_type =   $request->product_type;
            $auction->product_id   =   $request->product_id  ;
            $auction->start_price  =   $request->start_price ;
            $auction->slab         =   $request->slab        ;
            $auction->bid_price    =   $request->bid_price   ;
            $auction->start_date   =   $request->start_date  ;
            $auction->start_time   =   $request->start_time  ;
            $auction->end_date     =   $request->end_date    ;
            $auction->end_time     =   $request->end_time    ;

            $auction->save();

            $flasher->addSuccess('Data has been saved successfully!');
            return redirect()->route('staffauction/list');
        // }catch(\Throwable $th) {
        //     $flasher->addError('Something Error!!');
        //     return redirect()->route('auction/list');
        // }
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
        $auction = auction::find($id);

        return view('layout.staff.auction.auction-edit')
        ->with([
          "auction"   => $auction
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
                //'start_date'=> 'required|after_or_equal:' . $date,
                'end_date'=> 'required|after_or_equal:' . $date
            ]);


         try{
            $auction   =  auction::find($id);


            $auction->admin_id     =   session()->get('login_id');
            $auction->product_type =   $request->product_type;
            $auction->product_id   =   $request->product_id  ;
            $auction->start_price  =   $request->start_price ;
            $auction->slab         =   $request->slab        ;
            $auction->bid_price    =   $request->bid_price   ;
            $auction->start_date   =   $request->start_date  ;
            //$auction->start_time   =   $request->start_time  ;
            $auction->end_date     =   $request->end_date    ;
            //$auction->end_time     =   $request->end_time    ;

            $auction->update();

            $flasher->addSuccess('Data has been Updated successfully!');
            return redirect()->route('staffauction/list');
        }catch(\Throwable $th) {
            $flasher->addError('Something Error!!');
            return redirect()->route('staffauction/list');
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
            $auction = auction::find($id);
            $auction->delete();
            $flasher->addSuccess('auction Information has been removed successfully!');
            return redirect()->route('staffauction/list');
        } catch (\Throwable $th) {
            //$flasher->addError('Something Error!!');
            $flasher->addError('Something Error!! =>' . $th);
            return redirect()->route('staffauction/list');
        }
    }

    public function list()
    {
        date_default_timezone_set('GMT');
			$dt = new DateTime('Asia/Kolkata');
			// $date = DateTime::createFromFormat('Y-m-d H:i:s', '2021-10-01 17:30:00', new DateTimeZone('Asia/Kolkata'));
			$t = "T";
            $dat = $dt->format('Y-m-d');
			$time = $dt->format('H:i:s');
            $date    = "$dat$t$time";

        $auction   =  auction::all();

        return view('layout.staff.auction.list-auction')
        ->with([

            "auction" => $auction,
            "date" => $date,
			"time"  => $time

        ]);
    }

    public function import(Request $request,  FlasherInterface $flasher){

        // $validator = Validator::make(
        //     [
        //         'file'      => $request->file,
        //         'extension' => strtolower($request->file->getClientOriginalExtension()),
        //     ],
        //     [
        //         'file'          => 'required',
        //         'extension'      => 'required|in:doc,csv,xlsx,xls,docx,ppt,odt,ods,odp',
        //     ]
        //   );
        $request->validate([
            'file'          => 'required',
            // 'extension'      => 'required|in:doc,csv,xlsx,xls,docx,ppt,odt,ods,odp',
        ]);

        
        try {

        Excel::import(new ImportUser,$request->file('file')->store('files'));

        // $import = new ImportUser();
        // $import->startRow(2);
        // Excel::import($import, $request->file('file'));

        $flasher->addSuccess('auctions has been Uploaded successfully!');
        return redirect()->back();
        } catch (\Throwable $th) {
            //$flasher->addError('Something Error!!');
            $flasher->addError('Something Error!! =>' . $th);
            return redirect()->route('staffauction/list');
        }
    }

}
