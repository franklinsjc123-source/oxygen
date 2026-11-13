<?php

namespace App\Http\Controllers\vendor\Marketting;

use App\Models\Marketting\wh_app as masterwhapp;
use App\Models\vendor\Marketting\wh_app;
    
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
        $vendor_id = session()->get('login_id') ?? (auth()->check() ? auth()->user()->login_id : 1); 

        // Master templates uploaded by admin
        $masterTemplates = masterwhapp::where('status', 1)->get();

        // Existing templates customized by this vendor
        $vendorTemplates = wh_app::where("vendor_id", $vendor_id)->get();

        // Automatically sync any active admin templates to this seller if not yet present
        foreach ($masterTemplates as $master) {
            $exists = $vendorTemplates->first(function ($v) use ($master) {
                return $v->image === $master->image;
            });

            if (!$exists) {
                $newWh = new wh_app();
                $newWh->vendor_id  = $vendor_id;
                $newWh->title      = ($master->title && $master->title !== '-') ? $master->title : '-';
                $newWh->sub_title  = ($master->sub_title && $master->sub_title !== '-') ? $master->sub_title : '-';
                $newWh->line1      = ($master->line1 && $master->line1 !== '-') ? $master->line1 : '-';
                $newWh->line2      = ($master->line2 && $master->line2 !== '-') ? $master->line2 : '-';
                $newWh->ph_no      = ($master->ph_no && $master->ph_no !== '-') ? $master->ph_no : '-';
                $newWh->image      = $master->image;
                $newWh->status     = 1;
                $newWh->save();
            }
        }

        $whapp = wh_app::where("vendor_id", $vendor_id)->get();
        return view('layout.vendor.marketing.whatsapp')
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
            
            $img->resize(1920, 1920, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->save($main_image_path.'/'.$image, 90);
           
            
            
            //$wh->image =  $image;
        // }
        // else
        // {
        //     $wh->image ="-";
        // }

            $wh->vendor_id    =     session()->get('login_id') ?? 1;
            $wh->title       =     $request->title ?? '-';
            $wh->sub_title   =     $request->sub_title ?? '-';
            $wh->line1       =     $request->line1 ?? '-';
            $wh->line2       =     $request->line2 ?? '-';
            $wh->ph_no       =     $request->ph_no ?? '-';
            $wh->image       =     $image;
            $wh->status      =     $request->status ?? 1;


            $wh->save();

            $flasher->addSuccess('Template Information has been saved successfully!');
            return redirect()->route('vendorwhatsapp.index');
        } catch (\Throwable $th) {
            //$flasher->addError('Something Error!!');
            $flasher->addError('Something Error!! =>' . $th);
            return redirect()->route('vendorwhatsapp.index');
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

        if($wh)
        {
            return response()->json([
                'status' => 200,
                'whapp'  => $wh
            ]);
        }
        else
        {
            return response()->json([
                'status'  => 404,
                'message' => 'Template not found',
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

            if (!$wh) {
                $flasher->addError('Template not found!');
                return redirect()->route('vendorwhatsapp.index');
            }

            if($request->file('editimage'))
            {   
                $file = $request->file('editimage');
                $image = time().'.'.$file->getClientOriginalExtension();
                
                $img = Image::make($file->getRealPath());
                
                $img->resize(1920, 1920, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })->save($main_image_path.'/'.$image, 90);

                // Only delete old image if it is NOT an admin master template image
                $isMasterImage = masterwhapp::where('image', $wh->image)->exists();
                if (!$isMasterImage) {
                    $dltfile = $this->main_image_path . "/" . $wh->image;             
                    if (file_exists($dltfile)) @unlink($dltfile);
                }

                $wh->image = $image;
            }
            else
            {
                if ($request->oldimage) {
                    $wh->image = $request->oldimage;
                }
            }

            $wh->vendor_id  = session()->get('login_id') ?? 1;
            $wh->title      = $request->edittitle ?? ($wh->title ?? '-');
            $wh->sub_title  = $request->editsub_title ?? ($wh->sub_title ?? '-');
            $wh->line1      = $request->editline1 ?? ($wh->line1 ?? '-');
            $wh->line2      = $request->editline2 ?? ($wh->line2 ?? '-');
            $wh->ph_no      = $request->editph_no ?? ($wh->ph_no ?? '-');
            $wh->status     = $request->editstatus ?? ($wh->status ?? 1);

            $wh->save();

            $flasher->addSuccess('Template Information has been Updated successfully!');
            return redirect()->route('vendorwhatsapp.index');
        } catch (\Throwable $th) {
            $flasher->addError('Something Error!! =>' . $th->getMessage());
            return redirect()->route('vendorwhatsapp.index');
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
            $item = wh_app::find($id);
            if ($item) {
                // Only unlink if the image is NOT an admin master template image
                $isMasterImage = masterwhapp::where('image', $item->image)->exists();
                if (!$isMasterImage) {
                    $file = $this->main_image_path . "/" . $item->image;
                    if (file_exists($file)) @unlink($file);
                }
                $item->delete();
            }

            $flasher->addsuccess('Template Removed!');
            return redirect()->route('vendorwhatsapp.index');
        } catch(\Throwable $th) {
            $flasher->addError('Something Error!');
            return redirect()->route('vendorwhatsapp.index');
        }
    }

    public function changestatus(Request $request)
    {
        $wh = wh_app::find($request->id);
        $wh->status = $request->status;
        $wh->save();
        return response()->json(['success' => 'Status changed successfully.']);
    }
}
