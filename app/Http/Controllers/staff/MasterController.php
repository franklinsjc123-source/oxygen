<?php

namespace App\Http\Controllers\staff;

use App\Http\Controllers\Controller;
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
        return view('layout.staff.master.department', $viewBag);
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
            return redirect()->route('staffdepartment');
        } catch (\Throwable $th) {
            // $flasher->addError('Something Error!!');
            $flasher->addError('Something Error!!');
            return redirect()->route('staffdepartment');
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
        return redirect()->route('staffdepartment');
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
           
            $Departments->update($input);
            $flasher->addSuccess('department Updated!');
            return redirect()->route('staffdepartment');
        } catch (\Throwable $th) {
            // $flasher->addError('Something Error!!');
            $flasher->addError('Something Error!!');
            return redirect()->route('staffdepartment');
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
        
        return view('layout.staff.master.designation');
    }

    public function gst()
    {
        return view('layout.staff.master.gst');
    }

    public function package()
    {
        return view('layout.staff.master.package');
    }
    
    public function route_delete($id, FlasherInterface $flasher)
    {

        

        // try {
           
        //     Route::where("id", $id)->delete();
        //     // $flasher->addsuccess('Pincode Removed!');
        //     $flasher->addSuccess('Route Removed!');
        //     // return redirect()->route('route');
        //     return view('layout.admin.master.route');
        // } catch (\Throwable $th) {
        //     // $flasher->addError('Something Error!!');
        //     $flasher->addError('Something Error!!');
        //     //return route('route');
        //     return view('layout.admin.master.route');
        //  }






        // return view('layout.admin.master.route');
    }


    public function editroute(Request $request, $id)
    {
        $editroute = Route::find($id);
       
        return response()->json([
            'editroute'=>$editroute
             //$zone_data
        ]);
    }
        public function route_update( $id, Request $request){
            
             $route = Route::find($id);
             $route->zonal_id = $request->zonal_id;
             $route->name = $request->name;
            $route->status = $request->status;
            
            
             $route->update();
          
             return route('route');
         }
        
    

    public function pincode()
    {
        $viewBag["data"] = new stdClass();
        $routeList = $this->masterRepo->getAllZonal();
        $routeListAr = $this->objectHelper->objectToArray($routeList);
        $viewBag["data"]->routeList = $this->commonHelper->convertToOption($routeListAr, '');
        return view('layout.staff.master.pincode', $viewBag);
    }

    public function route()
    {
        
        // $viewBag['result'] = $this->masterRepo->getAllZonal();
        // return view('layout.staff.master.route', $viewBag);
        
        $viewBag["data"] = new stdClass();
        $zonalList = $this->masterRepo->getAllZonal();
        $viewBag["data"]->routeList = $this->masterRepo->getAllRoute();
        $arraymeetingTypesList = $this->objectHelper->objectToArray($zonalList);
        $viewBag["data"]->zonaList = $this->commonHelper->convertToOption($arraymeetingTypesList, '');
        //dd($viewBag["data"]->routeList);
        //  dd($viewBag["data"]->zonaList);
        return view('layout.staff.master.route', $viewBag);
    }
    public function deleteroute($id, FlasherInterface $flasher)
    {
         try {
           
            Route::where("id", $id)->delete();
            $viewBag["data"] = new stdClass();
        $zonalList = $this->masterRepo->getAllZonal();
        $viewBag["data"]->routeList = $this->masterRepo->getAllRoute();
        $arraymeetingTypesList = $this->objectHelper->objectToArray($zonalList);
        $viewBag["data"]->zonaList = $this->commonHelper->convertToOption($arraymeetingTypesList, '');

            // $flasher->addsuccess('Pincode Removed!');
            $flasher->addSuccess('Route Removed!');
            // return redirect()->route('route');
           return view('layout.staff.master.route', $viewBag);
        } catch (\Throwable $th) {
            // $flasher->addError('Something Error!!');
            $flasher->addError('Something Error!!');
            //return route('route');
            return view('layout.staff.master.route', $viewBag);
         }
        
    }

    public function zonal()
    {
        $viewBag['result'] = $this->masterRepo->getAllZonal();
        return view('layout.staff.master.zonal', $viewBag);
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
       //    print_r($input);exit();
        $Zonal->update($input);
      //print_r($pincode1);
      return route('staffzonal');
    }

    public function deletezonal($id, FlasherInterface $flasher){
        try {
           
            zonal::where("id", $id)->delete();
            // $flasher->addsuccess('Pincode Removed!');
            $flasher->addSuccess('zonal Removed!');
            return redirect()->route('staffzonal');
        } catch (\Throwable $th) {
            // $flasher->addError('Something Error!!');
            $flasher->addError('Something Error!!');
            return route('staffzonal');
         }
        // $Zonal = Zonal::find($id);
        // $Zonal->destroy();
        // return route('zonal');
    }

    public function getZonalById(Request $request)
    {
        $zone_data = Zonal::where('id', $request->route_id)->get();
        // print_r($zone_data);die;
        return response()->json(

           
            $zone_data

        );
    }

    public function saveZonals(Request $request)
    {
        $data = (object) $request->all();
        $result = $this->masterRepo->saveZonals($data);
        return $this->commonHelper->generalReturnSingleRow($result);
    }
    public function saveRoute(Request $request)
    {
        
        // $data = (object) $request->all();
        // $result = $this->masterRepo->saveRoute($data);
        // return $this->commonHelper->generalReturnSingleRow($result);
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
            return redirect()->route('layout.staff.master.department');
        } catch (\Throwable $th) {
            $flasher->addError('Something Error!!');
            return redirect()->route('layout.staff.master.department');
        }
    }
}
