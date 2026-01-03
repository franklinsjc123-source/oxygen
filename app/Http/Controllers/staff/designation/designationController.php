<?php

namespace App\Http\Controllers\staff\designation;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Departments;
use App\Models\designation\designation;
use Flasher\Prime\FlasherInterface;
use DB;


class designationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //return 'tyuth';
           $department     =   Departments::where ('status', 1)->get();
           $desination     =   DB::table('designation')
           ->select('designation.id','designation.designation','designation.status','designation.id','departments.name')
           ->join('departments', 'departments.id', '=', 'designation.department')
           ->get();


        return view('layout.staff.master.designation')->with([
            'designation' => $desination,
            'department' => $department
        ]);

    }


    public function getdepartment(Request $request){
        $department     =   Departments::where ('status', 1)->get();
        
        return response()->json(
           
            $department

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
           $designation = new designation();
           $designation->department = $request->department;
           $designation->designation = $request->designation;
           $designation->status = $request->status;
           $designation->save();
           $flasher->addSuccess('designation Stored!'); 
           return redirect()->route('staffdesignation.master.index'); 
        } catch (\Throwable $th) {
            // $flasher->addError('Something Error!!');
            $flasher->addError(' Error!!');
            return redirect()->route('staffdesignation.master.index'); 
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
    public function edit($id, Request $request )
    {
        
        $designation = designation::find($id);
        
        return response()->json([
            'designation'=>$designation
             //$zone_data
        ]);
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
        $designation = designation::find($id);
        $input  = $request->all();
       // dd($input);
        $designation->update($input);
        return response()->json([
            'designation'=>$designation
             //$zone_data
        ]);
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
            designation::where("id", $id)->delete();
            $flasher->addsuccess('Designation Removed!');
            return redirect()->route('staffdesignation.master.index');
        } catch (\Throwable $th) {
            $flasher->addError('Something Error!!');
            return redirect()->route('staffdesignation.master.index');
        }
    }
}
