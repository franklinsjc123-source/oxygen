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
        $vendor_id = session()->get('login_id') ?? (auth()->check() ? auth()->user()->login_id : 1);        

        // Master budgets from admin
        $masterBudgets = masterinsta::where('status', 1)->get();
        $vendorBudgets = insta::where("vendor_id", $vendor_id)->get();

        foreach ($masterBudgets as $master) {
            $exists = $vendorBudgets->first(function($item) use ($master) {
                return ($item->package_id && $item->package_id == $master->id) || ($item->amount == $master->amount && $item->duration == $master->duration);
            });
            if (!$exists) {
                $newInsta = new insta();
                $newInsta->vendor_id     = $vendor_id;
                $newInsta->package_id    = $master->id;
                $newInsta->amount        = $master->amount;
                $newInsta->impressions   = $master->impressions;
                $newInsta->clicks        = $master->clicks;
                $newInsta->duration      = $master->duration;
                $newInsta->status        = 0;
                $newInsta->is_subscribed = 0;
                $newInsta->image         = $master->image ?? '-';
                $newInsta->text          = $master->text ?? '-';
                $newInsta->save();
            } else if (!$exists->package_id) {
                $exists->package_id = $master->id;
                $exists->save();
            }
        }

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

    public function changestatus(Request $request)
    {
        $vendor_id = session()->get('login_id') ?? (auth()->check() ? auth()->user()->login_id : 1);
        $instagrame = insta::where('id', $request->id)->where('vendor_id', $vendor_id)->first();
        if (!$instagrame) {
            return response()->json(['error' => 'Not found'], 404);
        }
        if (!$instagrame->is_subscribed && $request->status == 1) {
            return response()->json(['error' => 'Please buy / subscribe to this package first to activate it.'], 400);
        }
        $instagrame->status = $request->status;
        $instagrame->save();
        return response()->json(['success' => 'Status changed successfully.']);
    }

    public function subscribe(Request $request)
    {
        $vendor_id = session()->get('login_id') ?? (auth()->check() ? auth()->user()->login_id : 1);
        $insta = insta::where('id', $request->id)->where('vendor_id', $vendor_id)->first();
        if (!$insta) {
            return response()->json(['status' => 404, 'message' => 'Package not found!'], 404);
        }

        $durationDays = (int) $insta->duration > 0 ? (int) $insta->duration : 30;
        $insta->is_subscribed = 1;
        $insta->status = 1;
        $insta->subscribed_at = now();
        $insta->expires_at = now()->addDays($durationDays);
        $insta->save();

        return response()->json([
            'status' => 200,
            'message' => 'Instagram Advertisement Package subscribed and activated successfully!',
            'subscribed_at' => $insta->subscribed_at ? $insta->subscribed_at->format('Y-m-d H:i') : null,
            'expires_at' => $insta->expires_at ? $insta->expires_at->format('Y-m-d H:i') : null
        ]);
    }
}
