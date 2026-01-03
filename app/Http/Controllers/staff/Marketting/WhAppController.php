<?php

namespace App\Http\Controllers\staff\Marketting;

use App\Models\Marketting\wh_app;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Flasher\Prime\FlasherInterface;

use Intervention\Image\Facades\Image;
class WhAppController extends Controller
{

    private $main_image_path =  "assets/images/Marketting/Wh_app_template";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $whapp = wh_app::all();
        return view('layout.staff.marketing.whatsapp')
        ->with([
            'whapp' => $whapp
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
        $main_image_path = "assets/images/Marketting/Wh_app_template";   

        try {

            $wh = new wh_app();

           // if($request->file('image'))
       // {   
            $file = $request->file('image');
            
            $image = time().'.'.$file->getClientOriginalExtension();
            //$image = $file->getClientOriginalExtension();
            
            $img = Image::make($file->getRealPath());
            
            $img->resize(500, 500, function ($constraint) {
                
                $constraint->aspectRatio();
                
            })->save($main_image_path.'/'.$image);
           
            
            
            //$wh->image =  $image;
        // }
        // else
        // {
        //     $wh->image ="-";
        // }

            $wh->admin_id    =     session()->get('login_id');
            $wh->title       =     $request->title     ;
            $wh->sub_title   =     $request->sub_title ;
            $wh->line1       =     $request->line1     ;
            $wh->line2       =     $request->line2     ;
            $wh->ph_no       =     $request->ph_no     ;
            $wh->image       =      $image    ;
            $wh->status      =     $request->status;


            $wh->save();

            $flasher->addSuccess('Template Information has been saved successfully!');
            return redirect()->route('staffwhatsapp.index');
        } catch (\Throwable $th) {
            //$flasher->addError('Something Error!!');
            $flasher->addError('Something Error!! =>' . $th);
            return redirect()->route('staffwhatsapp.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Marketting\wh_app  $wh_app
     * @return \Illuminate\Http\Response
     */
    public function show(wh_app $wh_app)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Marketting\wh_app  $wh_app
     * @return \Illuminate\Http\Response
     */
    public function edit(wh_app $wh_app, $id)
    {
        $wh = wh_app::find($id);

        //return ($ox);
        
        if($wh)
        {
            return response()->json([

                'status'=>200,
                'whapp'=>$wh
               
            ]);
        }
        else
        {
            return response()->json([

                'status'=>404,
                'message'=>'oxygen not found',
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Marketting\wh_app  $wh_app
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, wh_app $wh_app, FlasherInterface $flasher)
    {
        $main_image_path = "assets/images/Marketting/Wh_app_template";   

        try {

            $whid = $request->edit_id;

            $wh = wh_app::find($whid);

            if($request->file('editimage'))
            {   
                $file = $request->file('editimage');
                $image = time().'.'.$file->getClientOriginalExtension();
                //$image = $file->getClientOriginalExtension();
                
                $img = Image::make($file->getRealPath());
                
                $img->resize(500, 500, function ($constraint) {
                    
                    $constraint->aspectRatio();
                    
                })->save($main_image_path.'/'.$image);
                $wh->image =  $image;
    
                $dltimage = wh_app::find($whid);
                // print_r($image);exit();
                 $dltfile = $this->main_image_path . "/" . $dltimage->image;             
                 if (file_exists($dltfile)) unlink($dltfile);
    
            }
            else
            {
                $wh->image = $request->oldimage;
            }

            $wh->admin_id    =     session()->get('login_id');
            $wh->title       =     $request->edittitle     ;
            $wh->sub_title   =     $request->editsub_title ;
            $wh->line1       =     $request->editline1     ;
            $wh->line2       =     $request->editline2     ;
            $wh->ph_no       =     $request->editph_no     ;
            // $wh->image       =      $image    ;
            $wh->status      =     $request->editstatus;


            $wh->save();

            $flasher->addSuccess('Template Information has been Updated successfully!');
            return redirect()->route('staffwhatsapp.index');
        } catch (\Throwable $th) {
            //$flasher->addError('Something Error!!');
            $flasher->addError('Something Error!! =>' . $th);
            return redirect()->route('staffwhatsapp.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Marketting\wh_app  $wh_app
     * @return \Illuminate\Http\Response
     */
    public function destroy(wh_app $wh_app, $id, FlasherInterface $flasher)
    {
        try {
            $image = wh_app::find($id);
           // print_r($image);exit();
            $file = $this->main_image_path . "/" . $image->image;
            
            if (file_exists($file)) unlink($file);
            //dd($file);
            wh_app::where("id", $id)->delete();

            $flasher->addsuccess('Template Removed!');
            return redirect()->route('staffwhatsapp.index');
        } catch(\Throwable $th) {
            $flasher->addError('Something Error!');
            return redirect()->route('staffwhatsapp.index');
        }
    }
}
