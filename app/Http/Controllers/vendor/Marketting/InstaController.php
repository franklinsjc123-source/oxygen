<?php

namespace App\Http\Controllers\vendor\Marketting;

use App\Models\Marketting\insta as masterinsta;
use App\Models\vendor\Marketting\insta;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Flasher\Prime\FlasherInterface;


class InstaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vendor_id = session()->get('login_id');        
        $instagrame = insta::where("vendor_id", $vendor_id)->get();
        return view('layout.vendor.marketing.instagram')
        ->with([
            'instagrame' => $instagrame
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
            
            $instagrame = new insta();

            $instagrame->vendor_id   = session()->get('login_id');
            $instagrame->amount     = $request->amount     ;
            $instagrame->impressions= $request->impressions;
            $instagrame->clicks     = $request->clicks     ;
            $instagrame->duration   = $request->duration   ;
            $instagrame->status     = $request->status     ;
            $instagrame->save();

            $flasher->addSuccess('Data has been saved successfully!');
            return redirect()->route('vendorinstagram.index');
        } catch(\Throwable $th) {
            $flasher->addError('Something Error!!' . $th);
            return redirect()->route('vendorinstagram.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Marketting\insta  $insta
     * @return \Illuminate\Http\Response
     */
    public function show(insta $insta)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Marketting\insta  $insta
     * @return \Illuminate\Http\Response
     */
    public function edit(insta $insta, $id)
    {
        $instagrame = insta::find($id);

        //return ($insta);
        
        if($instagrame)
        {
            return response()->json([

                'status'=>200,
                'instagrame'=>$instagrame
               
            ]);
        }
        else
        {
            return response()->json([

                'status'=>404,
                'message'=>'instagrame not found',
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Marketting\insta  $insta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, insta $insta, FlasherInterface $flasher)
    {
        try{
            
            $fbid = $request->edit_id;
            $instagrame =  insta::find($fbid);
            //dd($fbid);
            $instagrame->vendor_id   = session()->get('login_id');
            $instagrame->amount     = $request->editamount     ;
            $instagrame->impressions= $request->editimpressions;
            $instagrame->clicks     = $request->editclicks     ;
            $instagrame->duration   = $request->editduration   ;
            $instagrame->status     = $request->editstatus     ;
            $instagrame->update();

            $flasher->addSuccess('Data has been Updated successfully!');
            return redirect()->route('vendorinstagram.index');
        } catch(\Throwable $th) {
            $flasher->addError('Something Error!!' . $th);
            return redirect()->route('vendorinstagram.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Marketting\insta  $insta
     * @return \Illuminate\Http\Response
     */
    public function destroy(insta $insta, $id, FlasherInterface $flasher)
    {
        try {

            $instagrame = insta::find($id);           
            $instagrame->delete();

            $flasher->addsuccess('Data Removed!');
            return redirect()->route('vendorinstagram.index');
        } catch(\Throwable $th) {
            $flasher->addError('Something Error!');
            return redirect()->route('vendorinstagram.index');
        }
    }
}
