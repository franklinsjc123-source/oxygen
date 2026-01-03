<?php

namespace App\Http\Controllers\Marketting;

use App\Models\Marketting\oxygen;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Flasher\Prime\FlasherInterface;


class OxygenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $oxygen = oxygen::all();
        return view('layout.admin.marketing.oxygen')
        ->with([
            'oxygen' => $oxygen
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
            
            $ox = new oxygen();

            $ox->admin_id   = session()->get('login_id');
            $ox->amount     = $request->amount     ;
            $ox->impressions= $request->impressions;
            $ox->clicks     = $request->clicks     ;
            $ox->duration   = $request->duration   ;
            $ox->status     = $request->status     ;
            $ox->save();

            $flasher->addSuccess('Data has been saved successfully!');
            return redirect()->route('oxygen.index');
        } catch(\Throwable $th) {
            $flasher->addError('Something Error!!' . $th);
            return redirect()->route('oxygen.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Marketting\oxygen  $oxygen
     * @return \Illuminate\Http\Response
     */
    public function show(oxygen $oxygen)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Marketting\oxygen  $oxygen
     * @return \Illuminate\Http\Response
     */
    public function edit( $id)
    {
       // return ($id);
        $ox = oxygen::find($id);

        //return ($ox);
        
        if($ox)
        {
            return response()->json([

                'status'=>200,
                'oxygen'=>$ox
               
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
     * @param  \App\Models\Marketting\oxygen  $oxygen
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, oxygen $oxygen,  FlasherInterface $flasher)
    {
        try{
            
            $fbid = $request->edit_id;
            $ox =  oxygen::find($fbid);
            //dd($fbid);
            $ox->admin_id   = session()->get('login_id');
            $ox->amount     = $request->editamount     ;
            $ox->impressions= $request->editimpressions;
            $ox->clicks     = $request->editclicks     ;
            $ox->duration   = $request->editduration   ;
            $ox->status     = $request->editstatus     ;
            $ox->update();

            $flasher->addSuccess('Data has been Updated successfully!');
            return redirect()->route('oxygen.index');
        } catch(\Throwable $th) {
            $flasher->addError('Something Error!!' . $th);
            return redirect()->route('oxygen.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Marketting\oxygen  $oxygen
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id, FlasherInterface $flasher)
    {
        try {

            $ox = oxygen::find($id);           
            $ox->delete();

            $flasher->addsuccess('Data Removed!');
            return redirect()->route('oxygen.index');
        } catch(\Throwable $th) {
            $flasher->addError('Something Error!');
            return redirect()->route('oxygen.index');
        }
    }
    
}
