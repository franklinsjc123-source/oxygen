<?php

namespace App\Http\Controllers;


use stdClass;
use App\Models\Departments;
use App\Helper\CommonHelper;
use App\Helper\ObjectHelper;
use Illuminate\Http\Request;
use App\Repository\MasterRepo;
use App\Repository\SharedRepo;
use App\Models\ViewModels\CommonReturnVM;
use App\Models\Zonal;
use App\Models\Route;
use Flasher\Prime\FlasherInterface;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
use App\Exports\routeExport;
use App\Exports\zoneExport;
use App\Exports\pincodeExport;
use Maatwebsite\Excel\Facades\Excel;

class MasterController extends Controller
{
    protected MasterRepo  $masterRepo;
    protected SharedRepo $sharedRepo;
    protected CommonHelper $commonHelper;
    protected ObjectHelper $objectHelper;

    public function __construct(
        MasterRepo $masterRepo,
        SharedRepo $sharedRepo,
        CommonHelper $commonHelper,
        ObjectHelper $objectHelper,
    ) {

        $this->masterRepo = $masterRepo;
        $this->sharedRepo = $sharedRepo;
        $this->commonHelper = $commonHelper;
        $this->objectHelper = $objectHelper;
    }
    public function department()
    {
        $viewBag['departments'] = $this->masterRepo->getAllDepartments();
        return view('layout.admin.master.department', $viewBag);
    }
    public function editdepartment($id)
    {
        $editdepartment = Departments::find($id);
        // print_r($zone_data);die;
        return response()->json([
            'editdepartment'=>$editdepartment
             //$zone_data
        ]);
        
    }
    public function departmentdelete($id, FlasherInterface $flasher )
    {
        try {
           
            Departments::where("id", $id)->delete();
            // $flasher->addsuccess('Pincode Removed!');
            $flasher->addSuccess('department Removed!');
            return redirect()->route('department');
        } catch (\Throwable $th) {
            // $flasher->addError('Something Error!!');
            $flasher->addError('Something Error!!');
            return redirect()->route('department');
         }
    }


    public function saveDepartments(Request $request)
    {
       // return  $request->all();
        $Departments = new Departments();
        //$input = $request->name();
        $Departments->name = $request->name;
        $Departments->status = $request->status;
        $Departments->save();
        return redirect()->route('department');
        // $data = (object) $request->all();
        // $result = $this->masterRepo->saveDepartments($data);
        // return $this->commonHelper->generalReturnSingleRow($result);
    }
    public function updatedepartment(FlasherInterface $flasher, Request $request, $id)
    {
        //return ('thdfiou8o');

        //dd ($id);
        try {
            $Departments = Departments::find($id);
        //    $Departments->name = $request->editname;
        // $Departments->status = $request->editstatus;
      
        $input  =  $request->all();
        //   dd($input);
            $Departments->update($input);
            $flasher->addSuccess('department Updated!');
            return redirect()->route('department');
        } catch (\Throwable $th) {
            // $flasher->addError('Something Error!!');
            $flasher->addError('Something Error!!');
            return redirect()->route('department');
         }
        
    }
    public function savePincodes(Request $request)
    {
        $data = (object) $request->all();
        $result = $this->masterRepo->savePincodes($data);
        return $this->commonHelper->generalReturnSingleRow($result);
    }
    public function designation()
    {
        
        return view('layout.admin.master.designation');
    }

    public function gst()
    {
        return view('layout.admin.master.gst');
    }

    public function package()
    {
        return view('layout.admin.master.package');
    }
    public function route_delete($id)
    {

        return view('layout.admin.master.route');
    }
    public function pincode()
    {
        $viewBag["data"] = new stdClass();
        $routeList = $this->masterRepo->getAllZonal();
        $routeListAr = $this->objectHelper->objectToArray($routeList);
        $viewBag["data"]->routeList = $this->commonHelper->convertToOption($routeListAr, '');
        return view('layout.admin.master.pincode', $viewBag);
    }

    public function route()
    {
        
        
        $viewBag["data"] = new stdClass();
        $zonalList = $this->masterRepo->getAllZonal();
        $viewBag["data"]->routeList = $this->masterRepo->getAllRoute();
        $arraymeetingTypesList = $this->objectHelper->objectToArray($zonalList);
        $viewBag["data"]->zonaList = $this->commonHelper->convertToOption($arraymeetingTypesList, '');
        $viewBag["zonal"]= Zonal::get()->all();
        return view('layout.admin.master.route', $viewBag);
    }


/*edit route*/
    public function editroute(Request $request, $id)
    {

        
        $editroute = Route::where("status", 1)->find($id);
        
        // print_r($zone_data);die;
        return response()->json([
            'editroute'=>$editroute
             //$zone_data
        ]);
    }
    /*end*/

    /*route update*/

