<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Flasher\Prime\FlasherInterface;

use App\Models\Zonal;
use App\Models\State;
use App\Models\City;
use App\Models\StaffActivity;
use App\Models\ActivityTracker;
use App\Models\User;
use App\Models\UserDetails;

use session;
use DB;
class ActivityTrackerController extends Controller
{
    public function index()
    {
        // List all activity trackers
        $emp='';
        $login_id = session()->get('login_id');
        $login_type = session()->get('log_type');
        if($login_type=='Admin')
        {
            $trackers = DB::table('activity_trakcers as t1')
            ->leftJoin('users as t2', 
                DB::raw('t1.createdby COLLATE utf8mb4_unicode_ci'), '=', 
                DB::raw('t2.login_id COLLATE utf8mb4_unicode_ci')
            )        
            ->select('t1.*', 't2.name as empname', 't2.login_id as empid')
            ->get();
        }
        else
        {
            $trackers = DB::table('activity_trakcers as t1')
            ->leftJoin('users as t2', 
                DB::raw('t1.createdby COLLATE utf8mb4_unicode_ci'), '=', 
                DB::raw('t2.login_id COLLATE utf8mb4_unicode_ci')
            )        
            ->select('t1.*', 't2.name as empname', 't2.login_id as empid')
            ->where('t1.createdby',$login_id)
            ->get();
        }
        $user=User::where('log_type','!=','Vendor')->get();
       // dd($user);
        return view('layout/admin/activity/index', compact('trackers','user','emp'));
    }
    public function employeeactivity(Request $request,)
    {
        // List all activity trackers
        $emp=$request->emplist;
        //dd($emp);
        $login_id = session()->get('login_id');
        $login_type = session()->get('log_type');
        if($login_type=='Admin')
        {
            $trackers = DB::table('activity_trakcers as t1')
            ->leftJoin('users as t2', 
                DB::raw('t1.createdby COLLATE utf8mb4_unicode_ci'), '=', 
                DB::raw('t2.login_id COLLATE utf8mb4_unicode_ci')
            )        
            ->select('t1.*', 't2.name as empname', 't2.login_id as empid')
            ->where('t1.createdby',$emp)
            ->get();
        }
        else
        {
            $trackers = DB::table('activity_trakcers as t1')
            ->leftJoin('users as t2', 
                DB::raw('t1.createdby COLLATE utf8mb4_unicode_ci'), '=', 
                DB::raw('t2.login_id COLLATE utf8mb4_unicode_ci')
            )        
            ->select('t1.*', 't2.name as empname', 't2.login_id as empid')
            ->where('t1.createdby',$login_id)
            ->get();
        }
        $user=User::where('log_type','!=','Vendor')->get();
       // dd($user);
        return view('layout/admin/activity/index', compact('trackers','user','emp'));
    }

    public function create()
    {
        $zone=Zonal::all();
        $State = State::all();
        $City = City::all();
         // Show form to create a new tracker
        return view('layout/admin/activity/activity-create', compact('zone','State','City'));
    }

    public function store(Request $request, FlasherInterface $flasher)
    {
        // Validate the incoming request
        /*$request->validate([
            'shopname' => 'required|string',
            'ownername' => 'required|string',
            'businesscategory' => 'required|string',
            'moble' => 'required|string',
            'alternatemobile' => 'nullable|string',
            'address1' => 'required|string',
            'address2' => 'nullable|string',
            'state' => 'required|string',
            'city' => 'required|string',
            'pincode' => 'required|string',
            'locationmap' => 'required|string',
            'zone' => 'nullable|string',
            'route' => 'nullable|string',
            'pipe' => 'nullable|string',
            'win' => 'nullable|string',
            'reference' => 'nullable|string',
            'follow-up-date' => 'required|date',
            'status' => 'required|string',
            'reason' => 'nullable|string',
        ]);*/

        // Create the new tracker
        try{
            $lastid = ActivityTracker::create([
            'shop_name' => $request->shopname,
            'owner_name' => $request->ownername,
            'business_category' => $request->businesscategory,
            'email' => $request->email,
            'mobile_number' => $request->mobile,
            'mobile_number1' => $request->alternatemobile,
            'address' => $request->address2,
            'address1' => $request->address1,
            'state' => $request->state,
            'city' => $request->city,
            'pincode' => $request->pincode,
            'location_map' => $request->locationmap,
            'zone' => $request->zone,
            'area' => $request->route,
            'pipline' => $request->pipe,
            'win' => $request->win,
            'reference' => $request->reference,
            'next_follow_date' => $request->next_follow_date,
            'createdby' => session()->get('login_id'), // Assuming you're using authentication
            'status' => $request->status,
            'reason' => $request->reason,
            'manufacturer_type' => $request->manufacturer_type,
            'manufacturer_details' => $request->manufacturer_details,
        ])->id;
        $activity=[
            'vendor_id' =>  $lastid,
            'pipline' => $request->pipe,
            'win' => $request->win,          
            'next_follow_date' => $request->next_follow_date,
            'reason' => $request->reason,
        ];
        StaffActivity::create($activity);
       // $flasher->addSuccess('Activity Tracker Created successfully!');
        return redirect()->route('activity_trackers.index')->with('success', 'Activity Tracker Created successfully');
    }
    catch (\Throwable $th) {
        $flasher->addError('Something Error!!' . $th);
       return redirect()->route('activity_trackers.index');
    }
    }
    public function show($id)
    {
        // Edit form for existing tracker
        $tracker = ActivityTracker::findOrFail($id);
        $activity=StaffActivity::where('vendor_id',$id)->get();
        $page = 'Add';
        $vid=$id;   
        return view('layout/admin/activity/activity_view', compact('tracker','activity','page','vid'));
    }

