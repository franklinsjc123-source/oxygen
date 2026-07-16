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
use App\Models\Master\Attribute\AttributeGroup;
use App\Models\Master\Specification\SpecificationGroup;
use App\Models\Staffcreates;
use App\Models\State;
use App\Models\City;
use App\Models\PinCode\PinCode;
use App\Models\Category\CategorySub;
use App\Models\Category\Category;
use App\Models\Category\CategoryMain;

class VendorcreateController extends Controller
{
    private function sanitizeGstNumber(?string $gstNumber): string
    {
        $gstNumber = strtoupper(trim((string) $gstNumber));
        $gstNumber = preg_replace('/\s+/', '', $gstNumber);

        // Respect DB column size to avoid SQLSTATE[22001] (Data too long).
        try {
            $columnMeta = FacadesDB::select("SHOW COLUMNS FROM vendor_details LIKE 'gst_number'");
            if (!empty($columnMeta[0]->Type) && preg_match('/varchar\((\d+)\)/i', $columnMeta[0]->Type, $m)) {
                $maxLen = (int) $m[1];
                if ($maxLen > 0) {
                    $gstNumber = substr($gstNumber, 0, $maxLen);
                }
            }
        } catch (\Throwable $th) {
            // Fallback: GSTIN standard length.
            $gstNumber = substr($gstNumber, 0, 15);
        }

        return $gstNumber;
    }

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
        $route = Route::all();
        $Zonal = Zonal::all();
        $State = State::all();
        $City = City::all();
        $CategoryMain = CategoryMain::where('status', 1)->select('id', 'category_main_name')->get();
        $Category = Category::where('status', 1)->select('id', 'main_category_id', 'category_name')->get();
        $CategorySub = FacadesDB::table('category_sub as t1')
            ->join('category as t2', 't1.category_id', '=', 't2.id')
            ->join('category_main as t3', 't1.category_main_id', '=', 't3.id')
            ->select('t1.id', 't1.category_main_id', 't1.category_id', 't1.category_sub_name', 't2.category_name', 't3.category_main_name')
            ->where('t1.status', 1)
            ->get();
        $staffs = Staffcreates::where('flag', 1)->get();
        return view('layout.staff.vendor.vendor-create')->with(
            [
                "package",
                $package,
                "route" => $route,
                "zone" => $Zonal,
                "State" => $State,
                "City" => $City,
                "CategoryMain" => $CategoryMain,
                "Category" => $Category,
                "CategorySub" => $CategorySub,
                "staffs" => $staffs
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
        if (User::where('username', $request->username)->exists() || vendorcreate::where('username', $request->username)->exists()) {
            $flasher->addError('Username already exists!');
            return redirect()->back()->withInput()->with('error', 'Username already exists!');
        }

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
            $vendor->instagram_link = $request->instagram_link;
            $vendor->facebook_link = $request->facebook_link;
            $vendor->whatsapp_number = $request->whatsapp_number;

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
            $user->name     = $request->owner_name;
            $user->firstName = $request->shop_name;
            $user->lastName =  $request->owner_name;
            $user->email =   $request->email;
            $user->username = $request->username;
            $user->password = $pass;
            $user->level = 0;
            $user->status = 2;
            $user->save();

            // Handle sub-category assignment and seed sub_category_mapping
            $selectedSubCategoryIds = $request->input('sub_category_ids', []);
            if (empty($selectedSubCategoryIds) && $request->filled('sub_category_ids_csv')) {
                $selectedSubCategoryIds = explode(',', (string) $request->sub_category_ids_csv);
            }
            $selectedSubCategoryIds = array_values(array_unique(array_filter($selectedSubCategoryIds)));

            if (!empty($selectedSubCategoryIds)) {
                $vendor->sub_category_ids = implode(',', $selectedSubCategoryIds);
                $vendor->save();

                $newVendorId = $vendor->id;
                $adminAttrGroups = AttributeGroup::where('created_by', 'Admin')->get();
                $adminSpecGroups = SpecificationGroup::where('created_by', 'Admin')->get();

                foreach ($selectedSubCategoryIds as $subCatId) {
                    $subCatId = (int) $subCatId;

                    $attrIds = [];
                    foreach ($adminAttrGroups as $ag) {
                        $agSubIds = array_map('intval', array_filter(explode(',', $ag->sub_category_ids ?? '')));
                        if (in_array($subCatId, $agSubIds)) {
                            $attrIds[] = $ag->id;
                        }
                    }

                    $specIds = [];
                    foreach ($adminSpecGroups as $sg) {
                        $sgSubIds = array_map('intval', array_filter(explode(',', $sg->sub_category_ids ?? '')));
                        if (in_array($subCatId, $sgSubIds)) {
                            $specIds[] = $sg->id;
                        }
                    }

                    FacadesDB::table('sub_category_mapping')->updateOrInsert(
                        ['sub_category_id' => $subCatId, 'vendor_id' => $newVendorId],
                        [
                            'category_sub_attribute_ids' => json_encode(array_values(array_unique($attrIds))),
                            'category_sub_specification_ids' => json_encode(array_values(array_unique($specIds))),
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]
                    );
                }
            }
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

        $package = packages::all();
        $route = Route::all();
        $Zonal = Zonal::all();
        $CategoryMain = CategoryMain::where('status', 1)->select('id', 'category_main_name')->get();
        $Category = Category::where('status', 1)->select('id', 'main_category_id', 'category_name')->get();
        $CategorySub = DB::table('category_sub as t1')
            ->join('category as t2', 't1.category_id', '=', 't2.id')
            ->join('category_main as t3', 't1.category_main_id', '=', 't3.id')
            ->select('t1.id', 't1.category_main_id', 't1.category_id', 't1.category_sub_name', 't2.category_name', 't3.category_main_name')
            ->where('t1.status', 1)
            ->get();
        $staffs = Staffcreates::all();
        return view('layout.staff.vendor.vendor-edit')
            ->with([
                "vendorcreate" => $vendorcreate,
                "package" => $package,
                "route" => $route,
                "zone" => $Zonal,
                "CategoryMain" => $CategoryMain,
                "Category" => $Category,
                "CategorySub" => $CategorySub,
                "staffs" => $staffs
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
        $vendor = vendorcreate::find($id);
        $statement = FacadesDB::select("SHOW TABLE STATUS LIKE 'vendor_details'");

        $profile_image = '';
        $gst = '';
        $other_documents = '';

        if (isset($request->profile_image)) {
            $file = $request->profile_image;
            if ($file !== null) {
                $profile_image = ImageUploadHelper::storeImage($file, $this->PROFILE_IMAGE_PATH);
            }
        } else {
            $profile_image = $request->oldprofile_image;
        }

        if (isset($request->gst)) {
            $file = $request->gst;
            if ($file !== null) {
                $gst = ImageUploadHelper::storeImage($file, $this->GST_IMAGE_PATH);
            }
        } else {
            $gst = $request->oldgst;
        }

        if (isset($request->other_documents)) {
            $file = $request->other_documents;
            if ($file !== null) {
                $other_documents = ImageUploadHelper::storeImage($file, $this->OTHER_IMAGE_PATH);
            }
        } else {
            $other_documents = $request->oldother_documents;
        }

        try {
            $vendor->created_by = $request->created_by;
            $vendor->username = $request->username;
            $vendor->pass = $request->pass;
            if ($request->pass == $request->pass1) {
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
            $vendor->latitude = $request->latitude;
            $vendor->longitude = $request->longitude;
            $vendor->aadhar_no = $request->aadhar_no;
            $vendor->gst_number = $this->sanitizeGstNumber($request->gst_number);
            $vendor->staff_id = $request->staff_id;

            $selectedSubCategoryIds = $request->input('sub_category_ids', []);
            if (empty($selectedSubCategoryIds) && $request->filled('sub_category_ids_csv')) {
                $selectedSubCategoryIds = explode(',', (string) $request->sub_category_ids_csv);
            }
            $selectedSubCategoryIds = array_values(array_unique(array_filter($selectedSubCategoryIds)));
            $vendor->sub_category_ids = !empty($selectedSubCategoryIds) ? implode(',', $selectedSubCategoryIds) : '';

            $vendor->profile_image = $profile_image;
            $vendor->gst = $gst;
            $vendor->other_documents = $other_documents;

            $vendor->package_id = $request->package;
            $vendor->purchase_date  = $request->purchase_date;
            $vendor->expired_date = $request->expired_date;
            $vendor->next_renewal_date = $request->next_renewal_date;

            $vendor->wallet = $request->wallet;
            $vendor->commission = $request->commission;
            $vendor->description = $request->description;
            $vendor->grace_days = $request->grace_days;
            $vendor->validity = $request->validity;
            $vendor->status = 1;
            $vendor->flag = 1;

            $vendor->bank_name = $request->bank_name;
            $vendor->ac_no = $request->ac_no;
            $ac_no  = $request->ac_no;
            $ac_no1  = $request->ac_no1;
            if ($ac_no  == $ac_no1) {
                $vendor->ac_no1 = $ac_no;
            }
            $vendor->ifsc = $request->ifsc;
            $vendor->upi = $request->upi;
            $vendor->option1 = $request->option1;
            $vendor->option2 = $request->option2;
            $vendor->comments = $request->comments;
            $vendor->instagram_link = $request->instagram_link;
            $vendor->facebook_link = $request->facebook_link;
            $vendor->whatsapp_number = $request->whatsapp_number;

            $vedorregisterd = $vendor->save();

            if ($vedorregisterd) {
                $user = User::where('login_id', $id)->first();
                if (!$user) {
                    $user = new User();
                }
                $user->name     = $request->owner_name;
                $user->firstName = $request->shop_name;
                $user->lastName =  $request->owner_name;
                $user->email =   $request->email;
                $user->username = $request->username;
                if ($request->filled('pass1')) {
                    $user->password = Hash::make($request->pass1);
                }
                $user->level = 0;
                $user->status = 2;
                $user->save();

                if (!empty($selectedSubCategoryIds)) {
                    FacadesDB::table('sub_category_mapping')
                        ->where('vendor_id', $id)
                        ->whereNotIn('sub_category_id', $selectedSubCategoryIds)
                        ->delete();

                    $adminAttrGroups = AttributeGroup::where('created_by', 'Admin')->get();
                    $adminSpecGroups = SpecificationGroup::where('created_by', 'Admin')->get();

                    foreach ($selectedSubCategoryIds as $subCatId) {
                        $subCatId = (int) $subCatId;

                        $attrIds = [];
                        foreach ($adminAttrGroups as $ag) {
                            $agSubIds = array_map('intval', array_filter(explode(',', $ag->sub_category_ids ?? '')));
                            if (in_array($subCatId, $agSubIds)) {
                                $attrIds[] = $ag->id;
                            }
                        }

                        $specIds = [];
                        foreach ($adminSpecGroups as $sg) {
                            $sgSubIds = array_map('intval', array_filter(explode(',', $sg->sub_category_ids ?? '')));
                            if (in_array($subCatId, $sgSubIds)) {
                                    $specIds[] = $sg->id;
                            }
                        }

                        FacadesDB::table('sub_category_mapping')->updateOrInsert(
                            ['sub_category_id' => $subCatId, 'vendor_id' => $id],
                            [
                                'category_sub_attribute_ids' => json_encode(array_values(array_unique($attrIds))),
                                'category_sub_specification_ids' => json_encode(array_values(array_unique($specIds))),
                                'created_at' => now(),
                                'updated_at' => now(),
                            ]
                        );
                    }
                } else {
                    FacadesDB::table('sub_category_mapping')
                        ->where('vendor_id', $id)
                        ->delete();
                }
            } else {
                $flasher->addError('Something Error!! =>');
            }

            $flasher->addSuccess('vendor Information has been updated successfully!');
            return redirect()->route('staffvendor-list');
        } catch (\Throwable $th) {
            $flasher->addError('Something Error!! =>' . $th);
            return redirect()->route('staffvendorcreate.edit', $id);
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

    public function picodedetailsreceived(Request $request)
    {
        $pincode = $request->pincode;

        $ppincode = PinCode::select('pincode.*', 'zonals.*')
            ->join('zonals', 'pincode.zonal_id', '=', 'zonals.id')
            ->where('pincode.name', $pincode)->get();

        return response()->json($ppincode);
    }

    public function checkUsername(Request $request)
    {
        $username = $request->username;
        $exists = User::where('username', $username)->exists() || vendorcreate::where('username', $username)->exists();
        return response()->json(['exists' => $exists]);
    }
}
