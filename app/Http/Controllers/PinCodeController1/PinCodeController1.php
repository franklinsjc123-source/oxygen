<?php

namespace App\Http\Controllers\PinCodeController1;

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

        $pincode = PinCode::join('zonals', 'zonals.id', '=', 'pincode.zonal_id')
        ->get(['pincode.id', 'zonals.name as zonalname','pincode.name', 'pincode.area','pincode.post_region','pincode.status']);

      /*  $pincode = PinCode::join('routes', 'routes.id', '=', 'pincode.route_id')
              		->join('zonals', 'zonals.id', '=', 'pincode.zonal_id')
              		->get(['pincode.id','routes.name as routename', 'zonals.name as zonalname','pincode.name', 'pincode.area','pincode.post_region','pincode.status']);
*/


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
        try {
            $pincodeValue = trim((string) $request->pincode);
            $areaValue = trim((string) $request->area);

            $exists = PinCode::where('name', $pincodeValue)->exists();
            if ($exists) {
                $flasher->addError('Pincode "' . $pincodeValue . '" already exists!');
                return redirect()->route('pincode1.index');
            }

            $pincode = new PinCode();
            $pincode->zonal_id = $request->zonal_id;
            $pincode->name = $pincodeValue;
            $pincode->area = $areaValue;
            $pincode->post_region = $request->post_regin;
            $pincode->status = $request->status ?? 1;
            $pincode->createdBy = 1;
            $pincode->save();

            $flasher->addSuccess('Data has been saved successfully!');
            return redirect()->route('pincode1.index');
        } catch (\Throwable $th) {
            $flasher->addError('Something Error!! ' . $th->getMessage());
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
        $editZonal = Zonal::where('status', 1)->get();
        $pincodee = PinCode::find($id);

        if ($pincodee) {
            return response()->json([
                'status' => 200,
                'pincodee' => $pincodee,
                'editzonal' => $editZonal
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Pincode not found',
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
    public function update(Request $request, $id)
    {
        try {
            $pincode1 = PinCode::find($id);
            if (!$pincode1) {
                return response()->json(['status' => 404, 'message' => 'Pincode not found'], 404);
            }

            $pincodeValue = trim((string) ($request->name ?? $request->pincode ?? $pincode1->name));

            $exists = PinCode::where('name', $pincodeValue)->where('id', '!=', $id)->exists();
            if ($exists) {
                return response()->json(['status' => 400, 'message' => 'Pincode "' . $pincodeValue . '" already exists!'], 400);
            }

            $pincode1->name = $pincodeValue;
            if ($request->has('zonal_id')) $pincode1->zonal_id = $request->zonal_id;
            if ($request->has('area')) $pincode1->area = $request->area;
            if ($request->has('post_region')) $pincode1->post_region = $request->post_region;
            if ($request->has('status')) $pincode1->status = $request->status;
            $pincode1->save();

            return response()->json(['status' => 200, 'message' => 'Pincode Updated!']);
        } catch (\Throwable $th) {
            return response()->json(['status' => 500, 'message' => 'Something Error!! ' . $th->getMessage()], 500);
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
    public function changestatus(Request $request)
    {
        $pincode = PinCode::find($request->id);
        $pincode->status = $request->status;
        $pincode->save();

        return response()->json(['success' => 'Status changed successfully.']);
    }

    public function checkduplicate(Request $request)
    {
        $pincode = trim((string) $request->pincode);
        $id = $request->id;

        if (empty($pincode)) {
            return response()->json(['exists' => false]);
        }

        $query = PinCode::where('name', $pincode);
        if ($id) {
            $query->where('id', '!=', $id);
        }

        $exists = $query->exists();

        return response()->json([
            'exists' => $exists,
            'message' => $exists ? 'Pincode "' . $pincode . '" already exists!' : ''
        ]);
    }
}