   public function route_update(Request $request, $id)
{
    // Validate incoming data
    $validatedData = $request->validate([
        'zonal_id' => 'required|integer',
        'name' => 'required|string|max:255',
        'status' => 'required|in:1,0', // Assuming status is 1 or 0
    ]);

    // Find the route by ID and update
    $route = Route::findOrFail($id);
    $route->update($validatedData);

    // Return a success response (or redirect)
    return response()->json(['success' => true, 'message' => 'Route updated successfully!']);
}
    /*end*/
public function deleteroute($id, FlasherInterface $flasher)
    {

         try {
           
            Route::where("id", $id)->delete();
            $viewBag["data"] = new stdClass();
            $zonalList = $this->masterRepo->getAllZonal();
            $viewBag["data"]->routeList = $this->masterRepo->getAllRoute();
            $arraymeetingTypesList = $this->objectHelper->objectToArray($zonalList);
            $viewBag["data"]->zonaList = $this->commonHelper->convertToOption($arraymeetingTypesList, '');
            $viewBag["zonal"]= Zonal::get()->all();
            // $flasher->addsuccess('Pincode Removed!');
            $flasher->addSuccess('Route Removed!');
            // return redirect()->route('route');
          return view('layout.admin.master.route', $viewBag);
        } catch (\Throwable $th) {
            
            // $flasher->addError('Something Error!!');
            $flasher->addError('Something Error!!');
            return route('aroute');
            // return view('layout.admin.master.route', $viewBag);
         }
        
    }
    public function zonal()
    {
        $viewBag['result'] = $this->masterRepo->getAllZonal();
        return view('layout.admin.master.zonal', $viewBag);
    }


    public function editzonal(Request $request, $id)
    {
        $editZonal = Zonal::find($id);
        // print_r($zone_data);die;
        return response()->json([
            'editzonal'=>$editZonal
             //$zone_data
        ]);
    }
    public function updatezonal(Request $request, $id){
        $Zonal = Zonal::find($id);
        $input = $request->all();
           //print_r($input);exit();
        $Zonal->update($input);
      //print_r($pincode1);
      return route('zonal');
    }

    public function deletezonal($id, FlasherInterface $flasher){
        try {
           
            zonal::where("id", $id)->delete();
            // $flasher->addsuccess('Pincode Removed!');
            $flasher->addSuccess('zonal Removed!');
            return redirect()->route('zonal');
        } catch (\Throwable $th) {
            // $flasher->addError('Something Error!!');
            $flasher->addError('Something Error!!');
            return route('zonal');
         }
        // $Zonal = Zonal::find($id);
        // $Zonal->destroy();
        // return route('zonal');
    }
    /*Route*/
    public function getrouteById(Request $request)
        {
            
            $route_data = Route::where('zonal_id', $request->zone_id)
            ->where('status', 1)
            ->get();
            
            return response()->json(
    
               
                $route_data
    
            );
        }
    /*End*/
    public function getZonalById(Request $request)
    {
        $route_data = Route::where('id', $request->route_id)
        ->where('status', 1)
        ->first();
        $zone_data = Zonal::where('id', $route_data->zonal_id)
        ->where('status', 1)
        ->get();
        
        
        // print_r($zone_data);die;
        return response()->json(

           
            $zone_data

        );
    }

    public function saveZonals(Request $request)
    {
        // Schema::table('zonals', function (Blueprint $table) { $table->unique(["name"]); });
        $data = (object) $request->all();
        $result = $this->masterRepo->saveZonals($data);
        return $this->commonHelper->generalReturnSingleRow($result);
    }
    public function saveRoute(Request $request)
    {
        
        // Schema::table('routes', function (Blueprint $table) { $table->unique(["name"]); });
        $data = (object) $request->all();
        
        $result = $this->masterRepo->saveRoute($data);
        return $this->commonHelper->generalReturnSingleRow($result);
    }
    public function checRoutenamePost(Request $request)
    {
        $commonReturn = $this->masterRepo->checkRoutename($request->id, $request->name);
        return $commonReturn;
    }
    public function checkZonalnamePost(Request $request)
    {
        $commonReturn = $this->masterRepo->checkZonalname($request->id, $request->name);
        return $commonReturn;
    }
    public function checkDepartmentnamePost(Request $request)
    {
        $commonReturn = $this->masterRepo->checkDepartmentname($request->id, $request->name);
        return $commonReturn;
    }

    public function zonalsListingPost(Request $request)
    {
        try {
            $result = $this->masterRepo->getAllZonal();
            return $this->commonHelper->generalReturn(1, "", $result);
        } catch (\Exception $e) {
            $result = null;
            return $this->commonHelper->generalReturn(-1, $e->getMessage(), $result);
        }
    }
	public function destroy($id, FlasherInterface $flasher)
    {
        try {
            Departments::where("id", $id)->delete();
            $flasher->addsuccess('Master Department Removed!');
            return redirect()->route('layout.admin.master.department');
        } catch (\Throwable $th) {
            $flasher->addError('Something Error!!');
            return redirect()->route('layout.admin.master.department');
        }
    }
    
      /*Export route data*/
    public function get_route_data()
    {
        return Excel::download(new routeExport, 'Routereport.xlsx');
    }

    /*Export zone data*/
    public function get_zone_data()
    {
        return Excel::download(new zoneExport, 'zonereport.xlsx');
    }
      /*Export Pincode data*/
    public function get_pincode_data()
    {
        return Excel::download(new pincodeExport, 'pincodereport.xlsx');
    }
}
