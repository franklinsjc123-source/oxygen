<?php

// namespace App\Http\Controllers\PincodeController;
use App\Helper\ImageUploadHelper\ImageUploadHelper;
use App\Http\Controllers\Controller;
use App\Models\PinCode\PinCode;
use Illuminate\Http\Request;
use Flasher\Prime\FlasherInterface;

class PincodeController extends Controller
{
    public function index()
    {
        $pincode = PinCode::all();
        //print_r($pincode);die;
        //echo $pincode;
        //   echo'test';
          return view('layout.admin.master.pincode')->with(["pincode"=> $pincode]);
        
    }

    public function store(Request $request, FlasherInterface $flasher)
    {
       //return 'test';

        try{
            $pincode = new PinCode();
            //print_r($pincode);
        // echo $pincode->zonal_id =$request->zone_id;
        // echo $pincode->route_id =$request->route_id;
        // echo $pincode->name = $request->pincode;
        // echo $pincode->area =$request->area;
        // echo $pincode->post_region = $request->post_regin;
        // echo $pincode->status = $request->status;
        // echo $pincode->createdBy = 1;

        $pincode->zonal_id =$request->zone_id;
        $pincode->route_id =$request->route_id;
        $pincode->name = $request->pincode;
        $pincode->area =$request->area;
        $pincode->post_region = $request->post_regin;
        $pincode->status = $request->status ?? 1;

        $pincode->createdBy = 1;
        $pincode->save();
            
             $flasher->addSuccess('Data has been saved successfully!');
             return redirect()->route('pincode.index');
        }
            catch (\Throwable $th) {
                $flasher->addError('Something Error!!' . $th);
               return redirect()->route('pincode.index');
            }
            
    }



    public function destroy($id, FlasherInterface $flasher)
    {
        try {
           
            PinCode::where("id", $id)->delete();
            $flasher->addsuccess('Pincode Removed!');
            return redirect()->route('pincode.index');
        } catch (\Throwable $th) {
            $flasher->addError('Something Error!!');
            return redirect()->route('pincode.index');
        }
    }

}