    public function edit($id)
    {
        // Edit form for existing tracker
        $tracker = ActivityTracker::findOrFail($id);
        $zone=Zonal::all();
        $State = State::all();
        $City = City::all();
      
        return view('layout/admin/activity/activity_edit', compact('tracker','zone','State','City'));
    }
    public function activityedit($id)
    {
        // Edit form for existing tracker
        $tracker = StaffActivity::findOrFail($id);
        
        $activity=StaffActivity::where('vendor_id',$tracker->vendor_id)->get();
        
        $page = 'Edit';
        $vid=$tracker->vendor_id;   
        return view('layout/admin/activity/activity_view', compact('tracker','activity','page','vid'));
    }
    public function activity(Request $request, $id)
    {
        $activity=[
            'vendor_id' =>  $id,
            'pipline' => $request->pipe,
            'win' => $request->win,          
            'next_follow_date' => $request->next_follow_date,
            'reason' => $request->reason,
        ];
        if($request->id)
        {
            $tracker = StaffActivity::findOrFail($request->id);
            $tracker->update($activity);
        }
        else
        {
            StaffActivity::create($activity);
        }
        $tracker = ActivityTracker::findOrFail($id);
        $tracker->update([            
            'pipline' => $request->pipe,
            'win' => $request->win,
            'next_follow_date' => $request->next_follow_date,
            'reason' => $request->reason,
        ]);
       
        return redirect()->route('activity_trackers.show',$id)->with('success', 'Activity Tracker Updated');
        //return redirect()->route('activity_trackers.index')->with('success', 'Activity Tracker Updated');
    }

    public function update(Request $request, $id)
    {
        //dd($request->email);// Validate incoming request
        $request->validate([
            // Same as store validation rules
        ]);

        // Update tracker data
        $tracker = ActivityTracker::findOrFail($id);
        $tracker->update([
            'shop_name' => $request->shopname,
            'owner_name' => $request->ownername,
            'business_category' => $request->businesscategory,
            'email' => $request->email,
            'mobile_number' => $request->mobile,
            'mobile_number1' => $request->alternatemobile,
            'address' => $request->address2,
            'address1' => $request->address1,
            'state' => $request->state,
            'city' => $request->city,
            'pincode' => $request->pincode,
            'location_map' => $request->locationmap,
            'zone' => $request->zone,
            'area' => $request->route,
            'pipline' => $request->pipe,
            'win' => $request->win,
            'reference' => $request->reference,
            'next_follow_date' => $request->next_follow_date,
            'createdby' => session()->get('login_id'),
            'status' => $request->status,
            'reason' => $request->reason,
            'manufacturer_type' => $request->manufacturer_type,
            'manufacturer_details' => $request->manufacturer_details,
        ]);

        return redirect()->route('activity_trackers.index')->with('success', 'Activity Tracker Updated');
    }

    public function destroy($id)
    {
        // Delete activity tracker
        $tracker = ActivityTracker::findOrFail($id);
        $tracker->delete();

        return redirect()->route('activity_trackers.index')->with('success', 'Activity Tracker Deleted');
    }
}

