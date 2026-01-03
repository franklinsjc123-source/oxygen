<?php

namespace App\Http\Controllers\ProductsController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helper\ImageUploadHelper\ImageUploadHelper;
use App\Models\Category\CategoryMain;
use App\Models\Category\Category;
use App\Models\Category\CategorySub;
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
         $category_main_data = CategoryMain::where('created_byid',1)->get();
         $Category  = Category::where('created_byid',1)->get();
         $subcategory = CategorySub::where('created_byid',1)->get();
        
         $attribute = DB::table('master_attribute')
        ->select('master_attribute.id','master_attribute.category_main_id','master_attribute.category_id','master_attribute.category_sub_id','master_attribute.attribute_name','master_attribute.value','master_attribute.status',
        'category_main.category_main_name','category_main.category_main_image',
        'category.main_category_id','category.category_name','category.category_image',
        'category_sub.category_sub_name','category_sub.category_sub_image')

        ->join('category_sub', 'category_sub.id', '=', 'master_attribute.category_sub_id')
        ->join('category', 'category.id', '=', 'category_sub.category_id')
        ->join('category_main', 'category_main.id', '=', 'category.main_category_id')
        ->where('category_sub.created_byid',1)
        ->get();

        return view('layout.admin.products.attribute-listing')
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
            $attribute->created_by = 'admin';
            $attribute->created_byid = 1;
			$attribute->created_byid = $login_id;
            
            $attribute->save();

            $flasher->addSuccess('New Attribute Added successfully!');
            return redirect()->route('attribute.master.index');
        } catch (\Throwable $th) {
            $flasher->addError('Something Error!! =>' . $th);
            return redirect()->route('attribute.master.index');
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
        //
    }
    /*Edit Attribute*/
    public function editattribute($id)
    {
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
             $Attribute->created_by = 'admin';
             $Attribute->created_byid = 1;
             $Attribute->created_byid = $login_id;
             //dd($Attribute);
             $Attribute->update();
             //return ($id);
            $flasher->addSuccess('New Attribute Updated successfully!');
            //  return response()->json([

            //           'Category'=>'stored'
                   
            //       ]);
             return redirect()->route('attribute.master.index');
          } catch (\Throwable $th) {
             // dd($th);
              $flasher->addError('Something Error!!');
              return redirect()->route('attribute.master.index');
          }
              
    }
    /*Category Details*/
    public function catedetails(Request $request)
    {
        // echo $request->sub_category_id;
        // exit;
        // $category_main_data = CategoryMain::get();
        // $category = Category::get();
        $catedetails = CategorySub::select('category_sub.id', 'category_sub.category_sub_name','category.id', 'category.category_name', 'category_main.id','category_main.category_main_name','category_sub.category_sub_name','category_sub.category_id','category_sub.id')
        ->join('category','category.id','=','category_sub.category_id')
        ->join('category_main','category_main.id','=','category_sub.category_main_id')
        ->where('category_sub.id', $request->sub_category_id)
        ->where('category_sub.created_byid', 1)
        ->get();
        // dd($catedetails);
        if($catedetails)
        {
            return response()->json([

                'status'=>200,
                'catedetails'=>$catedetails
               
            ]);
        }
        else
        {
            return response()->json([

                'status'=>404,
                'message'=>'Details not found',
            ]);
        }

    }
 public function adminsearchdetails(Request $request)
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
     
        return view('layout.admin.products.attribute-listing')
        ->with([
            'category_main_data' => $category_main_data,
            'category'=> $Category,
            'subcategory' => $subcategory,
            'subcategory1' => $subcategory,
            'attribute' => $attribute
        ]);
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
            return redirect()->route('attribute.master.index');
        } catch (\Throwable $th) {
            $flasher->addError('Something Error!!');
            return redirect()->route('attribute.master.index');
        }
    }



    public function getAttributes(Request $request)
    {
        $attribute_data = Attribute::where('category_sub_id', $request->sub_category_id)
        ->where('created_byid', 1)
        ->get();
        return response()->json($attribute_data);
    }

    public function getSubCategory(Request $request)
    {
        $attribute_data = Attribute::where('category_sub_id', $request->sub_category_id)
        ->where('created_byid', 1)
        ->get();
        return response()->json($attribute_data);
    }
}
