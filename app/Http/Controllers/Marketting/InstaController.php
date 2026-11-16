<?php

namespace App\Http\Controllers\Marketting;

use App\Models\Marketting\insta;
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
        $instagrame = insta::all();
        $sellerRequests = \App\Models\vendor\Marketting\insta::where('is_subscribed', 1)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('layout.admin.marketing.instagram')
        ->with([
            'instagrame' => $instagrame,
            'sellerRequests' => $sellerRequests
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

            $instagrame->admin_id   = session()->get('login_id');
            $instagrame->amount     = $request->amount     ;
            $instagrame->impressions= $request->impressions;
            $instagrame->clicks     = $request->clicks     ;
            $instagrame->duration   = $request->duration   ;
            $instagrame->status     = $request->status     ;
            $instagrame->save();

            $flasher->addSuccess('Data has been saved successfully!');
            return redirect()->route('instagram.index');
        } catch(\Throwable $th) {
            $flasher->addError('Something Error!!' . $th);
            return redirect()->route('instagram.index');
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
            $instagrame->admin_id   = session()->get('login_id');
            $instagrame->amount     = $request->editamount     ;
            $instagrame->impressions= $request->editimpressions;
            $instagrame->clicks     = $request->editclicks     ;
            $instagrame->duration   = $request->editduration   ;
            $instagrame->status     = $request->editstatus     ;
            $instagrame->update();

            $flasher->addSuccess('Data has been Updated successfully!');
            return redirect()->route('instagram.index');
        } catch(\Throwable $th) {
            $flasher->addError('Something Error!!' . $th);
            return redirect()->route('instagram.index');
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
            return redirect()->route('instagram.index');
        } catch(\Throwable $th) {
            $flasher->addError('Something Error!');
            return redirect()->route('instagram.index');
        }
    }
    public function changestatus(Request $request)
    {
        $instagrame = insta::find($request->id);
        $instagrame->status = $request->status;
        $instagrame->save();

        return response()->json(['success' => 'Status changed successfully.']);
    }

    public function approve(Request $request)
    {
        $vendorInsta = \App\Models\vendor\Marketting\insta::find($request->id);
        if (!$vendorInsta) {
            return response()->json(['status' => 404, 'message' => 'Request not found!'], 404);
        }

        $durationDays = (int) $vendorInsta->duration > 0 ? (int) $vendorInsta->duration : 30;
        $vendorInsta->approval_status = 'Approved';
        $vendorInsta->status = 1;
        $vendorInsta->approved_at = now();
        $vendorInsta->expires_at = now()->addDays($durationDays);
        $vendorInsta->admin_notes = $request->input('admin_notes', 'Approved by Admin');
        $vendorInsta->save();

        return response()->json([
            'status' => 200,
            'message' => 'Seller Instagram advertisement poster has been approved and activated!',
            'expires_at' => $vendorInsta->expires_at->format('d M Y')
        ]);
    }

    public function reject(Request $request)
    {
        $vendorInsta = \App\Models\vendor\Marketting\insta::find($request->id);
        if (!$vendorInsta) {
            return response()->json(['status' => 404, 'message' => 'Request not found!'], 404);
        }

        $vendorInsta->approval_status = 'Rejected';
        $vendorInsta->status = 0;
        $vendorInsta->admin_notes = $request->input('admin_notes', 'Rejected by Admin');
        $vendorInsta->save();

        return response()->json([
            'status' => 200,
            'message' => 'Seller Instagram advertisement poster has been rejected.'
        ]);
    }
}
