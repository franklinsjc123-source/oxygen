<?php

namespace App\Http\Controllers\staff;
use App\Http\Controllers\Controller;
use App\Helper\ImageUploadHelper\ImageUploadHelper;
use Illuminate\Http\Request;
use App\Models\Staffcreates;
use App\Models\Route;
use App\Models\Zonal;
use App\Models\Departments;
use App\Models\designation\designation;
use Flasher\Prime\FlasherInterface;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session as FacadesSession;

use App\Models\User;


class StaffController extends Controller
{
    private $image_path = "assets/images/staffcreate";
    public function create()
    {
        $route=Route::all();
        $Zonal=Zonal::all();
        $department = Departments::where('status', 1)->get(); 

        return view('layout.staff.staff.staff-create')
        ->with(
            [
          
                "rdata" => $route,
                "zone" =>$Zonal,
                "department" => $department
            ]
        );

        
    }
    public function list()
    {
        $Staff = Staffcreates::all();
       

        return view('layout.staff.staff.staff-list')
        ->with(
            [
                "staff" => $Staff,
                // "rdata" => $route,
                // "zone" =>$Zonal
          
            ]
        );
        
    }

    public function store(Request $request, FlasherInterface $flasher)
    {

        // $request->validate([
        //     'empid'=>'required',
        //     'username'=>'required',
        //     'fullname'=>'required'
        // ]);

        try{
            $staff = new Staffcreates();

            //print_r($staff);

        //echo $staff->employee_id = $request->empid;

         //echo $staff->username  =$request->username;
       // echo $staff->fullname   = $request->fullname;
       // echo $staff->dob  =$request->dob;
        // echo $staff->department  = $request->department;
        //echo $staff->bloodgroup   = $request->bloodgroup;

        //echo $staff->designation  = $request->designation;

        //echo $staff->mobileno   = $request->mobileno;
       // echo $staff->a_mobileno   = $request->a_mobileno;

        //echo $staff->email   = $request->email;
       // echo $staff->qualification   = $request->qualification;
       // echo $staff->doj     = $request->doj;

      //  echo $staff->permanant_addr   = $request->permanant_addr;

        
      //  echo $staff->curr_addr    = $request->curr_addr;

      //  echo $staff->password    = $request->password;
        // echo $staff->flag   = 1;

        // echo $staff->createdBy = 1;


          $emp_id = $staff->employee_id = $request->empid;
            $staff->username  =$request->username;
            $staff->fullname   = $request->fullname;
            $staff->dob  =$request->dob;
            $staff->department  = $request->department;
            $staff->designation  = $request->designation;
            $staff->mobileno   = $request->mobileno;
            $staff->a_mobileno   = $request->a_mobileno;
            $staff->email   = $request->email;
            $staff->qualification   = $request->qualification;
            $staff->exprience   = $request->experience;
            $staff->bloodgroup   = $request->bloodgroup;
            $staff->doj     = $request->doj;
            $staff->permanant_addr   = $request->permanant_addr;
            $staff->curr_addr    = $request->curr_addr;
            $staff->password    = $request->password;
        
         
             $profileimage = $request->profileimage;
             $aatherimage = $request->aatherimage;
             $pancard = $request->pancard;
             $otherdoc = $request->otherdoc;
             if ($profileimage !== null) $profileimg = ImageUploadHelper::storeImage($profileimage, $this->image_path);
             if ($aatherimage !== null) $aatherimg = ImageUploadHelper::storeImage($aatherimage, $this->image_path);
             if ($pancard !== null) $pancardimg = ImageUploadHelper::storeImage($pancard, $this->image_path);
             if ($otherdoc !== null) $otherdocimg = ImageUploadHelper::storeImage($otherdoc, $this->image_path);
             $staff->profileimage = $profileimg ?? "-";
             $staff->aatherimage = $aatherimg ?? "-";
             $staff->pancard = $pancardimg ?? "-";
             $staff->otherdoc = $otherdocimg ?? "-";
          
             $staff->monthlysalary = $request->monthlysalary;
             $staff->ctc = $request->ctc;
             $staff->dailytarget = $request->dailytarget;
             $staff->monthlytarget = $request->monthlytarget;
             $staff->zone_id = $request->zone_id;
             $staff->route_id = $request->route_id;


             $staff->flag   = 1;
             $staffregisterd    =    $staff->save();
        
        
    
             if($staffregisterd){
              //  $user = User::find($id);
                $user = new User();
                $pass   =  Hash::make($request->password);
                //$user->id = $id;
                //$user->admin_id = 0;
                $user->login_id = $emp_id;
                $user->name     = $request->fullname;
                $user->firstName = $request->department;
                $user->lastName =  $request->designation;
                $user->email =   $request->email;
                $user->username = $request->username;
                $user->password = $pass;
                $user->level = 0;
                $user->status = 3;
                $user->save();
            }else{
                //$flasher->addError('Something Error!! =>');
               return 'failde'   ;
               
            }
           
            //$staff->createdBy = 1;


           // $staff->save();
            
              $flasher->addSuccess('Data has been saved successfully!');
            //   return redirect()->route('staff.create');
            return redirect()->back();



        }
            catch (\Throwable $th) {
                 $flasher->addError('Something Error!!' . $th);
            //    return redirect()->route('staff.create');
            return redirect()->back();



            }

    }


