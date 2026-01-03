<?php

namespace App\Http\Controllers\PincodeController1;

use App\Http\Controllers\Controller;
use App\Imports\Importpincode;
use App\Models\PinCode\PinCode;
use App\Models\Route;
use App\Models\Zonal;
use Illuminate\Http\Request;
use Flasher\Prime\FlasherInterface;
use Maatwebsite\Excel\Facades\Excel;

class PincodeController1 extends Controller
{
    
    public function index()
    {
        // echo 'test';

        $pincode = PinCode::all();


        $pincode = PinCode::join('routes', 'routes.id', '=', 'pincode.route_id')
              		->join('zonals', 'zonals.id', '=', 'pincode.zonal_id')
              		->get(['pincode.id','routes.name as routename', 'zonals.name as zonalname','pincode.name', 'pincode.area','pincode.post_region','pincode.status']);



        //  print_r($pincode);die;
        $route=Route::where('status', 1)->get();
        $Zonal=Zonal::where('status', 1)->get();

        return view('layout.admin.master.pincode')
            ->with(
                [
                    "pincode" => $pincode,
                    "rdata" => $route,
                    "zone" =>$Zonal
                ]
            );
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

        $pincode->zonal_id =$request->zonal_id;
        $pincode->route_id =$request->route_id;
        $pincode->name = $request->pincode;
        $pincode->area =$request->area;
        $pincode->post_region = $request->post_regin;
        $pincode->status = $request->status ?? 1;

        $pincode->createdBy = 1;
        // print_r($pincode);exit();
        $pincode->save();
            
             $flasher->addSuccess('Data has been saved successfully!');
             return redirect()->route('pincode1.index');
        }
            catch (\Throwable $th) {
                $flasher->addError('Something Error!!' . $th);
               return redirect()->route('pincode1.index');
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
        //   return $id;
        //  $zonal = Zonal::find($id);

        //  $result = Zonal::join('pincode', 'pincode.zonal_id', '=', 'zonals.id')
        //  ->select('students.*')
        //  ->get();
        // print_r($result);




        $editroute=Route::where('status', 1)->get();
        $editZonal=Zonal::where('status', 1)->get();
        // print_r($editZonal);
        $pincodee = PinCode::find($id);

        if($pincodee)
        {
            return response()->json([

                'status'=>200,
                'pincodee'=>$pincodee,
                'editroute'=>$editroute,
                'editzonal'=>$editZonal
            ]);
        }
        else
        {
            return response()->json([

                'status'=>404,
                'message'=>'Pincode not found',
            ]);
        }


         //print_r($Pin);
        // $pincode = PinCode::all();
        // $route=Route::all();
        // // print_r($pin);
        // return view('layout.admin.master.pincode')->with(
        //     [
        //         "pincodee"=> $Pin,
        //         "pincode"=>$pincode,
        //         "data" =>$route
        //     ]);

    //    $ed = PinCode::where("id", $id);
    //    print_r($ed);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, $id)
    public function update(Request $request, $id)
    {
        //print_r($id);
        // echo'test';
        //return $id;

       //$pincode1 = PinCode::where("id", $id)->get();
         $pincode1 = PinCode::find($id);
         $input = $request->all();
        //    print_r($input);exit();
         $pincode1->update($input);
       //print_r($pincode1);
       return route('pincode1.index');

        //  return view('layout.admin.master.pincode')->with("Pincode Updated!");
            // ->with(
            //     [
            //         "pincode1" => $pincode1,
            //         "data" => $route1
            //     ]
            // );


    // $data = PinCode::where("id",$id)
    //                 -->join('routes', 'routes.id', '=', 'pincode.routeid')
    //           		->join('zonals', 'zonals.id', '=', 'pincode.zonal_id')
                    
    //           		->get();
    //                 print_r($data);

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
           
            PinCode::where("id", $id)->delete();
            // $flasher->addsuccess('Pincode Removed!');
            $flasher->addSuccess('Pincode Removed!');
            return redirect()->route('pincode1.index');
        } catch (\Throwable $th) {
            // $flasher->addError('Something Error!!');
            $flasher->addError('Something Error!!');
            return redirect()->route('pincode1.index');
        }
    }
    
     public function importpincode(Request $request,  FlasherInterface $flasher){

        
        $request->validate([
            'file'          => 'required',
            // 'extension'      => 'required|in:doc,csv,xlsx,xls,docx,ppt,odt,ods,odp',
        ]);

        
        try {

        Excel::import(new Importpincode,$request->file('file')->store('files'));

        
        $flasher->addSuccess('Pincode has been Uploaded successfully!');
        return redirect()->back();
        } catch (\Throwable $th) {
            //$flasher->addError('Something Error!!');
            $flasher->addError('Something Error!! =>' . $th);
            return redirect()->route('pincode1.index');
        }
    }
}
