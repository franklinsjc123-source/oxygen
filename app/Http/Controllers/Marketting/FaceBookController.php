<?php

namespace App\Http\Controllers\Marketting;

use App\Models\Marketting\face_book;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Flasher\Prime\FlasherInterface;

class FaceBookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fb = face_book::all();
        $sellerRequests = \App\Models\vendor\Marketting\face_book::where('is_subscribed', 1)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('layout.admin.marketing.facebook')
        ->with([
            'fb' => $fb,
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
    public function store(Request $request,  FlasherInterface $flasher)
    {
        try{
            
            $fb = new face_book();

            $fb->admin_id   = session()->get('login_id');
            $fb->amount     = $request->amount     ;
            $fb->impressions= $request->impressions;
            $fb->clicks     = $request->clicks     ;
            $fb->duration   = $request->duration   ;
            $fb->status     = $request->status     ;
            $fb->save();

            $flasher->addSuccess('Data has been saved successfully!');
            return redirect()->route('facebook.index');
        } catch(\Throwable $th) {
            $flasher->addError('Something Error!!' . $th);
            return redirect()->route('facebook.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Marketting\face_book  $face_book
     * @return \Illuminate\Http\Response
     */
    public function show(face_book $face_book)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Marketting\face_book  $face_book
     * @return \Illuminate\Http\Response
     */
    public function edit(face_book $face_book, $id)
    {
        $fb = face_book::find($id);

        //return ($face_book);
        
        if($fb)
        {
            return response()->json([

                'status'=>200,
                'fb'=>$fb
               
            ]);
        }
        else
        {
            return response()->json([

                'status'=>404,
                'message'=>'fb not found',
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Marketting\face_book  $face_book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, face_book $face_book, FlasherInterface $flasher)
    {
        try{
            
            $fbid = $request->edit_id;
            $fb =  face_book::find($fbid);
            //dd($fbid);
            $fb->admin_id   = session()->get('login_id');
            $fb->amount     = $request->editamount     ;
            $fb->impressions= $request->editimpressions;
            $fb->clicks     = $request->editclicks     ;
            $fb->duration   = $request->editduration   ;
            $fb->status     = $request->editstatus     ;
            $fb->update();

            $flasher->addSuccess('Data has been Updated successfully!');
            return redirect()->route('facebook.index');
        } catch(\Throwable $th) {
            $flasher->addError('Something Error!!' . $th);
            return redirect()->route('facebook.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Marketting\face_book  $face_book
     * @return \Illuminate\Http\Response
     */
    public function destroy(face_book $face_book, $id, FlasherInterface $flasher)
    {
        try {

            $fb = face_book::find($id);           
            $fb->delete();

            $flasher->addsuccess('Data Removed!');
            return redirect()->route('facebook.index');
        } catch(\Throwable $th) {
            $flasher->addError('Something Error!');
            return redirect()->route('facebook.index');
        }
    }
    public function changestatus(Request $request)
    {
        $fb = face_book::find($request->id);
        $fb->status = $request->status;
        $fb->save();

        return response()->json(['success' => 'Status changed successfully.']);
    }

    public function approve(Request $request)
    {
        $vendorFb = \App\Models\vendor\Marketting\face_book::find($request->id);
        if (!$vendorFb) {
            return response()->json(['status' => 404, 'message' => 'Request not found!'], 404);
        }

        $durationDays = (int) $vendorFb->duration > 0 ? (int) $vendorFb->duration : 30;
        $vendorFb->approval_status = 'Approved';
        $vendorFb->status = 1;
        $vendorFb->approved_at = now();
        $vendorFb->expires_at = now()->addDays($durationDays);
        $vendorFb->admin_notes = $request->input('admin_notes', 'Approved by Admin');
        $vendorFb->save();

        return response()->json([
            'status' => 200,
            'message' => 'Seller Facebook advertisement poster has been approved and activated!',
            'expires_at' => $vendorFb->expires_at->format('d M Y')
        ]);
    }

    public function reject(Request $request)
    {
        $vendorFb = \App\Models\vendor\Marketting\face_book::find($request->id);
        if (!$vendorFb) {
            return response()->json(['status' => 404, 'message' => 'Request not found!'], 404);
        }

        $vendorFb->approval_status = 'Rejected';
        $vendorFb->status = 0;
        $vendorFb->admin_notes = $request->input('admin_notes', 'Rejected by Admin');
        $vendorFb->save();

        return response()->json([
            'status' => 200,
            'message' => 'Seller Facebook advertisement poster has been rejected.'
        ]);
    }
}
