<?php

namespace App\Http\Controllers\Banners;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Banners\mainslider;
use Flasher\Prime\FlasherInterface;

use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;

use Carbon\Carbon;
use DateTime;
use DateTimeZone;

class main_slidvController extends Controller
{

    private $main_image_path = "assets/images/banners/mainslider";

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


        $adbanner =   mainslider::all();       

        return view('layout.admin.banner.slider')
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
 
        // date_default_timezone_set('GMT');
        // $dt = new DateTime('Asia/Kolkata');
        // // $date = DateTime::createFromFormat('Y-m-d H:i:s', '2021-10-01 17:30:00', new DateTimeZone('Asia/Kolkata'));
        // $t = "T";
        // $dat = $dt->format('Y-m-d');
        // $time = $dt->format('H:i:s');
        // // $date    = "$dat$t$time";
        // $date    = "$dat";
        // $request->validate([
        //     'start_date'=> 'required|date|after_or_equal:' . $date,
        //     'end_date'=> 'required|date|after_or_equal:' . $date
        // ]);
        
        $main_image_path = "assets/images/banners/mainslider";   

        try {

            $adbanner = new mainslider();

           // if($request->file('mainImage'))
       // {   
            $file = $request->file('mainImage');
            $image = time().'.'.$file->getClientOriginalExtension();
            //$image = $file->getClientOriginalExtension();
            
            $img = Image::make($file->getRealPath());
            
            $img->resize(1200, 800, function ($constraint) {
                
                $constraint->aspectRatio();
                
            })->save($main_image_path.'/'.$image);
           
            
            
            //$adbanner->image =  $image;
        // }
        // else
        // {
        //     $adbanner->image ="-";
        // }

            $adbanner->admin_id    =     session()->get('login_id');
            $adbanner->title       =     strip_tags($request->title);
            $adbanner->sub_title   =     strip_tags($request->sub_title);
            $adbanner->image       =     $image    ;
            $adbanner->link        =     $request->link      ;
            $adbanner->sort        =     $request->sort      ;
            $adbanner->status      =     $request->status;


            $adbanner->save();

            $flasher->addSuccess('Banner Information has been saved successfully!');
            return redirect()->route('main_slider.index');
        } catch (\Throwable $th) {
            //$flasher->addError('Something Error!!');
            $flasher->addError('Something Error!! =>' . $th);
            return redirect()->route('main_slider.index');
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
        $adbanner = mainslider::find($id);
        
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
        // date_default_timezone_set('GMT');
        // $dt = new DateTime('Asia/Kolkata');
        // // $date = DateTime::createFromFormat('Y-m-d H:i:s', '2021-10-01 17:30:00', new DateTimeZone('Asia/Kolkata'));
        // $t = "T";
        // $dat = $dt->format('Y-m-d');
        // $time = $dt->format('H:i:s');
        // // $date    = "$dat$t$time";
        // $date    = "$dat";
        // $request->validate([
        //     // 'start_date'=> 'required|date|after_or_equal:' . $date,
        //     // 'end_date'=> 'required|date|after_or_equal:' . $date
        // ]);

        $main_image_path = "assets/images/banners/mainslider";

        try {

            $id = $request->editid;

            $adbanner = mainslider::find($id);

        if($request->file('editmainImage'))
        {   
            $file = $request->file('editmainImage');
            $image = time().'.'.$file->getClientOriginalExtension();
            //$image = $file->getClientOriginalExtension();
            
            $img = Image::make($file->getRealPath());
            
            $img->resize(1200, 800, function ($constraint) {
                
                $constraint->aspectRatio();
                
            })->save($main_image_path.'/'.$image);
            $adbanner->image =  $image;

            $dltimage = mainslider::find($id);
            // print_r($image);exit();
             $dltfile = $this->main_image_path . "/" . $dltimage->image;             
             if (file_exists($dltfile)) unlink($dltfile);

        }
        else
        {
            $adbanner->image = $request->editoldImage;
        }

            $adbanner->admin_id    =     session()->get('login_id');
            $adbanner->title       =     strip_tags($request->edittitle);
            $adbanner->sub_title   =     strip_tags($request->editsub_title);
            //$adbanner->image       =     $image    ;
            $adbanner->link        =     $request->editlink      ;
            $adbanner->sort        =     $request->editsort      ;
            $adbanner->status      =     $request->editstatus;

            $adbanner->save();

            $flasher->addSuccess('Banner Information has been Updated successfully!');
            return redirect()->route('main_slider.index');
        } catch (\Throwable $th) {
            //$flasher->addError('Something Error!!');
            $flasher->addError('Something Error!! =>' . $th);
            return redirect()->route('main_slider.index');
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
            $image = mainslider::find($id);
           // print_r($image);exit();
            $file = $this->main_image_path . "/" . $image->image;
            
            if (file_exists($file)) unlink($file);
            //dd($file);
            mainslider::where("id", $id)->delete();

            $flasher->addsuccess('Banner Removed!');
            return redirect()->route('main_slider.index');
        } catch(\Throwable $th) {
            $flasher->addError('Something Error!');
            return redirect()->route('main_slider.index');
        }
    }
}
