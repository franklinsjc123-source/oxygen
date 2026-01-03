<?php

namespace App\Http\Controllers\staff\Banners;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Banners\paid_adv;
use Flasher\Prime\FlasherInterface;
//use DB;
//use Image;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use DateTime;
use DateTimeZone;

class paid_adv_banerController extends Controller
{

    private $main_image_path = "assets/images/banners/adv-baner";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        date_default_timezone_set('GMT');
        $dt = new DateTime('Asia/Kolkata');
        // $date = DateTime::createFromFormat('Y-m-d H:i:s', '2021-10-01 17:30:00', new DateTimeZone('Asia/Kolkata'));
        $t = "T";
        $dat = $dt->format('Y-m-d');
        $time = $dt->format('H:i:s');
        $date    = "$dat$t$time";


        $adbanner =  paid_adv::all();
        return view('layout.staff.banner.advbanner')
        ->with([
             'adbanner' => $adbanner,
             "date" => $date,
             "time"  => $time
        ]);
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
        
        $main_image_path = "assets/images/banners/adv-baner";   

        try {

            $adbanner = new paid_adv();

           // if($request->file('mainImage'))
       // {   
            $file = $request->file('mainImage');
            $image = time().'.'.$file->getClientOriginalExtension();
            //$image = $file->getClientOriginalExtension();
            
            $img = Image::make($file->getRealPath());
            
            $img->resize(100, 100, function ($constraint) {
                
                $constraint->aspectRatio();
                
            })->save($main_image_path.'/'.$image);
           
            
            
            //$adbanner->image =  $image;
        // }
        // else
        // {
        //     $adbanner->image ="-";
        // }

            $adbanner->admin_id    =     Session::get('login_id');
            $adbanner->title       =     $request->title     ;
            $adbanner->sub_title   =     $request->sub_title ;
            $adbanner->image       =     $image    ;
            $adbanner->link        =     $request->link      ;
            $adbanner->sort        =     $request->sort      ;
            $adbanner->start_date  =     $request->start_date;
            $adbanner->end_date    =     $request->end_date  ;

               
            $adbanner->save();

            $flasher->addSuccess('Banner Information has been saved successfully!');
            return redirect()->route('staffadvbanner.index');
        } catch (\Throwable $th) {
            //$flasher->addError('Something Error!!');
            $flasher->addError('Something Error!! =>' . $th);
            return redirect()->route('staffadvbanner.index');
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
        $adbanner = paid_adv::find($id);
        
        if($adbanner)
        {
            return response()->json([

                'status'=>200,
                'adbanner'=>$adbanner
               
            ]);
        }
        else
        {
            return response()->json([

                'status'=>404,
                'message'=>'Banner not found',
            ]);
        }
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
            //'end_date'=> 'required|after_or_equal:' . $date
        ]);

        $main_image_path = "assets/images/banners/adv-baner";

        try {

            $id = $request->editid;

            $adbanner = paid_adv::find($id);

        if($request->file('editmainImage'))
        {   
            $file = $request->file('editmainImage');
            $image = time().'.'.$file->getClientOriginalExtension();
            //$image = $file->getClientOriginalExtension();
            
            $img = Image::make($file->getRealPath());
            
            $img->resize(100, 100, function ($constraint) {
                
                $constraint->aspectRatio();
                
            })->save($main_image_path.'/'.$image);
            $adbanner->image =  $image;

            $dltimage = paid_adv::find($id);
            // print_r($image);exit();
             $dltfile = $this->main_image_path . "/" . $dltimage->image;             
             if (file_exists($dltfile)) unlink($dltfile);

        }
        else
        {
            $adbanner->image = $request->editoldImage;
        }

            $adbanner->admin_id    =     session()->get('login_id');
            $adbanner->title       =     $request->edittitle     ;
            $adbanner->sub_title   =     $request->editsub_title ;
            //$adbanner->image       =     $image    ;
            $adbanner->link        =     $request->editlink      ;
            $adbanner->sort        =     $request->editsort      ;
            $adbanner->start_date  =     $request->editstart_date;
            $adbanner->end_date    =     $request->editend_date  ;


            $adbanner->save();

            $flasher->addSuccess('Banner Information has been Updated successfully!');
            return redirect()->route('staffadvbanner.index');
        } catch (\Throwable $th) {
            //$flasher->addError('Something Error!!');
            $flasher->addError('Something Error!! =>' . $th);
            return redirect()->route('staffadvbanner.index');
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
            $image = paid_adv::find($id);
           // print_r($image);exit();
            $file = $this->main_image_path . "/" . $image->image;
            
            if (file_exists($file)) unlink($file);
//dd($file);
            paid_adv::where("id", $id)->delete();

            $flasher->addsuccess('Banner Removed!');
            return redirect()->route('staffadvbanner.index');
        } catch(\Throwable $th) {
            $flasher->addError('Something Error!');
            return redirect()->route('staffadvbanner.index');
        }
    }
}
