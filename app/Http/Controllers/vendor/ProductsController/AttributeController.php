<?php

namespace App\Http\Controllers\vendor\ProductsController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helper\ImageUploadHelper\ImageUploadHelper;
use App\Models\Category\CategorySub;
use App\Models\Category\Category;
use App\Models\Category\CategoryMain;
use App\Models\Master\Attribute\Attribute;
use Illuminate\Support\Facades\DB;
use Flasher\Prime\FlasherInterface;


class AttributeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $category_main_data = CategoryMain::get();
        // $subcategory = CategorySub::get();
        // // $attribute_data = Attribute::get();
        // $attribute = CategorySub::join(
        //     'master_attribute',
        //     'category_sub.id',
        //     '=',
        //     'master_attribute.category_sub_id'
        // )
        //     ->get();

        // return view('layout.vendor.products.attribute-listing')
        //     ->with([
        //         'category_main_data' => $category_main_data,
        //         'subcategory' => $subcategory,
        //         'attribute' => $attribute
        //     ]);
         $login_id = session()->get('login_id');
         
         $category_main_data = CategoryMain::whereIn('created_byid', [$login_id, 1])->get();
         $Category  = Category::whereIn('created_byid', [$login_id, 1])->get();
         $subcategory = CategorySub::whereIn('created_byid', [$login_id, 1])->get();
         
         $attribute = DB::table('master_attribute')
            ->select('master_attribute.id','master_attribute.category_main_id','master_attribute.category_id','master_attribute.category_sub_id','master_attribute.attribute_name','master_attribute.value','master_attribute.status','master_attribute.created_byid','master_attribute.created_by',
            'category_main.category_main_name','category_main.category_main_image',
            'category.main_category_id','category.category_name','category.category_image',
            'category_sub.category_sub_name','category_sub.category_sub_image')

            ->join('category_sub', 'category_sub.id', '=', 'master_attribute.category_sub_id')
            ->join('category', 'category.id', '=', 'category_sub.category_id')
            ->join('category_main', 'category_main.id', '=', 'category.main_category_id')
            ->whereIn('master_attribute.created_byid', [$login_id, 1])->get();
            
            // ->where('master_attribute.created_by','vendor')
          
            

        return view('layout.vendor.products.attribute-listing')
            ->with([
                'category_main_data' => $category_main_data,
                'subcategory' => $subcategory,
                'category' =>$Category,
                'subcategory1' => $subcategory,
                'attribute' => $attribute
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
        
          
        $attribute = new Attribute;
        $login_id = session()->get('login_id');
        try {
            $attribute->category_main_id = $request->sscategory_main;
            $attribute->category_id = $request->sscategory;
            $attribute->category_sub_id = $request->category_sub_id;
            $attribute->attribute_name = $request->name;
            $attribute->value = json_encode($request->value);
            $attribute->status = $request->status ?? 1;
            $attribute->created_by = 'vendor';
			$attribute->created_byid = $login_id;
            $attribute->save();

            $flasher->addSuccess('New Attribute Added successfully!');
            return redirect()->route('vendorattribute.master.index');
        } catch (\Throwable $th) {
            $flasher->addError('Something Error!! =>' . $th);
            return redirect()->route('vendorattribute.master.index');
        }
         
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     
     public function editattribute($id)
    {
        
        $login_id = session()->get('login_id');
        // $subcategory = CategorySub::find($id);
          $subcategory = DB::table('master_attribute')
        // ->select('master_attribute.id', 'master_attribute.category_sub_id', 'master_attribute.attribute_name', 'master_attribute.value','master_attribute.status', 'category_sub.category_sub_name','category_sub.category_id')
        ->select('master_attribute.id','master_attribute.category_main_id','master_attribute.category_id','master_attribute.category_sub_id','master_attribute.attribute_name','master_attribute.value','master_attribute.status',
        'category_main.category_main_name','category_main.category_main_image',
        'category.main_category_id','category.category_name','category.category_image',
        'category_sub.category_sub_name','category_sub.category_sub_image')
        ->join('category_sub', 'category_sub.id', '=', 'master_attribute.category_sub_id')
        ->join('category', 'category.id', '=', 'category_sub.category_id')
        ->join('category_main', 'category_main.id', '=', 'category.main_category_id')
        ->where('master_attribute.id', $id)
        ->where('master_attribute.created_byid', $login_id)
        ->where('master_attribute.created_by', 'vendor')
        ->get();
            // dd($subcategory);
        if($subcategory)
        {
            return response()->json([

                'status'=>200,
                'subcategory'=>$subcategory
               
            ]);
        }
        else
        {
            return response()->json([

                'status'=>404,
                'message'=>'Package not found',
            ]);
        }
    }

    public function updateattribute(Request $request, $id, FlasherInterface $flasher)
    {
        $login_id = session()->get('login_id');
        try {
             $Attribute =  Attribute::find($id);
             $Attribute->category_sub_id = $request->editcategory_sub_name;
             $Attribute->attribute_name = $request->editname;
             $Attribute->value = json_encode($request->value);
             $Attribute->status = $request->editstatus;
             $Attribute->created_by = 'vendor';
		  	 $Attribute->created_byid = $login_id;
             //dd($Attribute);
             $Attribute->update();
             //return ($id);
            $flasher->addSuccess('New Attribute Updated successfully!');
            //  return response()->json([

            //           'Category'=>'stored'
                   
            //       ]);
             return redirect()->route('vendorattribute.master.index');
          } catch (\Throwable $th) {
             // dd($th);
              $flasher->addError('Something Error!!');
              return redirect()->route('vendorattribute.master.index');
          }
              
    }
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
            Attribute::where("id", $id)->delete();
            $flasher->addsuccess('Product Attribute Removed!');
            return redirect()->route('vendorattribute.master.index');
        } catch (\Throwable $th) {
            $flasher->addError('Something Error!!');
            return redirect()->route('vendorattribute.master.index');
        }
    }



    public function getAttributes(Request $request)
    {
         $login_id = session()->get('login_id');
       
        $attribute_data = Attribute::where('category_sub_id', $request->sub_category_id)
        ->whereIn('created_byid', [$login_id, 1])
        ->get();
       
        return response()->json($attribute_data);
    }

    public function getSubCategory(Request $request)
    {
         $login_id = session()->get('login_id');
        $attribute_data = Attribute::where('category_sub_id', $request->sub_category_id)
        ->whereIn('created_byid', [$login_id, 1])
        ->get();
        return response()->json($attribute_data);
    }
    
    public function searchdetails(Request $request)
    {
     
        $scate = $request->category_sub;
        // exit;
        $category_main_data = CategoryMain::get();
        $Category  = Category::get();
        $subcategory = CategorySub::get();
        
         $attribute = CategorySub::join(
            'master_attribute',
            'category_sub.id',
            '=',
            'master_attribute.category_sub_id'
        )
        ->where('category_sub_id', $scate)
            ->get();
     
        return view('layout.vendor.products.attribute-listing')
        ->with([
            'category_main_data' => $category_main_data,
            'category'=> $Category,
            'subcategory' => $subcategory,
            'subcategory1' => $subcategory,
            'attribute' => $attribute
        ]);
    }
}