    public function edit(Request $request,$id, FlasherInterface $flasher){
        $route=Route::all();
        $Zonal=Zonal::all();
        $staff = Staffcreates::find($id);
        $department = Departments::where('status', 1)->get(); 
        $designation = designation::where('status', 1)->get(); 

        return view('layout.staff.staff.staff-edit')
        ->with(
            [
                "staff" => $staff,
                "rdata" => $route,
                "zone" =>$Zonal,
                "department" => $department,
                "designation" => $designation

          
            ]);

    }


    public function update(Request $request, $id, FlasherInterface $flasher)
    {
       // return $id;
        // echo'test';

        $staff = Staffcreates::find($id);
        // for(i=0;i<$staff.length();i++){

        //     echo $staff->id ;
        // }
        $employee_id = $request->emp_id;
        $staff = Staffcreates::where('employee_id',$employee_id)->get();
         //print_r($staff[0]['employee_id']);exit();
          $employee_id = $staff[0]['employee_id'];
        // public function getAttributes(Request $request)
        // {
        //     $attribute_data = Attribute::where('category_sub_id', $request->sub_category_id)->get();
        //     return response()->json($attribute_data);
        // }
    
        //  $staff = new Staffcreates();
        // $staff = Staffcreates::find($employee_id);
        // print_r($staff);exit();
        // dd($request->all());
        
        if(empty($employee_id)){
            $profileimage1 = $request->profileimage;
            $aatherimage1 = $request->aatherimage;
            $pancard1 = $request->pancard;
            $otherdoc1 = $request->otherdoc;


            if ($profileimage1 !== null) $profileimg = ImageUploadHelper::storeImage($profileimage1, $this->image_path);
            if ($aatherimage1 !== null) $aatherimg = ImageUploadHelper::storeImage($aatherimage1, $this->image_path);
            if ($pancard1 !== null) $pancardimg = ImageUploadHelper::storeImage($pancard1, $this->image_path);
            if ($otherdoc1 !== null) $otherdocimg = ImageUploadHelper::storeImage($otherdoc1, $this->image_path);

            $staff->profileimage = $profileimg ?? "-";
            $staff->aatherimage = $aatherimg ?? "-";
            $staff->pancard = $pancardimg ?? "-";
            $staff->otherdoc = $otherdocimg ?? "-";
            

            

            $staff->monthlysalary = $request->monthlysalary;
            $staff->ctc = $request->ctc;
            $staff->dailytarget = $request->dailytarget;
            $staff->monthlytarget = $request->monthlytarget;
            $staff->zone_id = $request->zone_id;
            $staff->route_id = $request->route_id;
            $staff->save();
            $flasher->addSuccess('Data has been saved successfully!');
            return redirect()->route('staff-list');
        }
        else{


            // $staff = Staffcreates::find($employee_id);
            $staff = Staffcreates::where('employee_id',$employee_id)->first();
            // print_r($staff);
            //$input = $request->all();
           //    print_r($input);exit();
           //$staff1->update($input);
           //return redirect()->back();


            $profileimage = $request->profileimage;
            $aatherimage = $request->aatherimage;
            $pancard =      $request->pancard;
            $otherdoc =     $request->otherdoc;


            if ($profileimage !== null){

            $profileimg = ImageUploadHelper::storeImage($profileimage, $this->image_path);
            $staff->profileimage = $profileimg ?? "-";
            }
            if ($aatherimage !== null){
                $aatherimg = ImageUploadHelper::storeImage($aatherimage, $this->image_path);
                $staff->aatherimage = $aatherimg ?? "-";
            }
            if ($pancard !== null){
                $pancardimg = ImageUploadHelper::storeImage($pancard, $this->image_path);
                $staff->pancard = $pancardimg ?? "-";
            } 
            if ($otherdoc !== null){
                $otherdocimg = ImageUploadHelper::storeImage($otherdoc, $this->image_path);
                $staff->otherdoc = $otherdocimg ?? "-";
            } 

            
            
            
            
            if ($profileimage == null){
            $staff->profileimage =  $request->oldprofileimage; 
            }


            if ($aatherimage == null){
            $staff->aatherimage =  $request->oldaatherimage;
            } 
            
            
            if ($pancard == null){       
            $staff->pancard =       $request->oldpancard;
            }

            if ($otherdoc == null){          
            $staff->otherdoc =      $request->oldotherdoc;
            }
  

            $staff->employee_id = $request->empid;
            $staff->username  =$request->username;
            $staff->fullname   = $request->fullname;
            $staff->dob  =$request->dob;
            $staff->department  = $request->department;
            $staff->designation  = $request->designation;
            $staff->mobileno   = $request->mobileno;
            $staff->a_mobileno   = $request->a_mobileno;
            $staff->email   = $request->email;
            $staff->qualification   = $request->qualification;
            $staff->exprience   = $request->experience;
            $staff->bloodgroup   = $request->bloodgroup;
            $staff->doj     = $request->doj;
            $staff->permanant_addr   = $request->permanant_addr;
            $staff->curr_addr    = $request->curr_addr;
            $staff->password    = $request->password;



            $staff->monthlysalary = $request->monthlysalary;
            $staff->ctc = $request->ctc;
            $staff->dailytarget = $request->dailytarget;
            $staff->monthlytarget = $request->monthlytarget;
            $staff->zone_id = $request->zone_id;
            $staff->route_id = $request->route_id;
            $staffregisterd =    $staff->update();

           if($staffregisterd){


            


            // $data['username'] = $request->username;
            // $data['password'] = $request->password;
            
          
              $staff  =    User::where([['login_id', $employee_id ],['status', 3]])->get();
            //   $status   =     User::where('status', 3)->get();


              //dd($user[0]->id);
            //$data['status'] = $status;
            // dd($request);
            
              
              $user = User::find($staff[0]->id);
              $pass   =  Hash::make($request->password);
              //$user->id = $id;
              //$user->admin_id = 0;
              $user->login_id = $employee_id;
              $user->name     = $request->fullname;
              $user->firstName = $request->department;
              $user->lastName =  $request->designation;
              $user->email =   $request->email;
              $user->username = $request->username;
              $user->password = $pass;
              $user->level = 0;
              $user->status = 3;
              $user->update();
                    return redirect()->route('staff-list');
                //return 'vendor';
                    
    
                  
             
             


           
          }else{
              //$flasher->addError('Something Error!! =>');
             return 'failde'   ;
             
          }
           $flasher->addSuccess('Data has been Updated successfully!');


           return redirect()->route('staff-list');
         }

    }
    public function destroy($id, FlasherInterface $flasher){
        try {
           
            Staffcreates::where("id", $id)->delete();
            // $flasher->addsuccess('Pincode Removed!');
            $flasher->addSuccess('Staff Removed!');
            return redirect()->back();
        } catch (\Throwable $th) {
            // $flasher->addError('Something Error!!');
            $flasher->addError('Something Error!!');
            return redirect()->back();
        }
        
    }
    public function getstaffdepartment( FlasherInterface $flasher, Request $request){

        $category_data = designation::where([['department', $request->department], ['status', 1]])->get();
        return response()->json($category_data);
    }


}
