<?php

namespace App\Http\Controllers\vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\vendor\packages;
use App\Helper\ImageUploadHelper\ImageUploadHelper;
use Flasher\Prime\FlasherInterface;

use DB;
use Illuminate\Support\Facades\DB as FacadesDB;
class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $package = packages::all();
       // return view('layout.admin.master.gst')->with("gst", $gst);
        return view('layout.admin.master.package')->with('package',$package);
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
   //dd($request);
  
 // dd($next_packages_id);

        $package = new packages();
        

        // $IMAGE_PATH = "assets/images/vendor/package";

        // $file = $request->image;

        // $filename = ImageUploadHelper::storeImage($file, $IMAGE_PATH);

        try {
  
            $package->name = $request->name;
            // $package->image = $filename;
            $package->price = $request->price;
            $package->validity = $request->validity;
            $package->days = $request->days;
            $package->wallet  = $request->wallet;
            $package->commission  = $request->commission;
            $package->description = $request->description;
            $package->status = $request->status;
            $package->flag =1;
            $package->created_by = auth()->user()->id;
           //dd($package);
            $package->save();
            //  dd($collection);

            $flasher->addSuccess('Package has been saved successfully!');
            return redirect()->route('package.index');
        } catch (\Throwable $th) {
            $flasher->addError('Something Error!! =>' . $th);
            return redirect()->route('package.index');
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
      //  echo 'test';

        $packages = packages::find($id);
       
        if($packages)
        {
            return response()->json([

                'status'=>200,
                'packages'=>$packages
               
            ]);
        }
        else
        {
            return response()->json([

                'status'=>404,
                'message'=>'Package not found',
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
      
        $packages = packages::find($id);
        $input = $request->all();
        $packages->update($input);
        // $flasher->addSuccess('Packages Updated successfully!');
      return route('package.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, FlasherInterface $flasher)
    {
    //    echo $id;

       try {
           
        packages::where("id", $id)->delete();
        // $flasher->addsuccess('Pincode Removed!');
        $flasher->addSuccess('Packages Removed!');
        return redirect()->route('package.index');
    } catch (\Throwable $th) {
        // $flasher->addError('Something Error!!');
        $flasher->addError('Something Error!!');
        return redirect()->route('package.index');
     }
     }
}
