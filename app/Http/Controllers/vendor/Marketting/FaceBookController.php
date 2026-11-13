<?php

namespace App\Http\Controllers\vendor\Marketting;

use App\Models\Marketting\face_book as masterfb;
use App\Models\vendor\Marketting\face_book;

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
        $vendor_id = session()->get('login_id') ?? (auth()->check() ? auth()->user()->login_id : 1);        

        // Master budgets from admin
        $masterBudgets = masterfb::where('status', 1)->get();
        $vendorBudgets = face_book::where("vendor_id", $vendor_id)->get();

        foreach ($masterBudgets as $master) {
            $exists = $vendorBudgets->first(function($item) use ($master) {
                return ($item->package_id && $item->package_id == $master->id) || ($item->amount == $master->amount && $item->duration == $master->duration);
            });
            if (!$exists) {
                $newFb = new face_book();
                $newFb->vendor_id     = $vendor_id;
                $newFb->package_id    = $master->id;
                $newFb->amount        = $master->amount;
                $newFb->impressions   = $master->impressions;
                $newFb->clicks        = $master->clicks;
                $newFb->duration      = $master->duration;
                $newFb->status        = 0;
                $newFb->is_subscribed = 0;
                $newFb->image         = $master->image ?? '-';
                $newFb->text          = $master->text ?? '-';
                $newFb->save();
            } else if (!$exists->package_id) {
                $exists->package_id = $master->id;
                $exists->save();
            }
        }

        $fb = face_book::where("vendor_id", $vendor_id)->get();

        return view('layout.vendor.marketing.facebook')
        ->with([
            'fb' => $fb
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

            $fb->vendor_id   = session()->get('login_id');
            $fb->amount     = $request->amount     ;
            $fb->impressions= $request->impressions;
            $fb->clicks     = $request->clicks     ;
            $fb->duration   = $request->duration   ;
            $fb->status     = $request->status     ;
            $fb->save();

            $flasher->addSuccess('Data has been saved successfully!');
            return redirect()->route('vendorfacebook.index');
        } catch(\Throwable $th) {
            $flasher->addError('Something Error!!' . $th);
            return redirect()->route('vendorfacebook.index');
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
            $fb->vendor_id   = session()->get('login_id');
            $fb->amount     = $request->editamount     ;
            $fb->impressions= $request->editimpressions;
            $fb->clicks     = $request->editclicks     ;
            $fb->duration   = $request->editduration   ;
            $fb->status     = $request->editstatus     ;
            $fb->update();

            $flasher->addSuccess('Data has been Updated successfully!');
            return redirect()->route('vendorfacebook.index');
        } catch(\Throwable $th) {
            $flasher->addError('Something Error!!' . $th);
            return redirect()->route('vendorfacebook.index');
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
            return redirect()->route('vendorfacebook.index');
        } catch(\Throwable $th) {
            $flasher->addError('Something Error!');
            return redirect()->route('vendorfacebook.index');
        }
    }

    public function changestatus(Request $request)
    {
        $vendor_id = session()->get('login_id') ?? (auth()->check() ? auth()->user()->login_id : 1);
        $fb = face_book::where('id', $request->id)->where('vendor_id', $vendor_id)->first();
        if (!$fb) {
            return response()->json(['error' => 'Not found'], 404);
        }
        if (!$fb->is_subscribed && $request->status == 1) {
            return response()->json(['error' => 'Please buy / subscribe to this package first to activate it.'], 400);
        }
        $fb->status = $request->status;
        $fb->save();
        return response()->json(['success' => 'Status changed successfully.']);
    }

    public function subscribe(Request $request)
    {
        $vendor_id = session()->get('login_id') ?? (auth()->check() ? auth()->user()->login_id : 1);
        $fb = face_book::where('id', $request->id)->where('vendor_id', $vendor_id)->first();
        if (!$fb) {
            return response()->json(['status' => 404, 'message' => 'Package not found!'], 404);
        }

        $durationDays = (int) $fb->duration > 0 ? (int) $fb->duration : 30;
        $fb->is_subscribed = 1;
        $fb->status = 1;
        $fb->subscribed_at = now();
        $fb->expires_at = now()->addDays($durationDays);
        $fb->save();

        return response()->json([
            'status' => 200,
            'message' => 'Facebook Advertisement Package subscribed and activated successfully!',
            'subscribed_at' => $fb->subscribed_at ? $fb->subscribed_at->format('Y-m-d H:i') : null,
            'expires_at' => $fb->expires_at ? $fb->expires_at->format('Y-m-d H:i') : null
        ]);
    }
}
