<?php

namespace App\Http\Controllers;

use App\Models\Roll;
use Illuminate\Http\Request;
use Flasher\Prime\FlasherInterface;

use App\Models\Departments;

use App\Models\designation\designation;

class RollController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
            $roll  =  Roll::join('designation', 'designation.id', '=', 'rolls.roll')
            ->select('*','rolls.id as roll_id', 'rolls.description as rolldescription' )
            ->get();
            $department   =  Departments::where('status', 1)->get();
            $designation = designation::where('status', 1)->get(); 
        return view('layout.admin.role.role-create')->
        with([
            "roll" => $roll,
             "department" => $department,
             "designation" => $designation 
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
        try{
        $roll  =  new Roll();
        //json_encode($request->value)
       // return($roll);
        $roll->roll             =     $request->role;
        $roll->description      =     $request->description;                       
        $roll->permission_id    =     json_encode($request->permission);
;
       // dd($request->permission);
       // $roll->status           =     $request->status;

        $roll->save();
        
        $flasher->addSuccess('department Updated!');
        return redirect()->route('roll.index');
    } catch (\Throwable $th) {
        // $flasher->addError('Something Error!!');
        $flasher->addError('Something Error!!');
        return redirect()->route('roll.index');
     }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Roll  $roll
     * @return \Illuminate\Http\Response
     */
    public function show(Roll $roll)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Roll  $roll
     * @return \Illuminate\Http\Response
     */
    public function edit( $id)
    {

        //dd ($roll);
        $role = Roll::find($id);

        //$id =  $roll;
        // print_r($zone_data);die;
        return response()->json([
            'roll'=>$role
             //$zone_data
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Roll  $roll
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $roll, FlasherInterface $flasher)
    {
       // return ($roll);
       $roll_id = $request->role_id;
        try{
        $roll = Roll::find($roll_id);
    //    $Departments->name = $request->editname;
    // $Departments->status = $request->editstatus;
  
    //$input  =  $request->all();


        $roll->roll             =     $request->editrole;
        $roll->description      =     $request->editdescription;                       
        $roll->permission_id    =    json_encode($request->editpermission);

        //return (json_encode($request->editpermission));
       
        $roll->update();
        $flasher->addSuccess('department Updated!');
        return redirect()->route('roll.index');
    } catch (\Throwable $th) {
        // $flasher->addError('Something Error!!');
        $flasher->addError('Something Error!!');
        return redirect()->route('roll.index');
     }
    



      
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Roll  $roll
     * @return \Illuminate\Http\Response
     */
    public function destroy( $roll, FlasherInterface $flasher)
    {
        try {
            Roll::where("id", $roll)->delete();
            $flasher->addsuccess('Designation Removed!');
            return redirect()->route('roll.index');
        } catch (\Throwable $th) {
            $flasher->addError('Something Error!!');
            return redirect()->route('roll.index');
        }    }

    public function list()
    {
        return view('layout.admin.role.role-assign');
    }
}
