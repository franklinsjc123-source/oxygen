<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Roll;
use App\Models\Staffcreates;
use Illuminate\Support\Facades\Session; 

// use App\Models\User;


class DashboardController extends Controller
{
    public function admindashboard()
    {
        // $login_id = session()->get('login_id','status') == 1;
        return view('layout.admin.dashboard.dashboard');
    }

    public function vendordashboard($id)
    {
       // return $id;
    //    $login_id = session()->get('login_id','status') == 1;
    //    dd($login_id);
        return view('layout.vendor.dashboard.dashboard')->with([
            'vendorid' => $id  
        ]);
    }

    public function staffdashboard($id)
    {
        //$vendor_id = Auth::user()->login_id;

        
       $Staffcreates    = Staffcreates::where('employee_id',$id )->get();
         $department =  ($Staffcreates[0]->department);
            $roll   =  Roll::where('roll', $department)->get();
                //   $roll =  ($role[0]->permission_id);
                    Session::put('roll', $roll);
                //   $staffs = json_decode($roll->permission_id);
        //return ($roll);
        return view('layout.staff.dashboard.dashboard')->with([
            'vendorid' => $id,
            // 'roll' => $roll
        ]);
    }

}
