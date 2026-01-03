<?php

namespace App\Http\Controllers\staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;


use App\Models\vendor\packages;
use App\Models\vendor\vendorcreate;
use App\Models\Route;
use App\Models\Zonal;
use App\Helper\ImageUploadHelper\ImageUploadHelper;
use Flasher\Prime\FlasherInterface;
use DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB as FacadesDB;
class VendorcreateController extends Controller
{

   private $PROFILE_IMAGE_PATH = "assets/images/vendor/profile";
   private $GST_IMAGE_PATH = "assets/images/vendor/gst";
   private $OTHER_IMAGE_PATH = "assets/images/vendor/other";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $package = packages::All();
        $route=Route::all();
        $Zonal=Zonal::all();
        return view('layout.staff.vendor.vendor-create')->with(
        [
                "package", $package,
                "route" => $route,
                "zone" =>$Zonal
        ]
        );
    }

     public function list()
     {
        $vendorlist = vendorcreate::All();
       // return view('layout.admin.vendor.list')->with("vendorlist");
        return view('layout.staff.vendor.vendor-list')->with("vendorlist",$vendorlist);


     }
    public function Ajaxpackage(Request $request)
    {

        // return "jhgf";

        $package = $request->id;
        $getpackage = packages::where('id', $package)->first();

        $count = packages::where('id', $package)->count();


        if ($count > 0) {

            $days = $getpackage->days;
            $wallet = $getpackage->wallet;
            $commission = $getpackage->commission;
            $validity = $getpackage->validity;
            $description = $getpackage->description;
            //dd($days);
            return response()->json(['days' => $days, 'wallet' => $wallet, 'commission' => $commission, 'validity' => $validity, 'description' => $description, 'msg' => 'Success'], 200);
        } else {
            return response()->json(['msg' => 'Failed'], 200);
        }
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


        $vendor = new vendorcreate();
        $statement = FacadesDB::select("SHOW TABLE STATUS LIKE 'vendor_details'");
        $stmt = FacadesDB::select("SHOW TABLE STATUS LIKE 'users'");

       // echo $statement;
         $user_id = $statement[0]-> Auto_increment;
         $id = $stmt[0]-> Auto_increment;
    //   dd($user_id);
       // exit();

       

        $profile_file = $request->profile_image;
        $profilename = ImageUploadHelper::storeImage($profile_file, $this->PROFILE_IMAGE_PATH);

        $gst_file = $request->gst;
        $gst_file_name = ImageUploadHelper::storeImage($gst_file, $this->GST_IMAGE_PATH);

        $other_file = $request->other_documents;
        $othername = ImageUploadHelper::storeImage($other_file, $this->OTHER_IMAGE_PATH);

        try {
           /// $vendor->shop_name = $request->shop_name;
           //$vendor->id = $user_id;
         $ven = $vendor->user_id = $user_id;
            $vendor->created_by = $request->created_by;
            $vendor->username = $request->username;
            $vendor->pass = $request->pass;
            if($request->pass == $request->pass1){
                $vendor->pass1 = $request->pass1;
            }
            
            $vendor->shop_name = $request->shop_name;
            $vendor->owner_name = $request->owner_name;
            $vendor->business_category = $request->business_category;
            $vendor->email = $request->email;
            $vendor->mobile_number1 = $request->mobile_number1;
            $vendor->mobile_number2 = $request->mobile_number2;
            $vendor->address = $request->address1;
            $vendor->address1 = $request->address2;
            $vendor->state = $request->state;
            $vendor->city = $request->city;
            $vendor->pincode = $request->pincode;
            $vendor->zone = $request->zone;
            $vendor->route = $request->route;
            $vendor->location_map = $request->location_map;
            $vendor->aadhar_no = $request->aadhar_no;
            $vendor->gst_number = $request->gst_number;


            $vendor->profile_image = $profilename;
            $vendor->gst = $gst_file_name;
            $vendor->other_documents = $othername;


            $vendor->package_id = $request->package;
            // $vendor->package_name=$request->package_name;
            $vendor->purchase_date  = $request->purchase_date;
            $vendor->expired_date = $request->expired_date;
            $vendor->next_renewal_date = $request->next_renewal_date;
            
            $vendor->wallet = $request->wallet;
            $vendor->commission = $request->commission;
            $vendor->grace_days = $request->grace_days;
            $vendor->validity = $request->validity;
            $vendor->status = 1;
            $vendor->flag = 1;


            $vendor->bank_name = $request->bank_name;
            $vendor->ac_no = $request->ac_no;
            if($request->ac_no == $request->ac_no1){
            $vendor->ac_no1 = $request->ac_no1;
            }
            $vendor->ifsc = $request->ifsc;
            $vendor->upi = $request->upi;
            $vendor->option1 = $request->option1;
            $vendor->option2 = $request->option2;
            $vendor->comments = $request->comments;

            // echo $vendor;
            // exit();
          $vedorregisterd = $vendor->save();

            // VENDOR REGISTER
        if($vedorregisterd){
            $user = new User();
            $pass   =  Hash::make($request->pass1);
            //$user->id = $id;
            //$user->admin_id = 0;
            $user->login_id = $ven;
            $user->name     = $request->created_by;
            $user->firstName = $request->shop_name;
            $user->lastName =  $request->owner_name;
            $user->email =   $request->email;
            $user->username = $request->username;
            $user->password = $pass;
            $user->level = 0;
            $user->status = 2;
            $user->save();
        }else{
           return 'failde'   ;
           
        }
            $flasher->addSuccess('vendor Information has been saved successfully!');
            return redirect()->route('staffvendor-list');
        

        } catch (\Throwable $th) {
            //$flasher->addError('Something Error!!');
            $flasher->addError('Something Error!! =>' . $th);
            return redirect()->route('staffvendorcreate.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $vendorcreate = vendorcreate::find($id);

        $package = packages::All();
        $route=Route::all();
        $Zonal=Zonal::all();

        return view('layout.staff.vendor.vendor-edit')
        ->with([
           "vendorcreate" => $vendorcreate,
           "package", $package,
           "route" => $route,
           "zone" =>$Zonal
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id,  FlasherInterface $flasher)
    {
    //    $vendorupdate = vendorcreate::find($id);
      
    //    $vendor = $request->all();
    //    $vendorupdate->update($vendor);
    //   return "gyjgyj";



        $vendor = vendorcreate::find($id);
        $statement = FacadesDB::select("SHOW TABLE STATUS LIKE 'vendor_details'");
       // echo $statement;
         
    //   dd($user_id);
       // exit();

       //$user_id = $statement[0]-> Auto_increment;
       $profile_image = '';
       $gst = '';
       $other_documents = '';
    
            if(isset($request->profile_image))
            {
            
                $file = $request->profile_image;
                if ($file !== null) {
                $profile_image = ImageUploadHelper::storeImage($file, $this->PROFILE_IMAGE_PATH);
                }
            } else{
               
                $profile_image = $request->oldprofile_image;
            }
            if(isset($request->gst))
            {
            
                $file = $request->gst;
                if ($file !== null) {
                $gst = ImageUploadHelper::storeImage($file, $this->GST_IMAGE_PATH);
                }
            } else{
               
                $gst = $request->oldprofile_image;
            }
            if(isset($request->other_documents))
            {
            
                $file = $request->other_documents;
                if ($file !== null) {
                $other_documents = ImageUploadHelper::storeImage($file, $this->OTHER_IMAGE_PATH);
                }
            } else{
               
                $other_documents = $request->oldprofile_image;
            }
       // $profile_file = $request->profile_image;
       // $profilename = ImageUploadHelper::storeImage($profile_file, $this->PROFILE_IMAGE_PATH);

       // $gst_file = $request->gst;
       // $gst_file_name = ImageUploadHelper::storeImage($gst_file, $this->GST_IMAGE_PATH);

       // $other_file = $request->other_documents;
       // $othername = ImageUploadHelper::storeImage($other_file, $this->OTHER_IMAGE_PATH);

        try {
           /// $vendor->shop_name = $request->shop_name;
         
            //$vendor->user_id = $user_id;
            $vendor->created_by = $request->created_by;
            $vendor->username = $request->username;
            $vendor->pass = $request->pass;
            if($request->pass == $request->pass1){
                $vendor->pass1 = $request->pass1;
            }
            
            $vendor->shop_name = $request->shop_name;
            $vendor->owner_name = $request->owner_name;
            $vendor->business_category = $request->business_category;
            $vendor->email = $request->email;
            $vendor->mobile_number1 = $request->mobile_number1;
            $vendor->mobile_number2 = $request->mobile_number2;
            $vendor->address = $request->address1;
            $vendor->address1 = $request->address2;
            $vendor->state = $request->state;
            $vendor->city = $request->city;
            $vendor->pincode = $request->pincode;
            $vendor->zone = $request->zone;
            $vendor->route = $request->route;
            $vendor->location_map = $request->location_map;
            $vendor->aadhar_no = $request->aadhar_no;
            $vendor->gst_number = $request->gst_number;


            $vendor->profile_image = $profile_image;            
            $vendor->gst = $gst;
            $vendor->other_documents = $other_documents;


            $vendor->package_id = $request->package;
            // $vendor->package_name=$request->package_name;
            $vendor->purchase_date  = $request->purchase_date;
            $vendor->expired_date = $request->expired_date;
            $vendor->next_renewal_date = $request->next_renewal_date;
            
            $vendor->wallet = $request->wallet;
            $vendor->commission = $request->commission;
            $vendor->grace_days = $request->grace_days;
            $vendor->validity = $request->validity;
            $vendor->status = 1;
            $vendor->flag = 1;


            $vendor->bank_name = $request->bank_name;
            $vendor->ac_no = $request->ac_no;
                    $ac_no  = $request->ac_no;
                    $ac_no1  =$request->ac_no1;
            if($ac_no  == $ac_no1){
            $vendor->ac_no1 = $ac_no;
            }
            $vendor->ifsc = $request->ifsc;
            $vendor->upi = $request->upi;
            $vendor->option1 = $request->option1;
            $vendor->option2 = $request->option2;
            $vendor->comments = $request->comments;

            // echo $vendor;
            // exit();
            $vedorregisterd = $vendor->save();

            if($vedorregisterd){
                $user = User::find($id);
                //$user = new User();
                $pass   =  Hash::make($request->pass1);
                //$user->id = $id;
                //$user->admin_id = 0;
                //$user->login_id = $ven;
                $user->name     = $request->created_by;
                $user->firstName = $request->shop_name;
                $user->lastName =  $request->owner_name;
                $user->email =   $request->email;
                $user->username = $request->username;
                $user->password = $pass;
                $user->level = 0;
                $user->status = 2;
                $user->save();
            }else{
                $flasher->addError('Something Error!! =>');
               //return 'failde'   ;
               
            }

            
            $flasher->addSuccess('vendor Information has been updated successfully!');
            return redirect()->route('staffvendor-list');
        } catch (\Throwable $th) {
            //$flasher->addError('Something Error!!');
            $flasher->addError('Something Error!! =>' . $th);
             return redirect()->route('staffvendorcreate.edit');
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, FlasherInterface $flasher)
    {

        try {
            $vendor_image = vendorcreate::find($id);

             $profile_image = $this->PROFILE_IMAGE_PATH . "/" . $vendor_image->profile_image;
             $gst = $this->GST_IMAGE_PATH . "/" . $vendor_image->gst;
             $other_documents = $this->OTHER_IMAGE_PATH . "/" . $vendor_image->other_documents;
    
            if (file_exists($profile_image)) unlink($profile_image);
            if (file_exists($gst)) unlink($gst);
            if (file_exists($other_documents)) unlink($other_documents);
         

            vendorcreate::where("id", $id)->delete();
            // dd($profile_image);
            $flasher->addsuccess('Product Removed!');
            return redirect()->route('staffvendor-list');
        }
        catch(Throwable $th) {
            $flasher->addError('Something Error!');
            return redirect()->route('staffvendor-list');
        }
    }
}
