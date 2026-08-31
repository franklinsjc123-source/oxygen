<?php

namespace App\Http\Controllers\vendor\ProductsController;
// use App\Models\vendor\Products\Products as vendorproducts;
// use App\Models\vendor\Products\ProductsDetails as vendorProductsDetails;
// use App\Models\vendor\Products\productcollection as vendorproductcollection;

use App\Helper\ImageUploadHelper\ImageUploadHelper;
use App\Http\Controllers\Controller;
use App\Models\Category\CategoryMain;
use Flasher\Prime\FlasherInterface;
use Illuminate\Http\Request;
use App\Models\vendor\Products\productcollection;
use App\Models\Products\productcollection as adminproductcollection;
use App\Models\Category\Category;
use App\Models\Category\CategorySub;
use App\Models\Master\Attribute\Attribute;
use App\Models\Master\GST\GST;
use App\Models\Master\Specification\Specification;
use App\Models\Products\Products;
use App\Models\Products\ProductsDetails;
use App\Models\Products\ProductsSpecs;
use App\Models\Products\ProductSpecs;
use App\Models\Products\productsAttri;

use App\Models\Master\Colors\ProductColor;
use App\Models\Master\Attribute\AttributeGroup;
use App\Models\Master\Specification\SpecificationGroup;
use App\Models\vendor\vendorcreate;
// use App\Models\vendor\offer\vendor_offer as offer;
use App\Models\Offer\Offer;
use session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Intervention\Image\ImageManagerStatic as Image;

class ProductsController extends Controller
{
    private $image_path1 = "assets/images/products";
   
    private $main_image_path = "assets/images/products";
    private $detail_image_path = "assets/images/products/detail";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $login_id = session()->get('login_id');
        // dd(  $login_id );
        $vendorcreate = vendorcreate::where('id',$login_id)->first();
        $subcategoryarray = array_values(array_filter(array_map('intval', array_map('trim', explode(',', (string) optional($vendorcreate)->sub_category_ids)))));
        //$CategorySub = CategorySub::whereIn('id', $subcategoryarray)->get();
        $CategorySub=DB::table('category_sub as t1')
        ->leftJoin('category as t2', 't1.category_id', '=', 't2.id')
        ->leftJoin('category_main as t3', 't1.category_main_id', '=', 't3.id')
        ->select(
            't1.id',
            't1.category_id',
            't1.category_main_id',
            't1.category_sub_name',
            't2.category_name',
            't3.category_main_name'
        )
        ->where('t1.status', 1)
        ->whereIn('t1.id', $subcategoryarray)->get();
        //dd($CategorySub);
        $gst = GST::where('status', 1)->get();
        $attribute = Attribute::where('status', 1)->get();
        $specification = Specification::where('status', 1)->get();
        $productcollection = adminproductcollection::select('name', DB::raw('GROUP_CONCAT(id) as ids'))
        ->where('status', 1)
        ->groupBy('name')
        ->get();
        $offer = Offer::where('created_by_id', $login_id)->where('status', 1)->get();
        //dd($login_id);
        return view('layout.vendor.products.add-product')
            ->with([
                "CategorySub" => $CategorySub,
                "gst" => $gst,
                "attribute" => $attribute,
                "productcollection" => $productcollection,
                "specification" => $specification,
                "offers" => $offer,
                "vendorcreate" => $vendorcreate
            ]);
    }
    public function addinfo(Request $request)
    {
        $login_id = session()->get('login_id');
        $vendorcreate = vendorcreate::where('id', $login_id)->first();
        $subcategoryarray = array_values(array_filter(array_map('intval', array_map('trim', explode(',', (string) optional($vendorcreate)->sub_category_ids)))));
        $CategorySub = DB::table('category_sub as t1')
            ->leftJoin('category as t2', 't1.category_id', '=', 't2.id')
            ->leftJoin('category_main as t3', 't1.category_main_id', '=', 't3.id')
            ->select(
                't1.id',
                't1.category_id',
                't1.category_main_id',
                't1.category_sub_name',
                't2.category_name',
                't3.category_main_name'
            )
            ->where('t1.status', 1)
            ->whereIn('t1.id', !empty($subcategoryarray) ? $subcategoryarray : [0])
            ->get();

        $category_sub = CategorySub::where('id', $request->category_sub)->first();

        if (!$category_sub) {
            return redirect()->back()->with('error', 'Sub category not found.');
        }

        $category_main_data = CategoryMain::where('status', 1)->where('id', $category_sub->category_main_id)->get();
        $category_data = Category::where('status', 1)->where('id', $category_sub->category_id)->get();
        $category_sub_data = CategorySub::where('id', $category_sub->id)->get();
        $gst = GST::where('status', 1)->get();
        $productcollection = adminproductcollection::select('name', DB::raw('GROUP_CONCAT(id) as ids'))
        ->where('status', 1)
        ->groupBy('name')
        ->get();
        $colors = ProductColor::all();
        // $offer = Offer::where('status', 1)->get();
        $offer = Offer::where('created_by_id', $login_id)->where('status', 1)->get();


        $mapping = DB::table('sub_category_mapping')->where('sub_category_id', $category_sub->id)->where('vendor_id', $login_id)->first();
        $hasMapping = !is_null($mapping);

        // Fetch all specification groups created by this vendor that are mapped to this subcategory
        $vendorSpecIds = SpecificationGroup::where('created_by', 'Vendor')
            ->where('created_byid', $login_id)
            ->whereRaw("FIND_IN_SET(?, sub_category_ids)", [$category_sub->id])
            ->pluck('id')
            ->toArray();

        // Fetch Admin-created specification groups
        if ($hasMapping) {
            $adminSpecIds = $mapping->category_sub_specification_ids
                ? (json_decode($mapping->category_sub_specification_ids, true) ?: [])
                : [];
        } else {
            $adminSpecIds = ($category_sub->category_sub_specifications != '')
                ? explode(',', $category_sub->category_sub_specifications)
                : [];
        }

        // Merge both sets of specification group IDs
        $specdata = array_unique(array_merge(
            array_map('intval', $adminSpecIds),
            array_map('intval', $vendorSpecIds)
        ));
        $specdata = array_values(array_filter($specdata));

        if ($mapping && $mapping->category_sub_attribute_ids) {
            $vendorAttrs = array_map('intval', json_decode($mapping->category_sub_attribute_ids, true) ?: []);
            $attribute = AttributeGroup::where(function ($q) use ($vendorAttrs, $category_sub, $login_id) {
                    $q->whereIn('id', $vendorAttrs)
                      ->where(function ($subQ) use ($category_sub, $login_id) {
                          $subQ->whereRaw("FIND_IN_SET(?, sub_category_ids)", [$category_sub->id])
                               ->orWhere('created_byid', $login_id);
                      });
                })
                ->orWhere('created_byid', $login_id)
                ->orderBy('attribute_group_name', 'asc')
                ->get();
        } else {
            $attribute = AttributeGroup::where('created_byid', $login_id)
                ->orderBy('attribute_group_name', 'asc')
                ->get();
        }

        $selectedAttributeId = (int) ($request->selected_attribute_id ?? 0);

        if ($selectedAttributeId > 0 && $attribute->isNotEmpty()) {
            $attribute = $attribute->where('id', $selectedAttributeId)->values();
        } elseif ($attribute->count() === 1) {
            $selectedAttributeId = (int) ($attribute->first()->id ?? 0);
        }

        $combinedSpecifications = SpecificationGroup::where(function($q) use ($specdata) {
                if (!empty($specdata)) {
                    $q->whereIn('id', $specdata);
                } else {
                    $q->whereRaw('1=0'); // Force empty if mapping exists but is empty
                }
            })
            ->whereIn('created_byid', [1, $login_id])
            ->where('status', 'Active')
            ->get();

        if ($attribute->isNotEmpty() || $combinedSpecifications->isNotEmpty()) {
            return view('layout.vendor.products.add-product')
                ->with([
                    "CategorySub" => $CategorySub,
                    "category_main_data" => $category_main_data,
                    "gst" => $gst,
                    "colors" => $colors,
                    "attribute" => $attribute,
                    "productcollection" => $productcollection,
                    "specification" => $combinedSpecifications,
                    "offers" => $offer,
                    "addinformation" => "Add",
                    "maincategoryid" => $category_sub->category_main_id,
                    "categoryid" => $category_sub->category_id,
                    "subcategoryid" => $request->category_sub,
                    "selectedAttributeId" => $selectedAttributeId,
                    "nproduct" => $request->nproduct ?? 1,
                    "is_color" => $request->is_color,
                    "category_data" => $category_data,
                    "category_sub_data" => $category_sub_data,
                    "vendorcreate" => $vendorcreate
                ]);
        }

        return view('layout.vendor.products.add-product')
            ->with([
                "CategorySub" => $CategorySub,
                "category_main_data" => $category_main_data,
                "category_data" => $category_data,
                "category_sub_data" => $category_sub_data,
                "maincategoryid" => $category_sub->category_main_id,
                "categoryid" => $category_sub->category_id,
                "subcategoryid" => $request->category_sub,
                "nproduct" => $request->nproduct ?? 1,
                "is_color" => $request->is_color,
                "attribute" => collect(),
                "productcollection" => $productcollection,
                "specification" => collect(),
                "offers" => $offer,
                "error" => "Attributes & Specifications Not Assign in this Sub Category.",
                "vendorcreate" => $vendorcreate
            ]);
    }

    public function getSubCategoryAttributes(Request $request)
    {
        $login_id = session()->get('login_id');
        $subCategoryId = (int) ($request->sub_category_id ?? 0);

        if ($subCategoryId <= 0) {
            return response()->json([]);
        }

        $mapping = DB::table('sub_category_mapping')
            ->where('sub_category_id', $subCategoryId)
            ->where('vendor_id', $login_id)
            ->first();

        if ($mapping && $mapping->category_sub_attribute_ids) {
            $vendorAttrs = array_map('intval', json_decode($mapping->category_sub_attribute_ids, true) ?: []);
            
            $attributes = AttributeGroup::where(function ($q) use ($vendorAttrs, $subCategoryId, $login_id) {
                    $q->whereIn('id', $vendorAttrs)
                      ->where(function ($subQ) use ($subCategoryId, $login_id) {
                          $subQ->whereRaw("FIND_IN_SET(?, sub_category_ids)", [$subCategoryId])
                               ->orWhere('created_byid', $login_id);
                      });
                })
                ->orWhere('created_byid', $login_id)
                ->orderBy('attribute_group_name', 'asc')
                ->get(['id', 'attribute_group_name', 'attribute_group_refname']);
        } else {
            $attributes = AttributeGroup::where('created_byid', $login_id)
                ->orderBy('attribute_group_name', 'asc')
                ->get(['id', 'attribute_group_name', 'attribute_group_refname']);
        }

        return response()->json($attributes);
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
    $rules = [
        'product_name' => 'required|string|max:255',
        'retail_price.*' => 'required|numeric|min:0.01',
        'selling_price.*' => 'required|numeric|min:0',
        'mainImage' => 'nullable|image|mimes:jpeg,png,jpg|max:4096',
    ];

    $request->validate($rules);

    DB::beginTransaction();

    try {

        $login_id = session()->get('login_id');
        $nextProductId = ((int) Products::max('product_id')) + 1;
        if ($nextProductId <= 0) {
            $nextProductId = ((int) Products::max('id')) + 1;
        }

        if (empty($login_id)) {
            throw new \RuntimeException('Vendor session expired. Please login again.');
        }

        /* ===================================
           STEP 1: CREATE PRODUCT
        =================================== */

        $product = new Products();
        $product->login_id = $login_id;
        $product->vendor_id = $login_id;
        $product->product_id = $nextProductId;
        $product->category = $request->category;
        $product->category_main = $request->category_main;
        $product->category_sub = $request->category_sub;
        $product->product_name = $request->product_name;
        $product->tax_id = $request->tax_id;
        $product->gst_id = $request->gst_id;
        $product->hsncode = $request->hsncode;
        $product->description = $request->description;
        $product->weight = $request->weight;
        $product->length = $request->length;
        $product->width = $request->width;
        $product->height = $request->height;
        $product->specification = $request->specification;
        $product->offers = $request->offers;
        $product->collection = $request->collection;
        $product->flag = 1;
        $product->status = $request->status ?? 1;
        $product->logintype = "Vendor";
        $product->created_by = $login_id;

        $product->save();

        // Keep legacy requirement: product_id must match the inserted row id.
        if ((int) $product->product_id !== (int) $product->id) {
            $product->product_id = $product->id;
            $product->save();
        }

        $productId = $product->id;

        /* ===================================
           STEP 3: MAIN IMAGE UPLOAD
        =================================== */

        if ($request->hasFile('mainImage')) {

            $mainImage = $request->file('mainImage');
            $imageName = $productId . "_main." . $mainImage->getClientOriginalExtension();

            $path = public_path('assets/images/products/');
            if (!file_exists($path)) {
                mkdir($path, 0755, true);
            }

            Image::make($mainImage->getRealPath())
                ->fit(800, 900)
                ->save($path . '/' . $imageName);

            $product->product_image = $imageName;
            $product->save();
        }

        /* ===================================
           STEP 4: PRODUCT DETAILS
        =================================== */

        $selectedAttrId = $request->input('selected_attribute_id') ?: $request->input('selected_attribute_id1');
        $attrGroupName = 'Size';
        if ($selectedAttrId) {
            $attrGroup = AttributeGroup::find($selectedAttrId);
            if ($attrGroup) {
                $attrGroupName = $attrGroup->attribute_group_refname ?? $attrGroup->attribute_group_name ?? 'Size';
            }
        }

        $np = count($request->retail_price ?? []);

        for ($key = 0; $key < $np; $key++) {
            $arr = [];
            $image_path = public_path("assets/images/products/detail/");
            if (!file_exists($image_path)) {
                mkdir($image_path, 0755, true);
            }

            $products_details_file  = isset($request->mainimg[$key]) ? $request->mainimg[$key] : null;
            $products_details_file1 = isset($request->subimg1[$key]) ? $request->subimg1[$key] : null;
            $products_details_file2 = isset($request->subimg2[$key]) ? $request->subimg2[$key] : null;
            $products_details_file3 = isset($request->subimg3[$key]) ? $request->subimg3[$key] : null;

            if ($products_details_file) {
                $newName = $productId . '_p' . $key . '_' . time() . '_0_' . $products_details_file->getClientOriginalName();
                $img = Image::make($products_details_file->getRealPath());
                $img->fit(800, 900)->save($image_path . '/' . $newName);
                $arr[] = $newName;
            } else {
                $arr[] = "";
            }
            
            if ($products_details_file1) {
                $newName1 = $productId . '_p' . $key . '_' . time() . '_1_' . $products_details_file1->getClientOriginalName();
                $img = Image::make($products_details_file1->getRealPath());
                $img->fit(800, 900)->save($image_path . '/' . $newName1);
                $arr[] = $newName1;
            } else {
                $arr[] = "";
            }

            if ($products_details_file2) {
                $newName2 = $productId . '_p' . $key . '_' . time() . '_2_' . $products_details_file2->getClientOriginalName();
                $img = Image::make($products_details_file2->getRealPath());
                $img->fit(800, 900)->save($image_path . '/' . $newName2);
                $arr[] = $newName2;
            } else {
                $arr[] = "";
            }

            if ($products_details_file3) {
                $newName3 = $productId . '_p' . $key . '_' . time() . '_3_' . $products_details_file3->getClientOriginalName();
                $img = Image::make($products_details_file3->getRealPath());
                $img->fit(800, 900)->save($image_path . '/' . $newName3);
                $arr[] = $newName3;
            } else {
                $arr[] = "";
            }

            $detail = new ProductsDetails();       
            $detail->products_id = $productId;
            $detail->common_product = $key + 1;
            $detail->product_detail_image = json_encode($arr) ?? "-";
            $detail->sku = is_array($request->sku) ? ($request->sku[$key] ?? 'SKU') : ($request->sku ?? 'SKU');
            $detail->return_replace = is_array($request->return_replace) ? ($request->return_replace[$key] ?? 'Return') : ($request->return_replace ?? 'Return');
            $detail->r_days = is_array($request->r_days) ? ($request->r_days[$key] ?? 0) : ($request->r_days ?? 0);
            
            $detail->color = isset($request->attrcolor[$key]) ? $request->attrcolor[$key] : NULL;
            $detail->size = isset($request->attrsize[$key]) ? $request->attrsize[$key] : NULL;
            
            $detail->attributevalue1 = $request->attrcolor[$key] ?? '';
            $detail->attributename1 = 'Color';
            $detail->attributevalue2 = $request->attrsize[$key] ?? '';
            $detail->attributename2 = $attrGroupName;
            
            $detail->quantity = $request->quantity[$key] ?? 0;
            $detail->retail_price = $request->retail_price[$key] ?? 0;
            $detail->selling_price = $request->selling_price[$key] ?? 0;
            $detail->low_stock_limit = $request->low_stock_limit[$key] ?? 0;
            $detail->threshold = "";
            $detail->save();
        }

        /* ===================================
           STEP 5: PRODUCT SPECIFICATIONS
        =================================== */

        if (!empty($request->spec_id)) {

            foreach ($request->spec_id as $value) {

                $spec = new ProductSpecs();
                $spec->products_id = $productId;
                $spec->category_sub_id = $request->category_sub;
                $spec->spec_id = $value;
                $spec->specify_attribute = $request->specify_attribute[$value] ?? '';
                $spec->specify_value = $request->specify_value[$value] ?? '';
                $spec->save();
            }
        }

        DB::commit();

        $flasher->addSuccess('New Product Added Successfully!');
        return redirect()->route('vendorproducts.crud.listing');

    } catch (\Throwable $e) {

        DB::rollBack();

        Log::error('Vendor product create failed', [
            'message' => $e->getMessage(),
            'line' => $e->getLine(),
        ]);

        $flasher->addError('Something went wrong!');
        return redirect()->back()->withInput();
    }
} 
//    public function store(Request $request, FlasherInterface $flasher)
//    {
//       // return 'adminstore';
//        // echo 'test';
//         $products = new Products();
//        // print_r($products);
//        $login_id = session()->get('login_id');//Auth::user()->id; // 
//     //    dd($login_id);
//     //    $statement = DB::select("SHOW TABLE STATUS LIKE 'products'");
//     //    $next_product_id = $statement[0]->Auto_increment;
//        // // dd($request->specification);

//        $next_product_id = Products::max('id') + 1;

//     //    dd($next_product_id);

//        $products = new Products();
//        $filename = '';
      
//        if ($request->file('mainImage')) {   
//         $main_image = $request->file('mainImage');
        
//         $image = $next_product_id . "_image." . $main_image->getClientOriginalExtension();
        
//         $img = Image::make($main_image->getRealPath());
//         $image_path = "assets/images/products/";
//         $img->fit(800, 900)->save($image_path . '/' . $image);
        
//         $filename = $image;
//     }
        
//            $products->login_id   =  $login_id; 
//            $products->vendor_id   =  $login_id; 
//            $products->product_id = $next_product_id;
//            $products->category = $request->category;
//            $products->category_main = $request->category_main;
//            $products->category_sub = $request->category_sub;
//            $products->product_name = $request->product_name;
//            $products->tax_id = $request->tax_id;
//            $products->gst_id = $request->gst_id;
//            $products->product_image = $filename ?? "-";
//            $products->description = $request->description;
//            $products->weight = $request->weight;
//            $products->length = $request->length;
//            $products->width = $request->width;
//            $products->height = $request->height;
//            $products->specification= $request->specification;

//            $products->offers = $request->offers;
//            $products->collection = $request->collection;
//            $products->flag = 1;
//            $products->status = $request->status ?? 1;
           
//            $products->logintype = "Vendor";
//            $products->created_by =$login_id;
//            //dd($products);
//            $products->save();
//            //
               
                 
//                  $np = $request->nproduct;
         
          
//            for ($i = 1; $i <= $np; $i++) {
                       

//                $arr=[];

//                $request->validate([
//                    'imageUpload.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust validation as needed
//                ]);
           
             
           
//                if ($request->hasFile('imageUpload'.$i)) {
//                    $images = $request->file('imageUpload'.$i);
//                    $image_path = "assets/images/products/detail/";
           
//                    foreach ($images as $index => $sub_image) {
//                     // Create a unique image name
//                     $imageName = $next_product_id . '_' . time() . '_' . $index . '_' . $sub_image->getClientOriginalName();
                    
//                     // Resize and save the image
//                     $img = Image::make($sub_image->getRealPath());
//                     $img->fit(800, 900)->save($image_path . $imageName);
                    
//                     // Add the image path to the array
//                     $arr[] = $imageName;
//                 }
//                }
           
//                // Convert the array to JSON
//                $np1 = count($request->retail_price[$i]);
//                $ac=$request->attributecount;
//                for($k=0;$k<$np1;$k++)
//                {
//                $products_details = new ProductsDetails();       
//                $products_details->products_id = $next_product_id;
//                $products_details->common_product=$i;
//                $products_details->product_detail_image = json_encode($arr) ?? "-";
//                $products_details->sku = $request->sku[$i];
//                $products_details->return_replace = $request->return_replace[$i] ?? 1;
//                $products_details->r_days = $request->r_days[$i];
              
               
//                $products_details->attributevalue1 = isset($request->attributecolorval[$i][$k]) ? $request->attributecolorval[$i][$k] : '';
//                $products_details->attributename1 = isset($request->attributecolorname[$i][$k]) ? 'Color' : 'Color';
//                $products_details->attributevalue2 = isset($request->attributeval[$i][0][$k]) ? $request->attributeval[$i][0][$k] : '';
//                $products_details->attributename2 = isset($request->attributename[$i][0][$k]) ? $request->attributename[$i][0] [$k]: '';
//                $products_details->attributevalue3 = isset($request->attributeval[$i][1][$k]) ? $request->attributeval[$i][1][$k] : '';
//                $products_details->attributename3 = isset($request->attributename[$i][1][$k]) ? $request->attributename[$i][1][$k] : '';
               

//                //$products_details->color = isset($request->attrcolor[$k]) ? $request->attrcolor[$k] : NULL;
//                //$products_details->size = isset($request->attrsize[$k]) ? $request->attrsize[$k] : NULL;
                               
//                $products_details->quantity = $request->quantity[$i][$k];
               
//                $products_details->retail_price = $request->retail_price[$i][$k];
//                $products_details->selling_price = $request->selling_price[$i][$k];
             
//                $products_details->low_stock_limit = $request->low_stock_limit[$i][$k];
              
//                $products_details->threshold = "";
//                // dd($products_details);
//                $products_details->save();
//                }
              
//            }
          
          
               
//                 if(isset($request->spec_id)){

           
//                    foreach($request->spec_id as $key => $value) {

//                        $products_spec = new ProductSpecs();
       
//                        $products_spec->products_id = $next_product_id;
//                        $products_spec->category_sub_id = $request->category_sub;
//                        $products_spec->spec_id = $value;
//                        $products_spec->specify_attribute = $request->specify_attribute[$value];
//                        $products_spec->specify_value = $request->specify_value[$value];
//                       // dd($products_spec);
//                        $products_spec->save();
//                    }	
              
//                }
               
           
//             $flasher->addSuccess('New Product Added successfully!');
//             return redirect()->route('vendorproducts.crud.listing');
//         // } catch (\Throwable $th) {
//         // print_r($th);exit();
//             $flasher->addError('Something Error!!');
//             return redirect()->route('vendorproducts.crud.index');
//         // }
//     }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //echo "test";
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, $category_sub = null, FlasherInterface $flasher = null)
    {
        if (!$flasher) {
            $flasher = app(FlasherInterface::class);
        }
        $login_id = session()->get('login_id');
        //  echo $id;exit();
        $products = Products::where('flag', 1)->where('product_id', $id)->first();
        if (!$products) {
            $flasher->addError('Product not found!');
            return redirect()->route('vendorproducts.crud.listing');
        }
        $category = Category::where('status',1)->get();
        $category_main_data = CategoryMain::where('status',1)->get();
        
        $vendorcreate = vendorcreate::select('sub_category_ids')->where('id', $login_id)->first();
        $subcategoryarray = array_values(array_filter(array_map('intval', array_map('trim', explode(',', (string) optional($vendorcreate)->sub_category_ids)))));
        if ($products && !in_array((int)$products->category_sub, $subcategoryarray)) {
            $subcategoryarray[] = (int)$products->category_sub;
        }
        $CategorySub = DB::table('category_sub as t1')
            ->leftJoin('category as t2', 't1.category_id', '=', 't2.id')
            ->leftJoin('category_main as t3', 't1.category_main_id', '=', 't3.id')
            ->select(
                't1.id',
                't1.category_id',
                't1.category_main_id',
                't1.category_sub_name',
                't2.category_name',
                't3.category_main_name'
            )
            ->where('t1.status', 1)
            ->whereIn('t1.id', !empty($subcategoryarray) ? $subcategoryarray : [0])
            ->get();
        
        $gst = GST::where('status',1)->get();
        $offer = Offer::where('created_by_id',$login_id)->where('status',1)->get();

        $subCategoryId = (int) ($products->category_sub ?? $category_sub);
        $mapping = DB::table('sub_category_mapping')
            ->where('sub_category_id', $subCategoryId)
            ->where('vendor_id', $login_id)
            ->first();
        $hasMapping = !is_null($mapping);

        $adminMappedAttributeIds = AttributeGroup::where(function($q) use ($subCategoryId, $login_id) {
                $q->whereRaw("FIND_IN_SET(?, sub_category_ids)", [$subCategoryId])
                  ->orWhere('created_byid', $login_id);
            })->pluck('id')->toArray();

        $subCategory = CategorySub::find($subCategoryId);
        $defaultAttrIds = ($subCategory && !empty($subCategory->category_sub_attributes)) ? explode(',', $subCategory->category_sub_attributes) : [];
        $validAttrIds = array_unique(array_map('intval', array_merge($defaultAttrIds, $adminMappedAttributeIds)));

        if ($hasMapping) {
            $attributeIds = $mapping->category_sub_attribute_ids
                ? (json_decode($mapping->category_sub_attribute_ids, true) ?: [])
                : [];
            $attributeIds = array_intersect(array_map('intval', (array)$attributeIds), $validAttrIds);
        } else {
            $attributeIds = $validAttrIds;
        }

        // Fetch all specification groups created by this vendor that are mapped to this subcategory
        $vendorSpecIds = SpecificationGroup::where('created_by', 'Vendor')
            ->where('created_byid', $login_id)
            ->whereRaw("FIND_IN_SET(?, sub_category_ids)", [$subCategoryId])
            ->pluck('id')
            ->toArray();

        // Fetch Admin-created specification groups
        if ($hasMapping) {
            $adminSpecIds = $mapping->category_sub_specification_ids
                ? (json_decode($mapping->category_sub_specification_ids, true) ?: [])
                : [];
        } else {
            $adminSpecIds = ($subCategory && !empty($subCategory->category_sub_specifications))
                ? explode(',', $subCategory->category_sub_specifications)
                : [];
        }

        // Merge both sets of specification group IDs
        $specificationIds = array_unique(array_merge(
            array_map('intval', $adminSpecIds),
            array_map('intval', $vendorSpecIds)
        ));

        $attributeIds = array_values(array_filter(array_map('intval', $attributeIds)));
        $specificationIds = array_values(array_filter(array_map('intval', $specificationIds)));

        $attribute = !empty($attributeIds)
            ? AttributeGroup::whereIn('id', $attributeIds)->get()
            : collect();

        $specification = SpecificationGroup::where(function($q) use ($specificationIds) {
                if (!empty($specificationIds)) {
                    $q->whereIn('id', $specificationIds);
                } else {
                    $q->whereRaw('1=0');
                }
            })
            ->whereIn('created_byid', [1, $login_id])
            ->where('status', 'Active')
            ->get();

        $productdetails = ProductsDetails::where('products_id', $id)->get();        
        $productspecs = ProductSpecs::where('products_id', $id)->get();
        $productsAttri = productsAttri::where('products_id', $id)->get();

        // $category_data = Categorymain::join('master_specification', 'master_specification.id', '=', 'products_specs.id')
        // ->get();
        //print_r($productsAttri);exit();
        //print_r($specifi[0]->value);exit();
        // $res['list']= JSON_decode($specifi[0]->value);
        // //print_r($res);exit();
        // foreach ($specifi as $key => $value) { 

        //     //echo $key;
        //      //print_r(JSON_decode($value));
        //     // echo $value['id'].','.$value['category_sub_id'].','.$value['name'].','.$value['value'];


        //     //print_r(JSON_decode($value['value']));
        //     $val = JSON_decode($value['value']);
        //     foreach($val as $k =>$v)
        //     {
        //        // echo $k;
        //         echo $v;
        //     }
        //     // exit();
        // }
        // exit();
        // $staff = Staffcreates::where('employee_id',$employee_id)->get();
        //  //print_r($staff[0]['employee_id']);exit();
        //   $employee_id = $staff[0]['employee_id'];
        // //print_r($productdetails);

            $productcollection =  adminproductcollection::select('name', DB::raw('GROUP_CONCAT(id) as ids'))
            ->where('status', 1)
        ->groupBy('name')
        ->get();
// dd($productcollection);
        $cate = Products::leftJoin('category', 'category.id', '=', 'products.category')
        ->leftJoin('category_main','category_main.id','=','products.category_main')
        ->leftJoin('category_sub','category_sub.id','=','products.category_sub')
        ->where('products.product_id', $id)
        ->get();
     //  print_r($cate);exit();



    //    $products1 = DB::table('products as pt')->where('pt.id', '=', $id)
	// ->join('products_details as pd', 'pd.products_id', '=', 'pt.product_id')
	// ->join('products_specs as ps', function($join)
	//  {
	// 	 $join->on('pt.id', '=', 'pt.product_id')->where('ps.products_id', '=', 'pt.id');
	//  })
	// ->select('pt.*',)
	// ->get();
    // print_r($products1);





    //    'products.category as category','products.category-main as category-main','products.category-sub as category-sub','products.product_name as product_name','products.tax-id','products.gst_id','products.product_image','products.description','products.weight','products.lenght','products.width','products.height','products.offers','products.collection'
    //    print_r($product);
              		// dd($products)
    //    ->join('zonals', 'zonals.id', '=', 'routes.zonal_id')
    //           		->get(['pincode.id','routes.name as routename', 'zonals.name as zonalname','pincode.name', 'pincode.area','pincode.post_region']);
        $colors = ProductColor::all();
        return view('layout.vendor.products.EditProduct')
            ->with([
                "product" =>$products,
                "category_main_data" => $category_main_data,
                "category" => $category,
                "categorysub" => $CategorySub,
                "gst" => $gst,
                "offers" => $offer,
                "attribute" => $attribute,
                "specification" => $specification,
                "productspecs"=> $productspecs,
                "productdetailss"=>$productdetails,
                "cates" =>$cate,
                "productsAttri"=> $productsAttri,
                "productcollection" => $productcollection,
                "colors" => $colors
            ]);
    
        // } catch(\Throwable $th) {
        //     $flasher->addError('Something Error!');
        //     return redirect()->route('products.crud.listing');
        // }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, FlasherInterface $flasher)
    {      
        try {
            $request->validate([
                'product_name' => 'required|string|max:255',
                'mainImage' => 'nullable|image|mimes:jpeg,png,jpg|max:4096',
                'mainimg.*' => 'nullable|image|mimes:jpeg,png,jpg|max:4096',
                'subimg1.*' => 'nullable|image|mimes:jpeg,png,jpg|max:4096',
                'subimg2.*' => 'nullable|image|mimes:jpeg,png,jpg|max:4096',
                'subimg3.*' => 'nullable|image|mimes:jpeg,png,jpg|max:4096',
            ]);

            $login_id = session()->get('login_id');
            $Products = Products::find($id);
            if (!$Products) {
                $flasher->addError('Product not found!');
                return redirect()->route('vendorproducts.crud.listing');
            }

            $filename = '';
            if ($request->hasFile('mainImage')) {
                $file = $request->mainImage;
                $filename = ImageUploadHelper::storeImage($file, $this->main_image_path);
            } else {
                $filename = $request->input('oldmainImage');
            }

            $Products->login_id = $login_id;
            $Products->category = $request->input('category');
            $Products->category_main = $request->input('category_main');
            $Products->category_sub = $request->input('category_sub');
            $Products->product_name = $request->input('product_name');
            $Products->tax_id = $request->input('tax_id');
            $Products->gst_id = $request->input('gst_id');
            $Products->hsncode = $request->input('hsncode');
            $Products->product_image = $filename ?? "-";
            $Products->description = $request->input('description');
            $Products->weight = $request->input('weight');
            $Products->length = $request->input('length');
            $Products->width = $request->input('width');
            $Products->height = $request->input('height');
            $Products->offers = $request->input('offer');
            $Products->collection = $request->input('collection');
            $Products->flag = 1;
            $Products->status = 1;
            $Products->created_by = $login_id;
            $Products->save();

            $detailsIds = $request->input('product_details_id') ?: [];
            $np = count($detailsIds);
            
            if ($np > 0) {
                // Pre-fetch all array inputs to avoid multiple input() calls and offset errors
                $mainimgs = $request->file('mainimg') ?: [];
                $subimg1s = $request->file('subimg1') ?: [];
                $subimg2s = $request->file('subimg2') ?: [];
                $subimg3s = $request->file('subimg3') ?: [];
                
                $oldMainImgs = $request->input('old_mainimg') ?: [];
                $oldSubImg1s = $request->input('old_subimg1') ?: [];
                $oldSubImg2s = $request->input('old_subimg2') ?: [];
                $oldSubImg3s = $request->input('old_subimg3') ?: [];
                
                $attrColors = $request->input('attrcolor') ?: [];
                $attrSizes = $request->input('attrsize') ?: [];
                $selectedAttrId = $request->input('selected_attribute_id1');
                $attrGroupName = 'Size';
                if ($selectedAttrId) {
                    $attrGroup = AttributeGroup::find($selectedAttrId);
                    if ($attrGroup) {
                        $attrGroupName = $attrGroup->attribute_group_refname ?? $attrGroup->attribute_group_name ?? 'Size';
                    }
                }
                $quantities = $request->input('quantity') ?: [];
                $retailPrices = $request->input('retail_price') ?: [];
                $sellingPrices = $request->input('selling_price') ?: [];
                $skus = $request->input('sku') ?: [];
                $returnReplaces = $request->input('return_replace') ?: [];
                $rDays = $request->input('r_days') ?: [];
                $lowStockLimits = $request->input('low_stock_limit') ?: [];

                for ($key = 0; $key < $np; $key++) {
                    $details_id = $detailsIds[$key] ?? null;
                    if ($details_id != null) {
                        $products_details = ProductsDetails::where('id', $details_id)->first();
                        if (!$products_details) {
                            $products_details = new ProductsDetails();
                            $products_details->products_id = $id;
                        }
                    
                        $prarr = [];
                        
                        // Process Images for existing details
                        $file = $mainimgs[$key] ?? null;
                        if ($file) {
                            $fname = $details_id . '.' . time() . '.' . $file->getClientOriginalName();
                            Image::make($file->getRealPath())->resize(500, 300, function ($c) {
                                $c->aspectRatio();
                            })->save($this->detail_image_path . '/' . $fname);
                            $products_details_filename = $fname;
                        } else {
                            $products_details_filename = $oldMainImgs[$key] ?? '';
                        }

                        $file1 = $subimg1s[$key] ?? null;
                        if ($file1) {
                            $fname1 = $details_id . '.' . $file1->getClientOriginalName();
                            Image::make($file1->getRealPath())->resize(500, 300, function ($c) {
                                $c->aspectRatio();
                            })->save($this->detail_image_path . '/' . $fname1);
                            $products_details_filename1 = $fname1;
                        } else {
                            $products_details_filename1 = $oldSubImg1s[$key] ?? '';
                        }

                        $file2 = $subimg2s[$key] ?? null;
                        if ($file2) {
                            $fname2 = $details_id . '.' . $file2->getClientOriginalName();
                            Image::make($file2->getRealPath())->resize(500, 300, function ($c) {
                                $c->aspectRatio();
                            })->save($this->detail_image_path . '/' . $fname2);
                            $products_details_filename2 = $fname2;
                        } else {
                            $products_details_filename2 = $oldSubImg2s[$key] ?? '';
                        }

                        $file3 = $subimg3s[$key] ?? null;
                        if ($file3) {
                            $fname3 = $details_id . '.' . $file3->getClientOriginalName();
                            Image::make($file3->getRealPath())->resize(500, 300, function ($c) {
                                $c->aspectRatio();
                            })->save($this->detail_image_path . '/' . $fname3);
                            $products_details_filename3 = $fname3;
                        } else {
                            $products_details_filename3 = $oldSubImg3s[$key] ?? '';
                        }

                        $prarr = [$products_details_filename, $products_details_filename1, $products_details_filename2, $products_details_filename3];
                        $products_details->product_detail_image = json_encode($prarr);

                    } else {
                        // Handle New Product Details (if any - though usually handled by separate add more)
                        $products_details = new ProductsDetails();
                        $products_details->products_id = $id;
                        $prarr = ['', '', '', ''];
                        $products_details->product_detail_image = json_encode($prarr);
                    }
                 
                    $products_details->color = $attrColors[$key] ?? null;
                    $products_details->size = $attrSizes[$key] ?? null;
                    $products_details->attributevalue1 = $attrColors[$key] ?? null;
                    $products_details->attributename1 = 'Color';
                    $products_details->attributevalue2 = $attrSizes[$key] ?? null;
                    if (!empty($products_details->attributevalue2)) {
                        $products_details->attributename2 = $attrGroupName;
                    }
                    $products_details->quantity = $quantities[$key] ?? 0;
                    $products_details->retail_price = $retailPrices[$key] ?? 0;
                    $products_details->selling_price = $sellingPrices[$key] ?? 0;
                    $products_details->sku = is_array($skus) ? ($skus[$key] ?? '') : ($request->input('sku') ?? '');
                    $products_details->return_replace = is_array($returnReplaces) ? ($returnReplaces[$key] ?? 'Return') : ($request->input('return_replace') ?? 'Return');
                    $products_details->r_days = is_array($rDays) ? ($rDays[$key] ?? 0) : ($request->input('r_days') ?? 0);
                    $products_details->low_stock_limit = $lowStockLimits[$key] ?? 0;
                    $products_details->save();
                }            
            }

            // SPECIFICATIONS (Using unified spec_id/specify_attribute/specify_value)
            if ($request->has('spec_id')) {
                $specIds = $request->input('spec_id');
                $specifyAttributes = $request->input('specify_attribute') ?: [];
                $specifyValues = $request->input('specify_value') ?: [];

                ProductSpecs::where('products_id', $id)->delete();
                foreach ($specIds as $valIdx) {
                    $spec = new ProductSpecs();
                    $spec->products_id = $id;
                    $spec->category_sub_id = $request->input('category_sub');
                    $spec->spec_id = $valIdx;
                    $spec->specify_attribute = $specifyAttributes[$valIdx] ?? null;
                    $spec->specify_value = $specifyValues[$valIdx] ?? null;
                    $spec->save();
                }
            }

            // Legacy Attributes (specify_attri) - If still used
            if ($request->has('specify_attri')) {
                productsAttri::where('products_id', $id)->delete();
                $attriNames = $request->input('specify_attri') ?: [];
                $attriValues = $request->input('atttibute_value') ?: [];
                foreach ($attriNames as $k => $v) {
                    if (!empty($v)) {
                        $pa = new productsAttri();
                        $pa->products_id = $id;
                        $pa->category_sub_id = $request->input('category_sub');
                        $pa->spec_attribute = $v;
                        $pa->spec_value = $attriValues[$k] ?? null;
                        $pa->flag = 1;
                        $pa->status = 1;
                        $pa->created_by = "1";
                        $pa->save();
                    }
                }
            }

            $flasher->addSuccess('Product Updated successfully!');
            return redirect()->route('vendorproducts.crud.listing');
           
        } catch (\Throwable $th) {
            Log::error('Vendor product update failed', [
                'product_id' => $id,
                'message' => $th->getMessage(),
                'line' => $th->getLine()
            ]);
            $flasher->addError('Something Error! ' . $th->getMessage());
            return redirect()->route('vendorproducts.crud.listing');
        }
        // print_r($category);exit;

        //    print_r($input);exit();
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
            $image = Products::find($id);

          
           // print_r($image);exit();
            $file = $this->image_path1 . "/" . $image->product_image;
             
            if (file_exists($file)) unlink($file);

             Products::where("id", $id)->delete();


        // $productsdetails = new ProductsDetails();
        $productsdetails = ProductsDetails::where('products_id',$id)->get();
        $productsdetails_id = $productsdetails[0]['products_id'];
    //    print_r($productsdetails_id);exit();
        
        if($productsdetails_id){
            ProductsDetails::where("products_id", $productsdetails_id)->delete();
        }

        $productsspecs = ProductSpecs::where('products_id',$id)->get();
        // print_r($productsspecs);
        $productsspecs_id = $productsspecs[0]['products_id'];
       // print_r($productsspecs_id);exit();
        if($productsspecs_id){
            ProductSpecs::where("products_id", $id)->delete();
        }

            
            

            $flasher->addsuccess('Product Removed!');
            return redirect()->route('vendorproducts.crud.listing');
        } catch(\Throwable $th) {
            $flasher->addError('Something Error!');
            return redirect()->route('vendorproducts.crud.listing');
        }
		
    }



    



    public function listing()
    {
        //return'rgdrf';
        $vendor_id = session()->get('login_id');
        $products_list = Products::where('login_id', $vendor_id)->where('flag',1)->get();
         $categorySub = CategorySub::where('status',1)->get();
          $products_details = ProductsDetails::whereHas('product', function($query) use ($vendor_id) {
              $query->where('login_id', $vendor_id);
          })->where('status',1)->get();
        // $offer = offer::get();
        $offer = offer::where('status',1)->get();

        $productDetailsCount = Products::select(DB::raw('COUNT(products.id) as product_details_cnt'))
            ->leftJoin('products_details', 'products.id', '=', 'products_details.products_id')
            ->where('products.logintype', "Vendor")
            ->where('products.flag',1)
            ->groupBy('products.id')
            ->get();


            $product_price = Products::leftJoin('products_details', function($join) {
                $join->on('products.id', '=', 'products_details.products_id');
              })
            //   ->whereNull('products_details.products_id')
              ->first();







        $products_list_arr = array();

        foreach ($products_list as $key => $value) {
            $a = json_decode($products_list[$key]);
            
            $b = json_decode($productDetailsCount[$key]);
            
            $arr = (object)array_merge((array)$a, (array)$b);
            
            //  print_r($arr);exit();

            array_push($products_list_arr, $arr);
        }
        // foreach( $categorySub as $k => $v){
        //  $c=json_decode($categorySub[$k]);
        //  $ar = (object)(array($c));
        // }
        // print_r($ar);exit();



        return view("layout.admin.products.product-listing")->with(
            [
                "products_list"=> $products_list_arr,
                "offers" => $offer,
                "categorysub" =>$categorySub,
                "product_price" =>$product_price
            ]
        );
    }


    public function vendorlisting()
    {
       //return 'vendorlisting';
       // $pros = Products::find($id);
      // $products_list = Products::get();
       $vendor_id = session()->get('login_id');
       $products_list = Products::where('login_id', $vendor_id)->where('logintype', "Vendor")->where('flag',1)->get();
      // dd($products_list);
		if(isset($products_list[0]->product_id))
		{
			$vendor_products_id = $products_list[0]->product_id;
		}
		else
		{
			$vendor_products_id ='';
		}
        // dd($vendor_products_id);
        //$products_list = Products::get();
        
        
         $categorySub = CategorySub::where('status',1)->get();
         $products_details = ProductsDetails::get();
         // $offer = offer::get();
         $offer = offer::where('status',1)->get();

        $productDetailsCount = Products::select(DB::raw('COUNT(products.id) as vendor_product_details_cnt'))
            ->leftJoin('products_details', 'products.id', '=', 'products_details.products_id')
            // ->where('products_details.products_id', '=', $products_id)
			->where('products.logintype', "Vendor")
			->where('products.flag',1)
			->groupBy('products.id')			
            ->get();
           //dd($productDetailsCount);



            $product_price = Products::leftJoin('products_details', function($join) {
                $join->on('products.id', '=', 'products_details.products_id');
              })
            //   ->whereNull('products_details.products_id')
              ->first();







        $products_list_arr = array();

        foreach ($products_list as $key => $value) {
            $a = json_decode($products_list[$key]);
            
            $b = json_decode($productDetailsCount[$key]);
            
            $arr = (object)array_merge((array)$a, (array)$b);
            
            //  print_r($arr);exit();
            
            
             
            array_push($products_list_arr, $arr);
        }
        // foreach( $categorySub as $k => $v){
        //  $c=json_decode($categorySub[$k]);
        //  $ar = (object)(array($c));
        // }
        // print_r($ar);exit();



        return view("layout.vendor.products.product-listing")->with(
            [
                "products_list"=> $products_list_arr,
                "offers" => $offer,
                "categorysub" =>$categorySub,
                "product_price" =>$product_price,
                "vendorid"  => 0
            ]
        );
    }

    public function getProductDetails(Request $request)
    {
        $productDetails = ProductsDetails::where("products_id", "=", $request->product_id)->get();
        return response()->json($productDetails);
    }

    public function updateProductDetails(Request $request, FlasherInterface $flasher)
    {

        $UpdateProductDetails = ProductsDetails::where("products_id", "=", $request->product_id)->get();
        try {
            $productIds = $request->input('prodt_id');
    $quantities = $request->input('quantity');
    $lowStockLimits = $request->input('low_stock_limit');
    $retailPrices = $request->input('retail_price');
    $sellingPrices = $request->input('selling_price');
    $productId = $request->input('product_id');

    // Loop through each product and update
    foreach ($productIds as $index => $id) {
        ProductsDetails::where('id', $id)->update([
            'quantity' => $quantities[$index],
            'retail_price' => $retailPrices[$index],
            'selling_price' => $sellingPrices[$index],
            'low_stock_limit' => $lowStockLimits[$index],
            'updated_at' => now(), // Assuming you want to update the timestamp
        ]);
    }

            $flasher->addSuccess('Product Details Updated successfully!');
            return redirect()->route('vendorproducts.crud.listing');
        } catch (\Throwable $th) {
            $flasher->addError('Something Error!!');
            return redirect()->route('vendorproducts.crud.listing');
        }
    }
    public function getsubproductdetails(Request $request){

        $spec_ProductSpecs = ProductSpecs::where('category_sub_id', $request->sub_category_id)->get();
        //    // print_r($spec_data);exit();
             return response()->json($spec_ProductSpecs);
    }
    


    public function view($id)
    {

       
        $products = Products::find($id);
        // print_r($productInfo);
        $category = Category::get();
        $category_main_data = CategoryMain::get();
        $CategorySub = CategorySub::get();
        
        $gst = GST::get();
        $attribute = Attribute::get();
        $offer = offer::get();
        $specification = Specification::where('category_sub_id', $id)->get();
        $specifi = Specification::get();
        $productdetails = ProductsDetails::where('products_id', $id)->get();
        
        $productspecs = ProductSpecs::where('products_id', $id)->get();
        $productsAttri = productsAttri::where('products_id', $id)->get();
    
       $cate = Products::join('category', 'category.id', '=', 'products.category')
       ->join('category_main','category_main.id','=','products.category_main')
        ->join('category_sub','category_sub.id','=','products.category_sub')
        ->where('products.id', $id)
       ->get();
     
        return view('layout.admin.products.ViewProduct')
            ->with([
                "product" =>$products,
                "category_main_data" => $category_main_data,
                "category" => $category,
                "categorysub" => $CategorySub,
                "gst" => $gst,
                "offers" => $offer,
                "attribute" => $attribute,
                "specification" => $specification,
                "specifi" => $specifi,
                "productspecs"=> $productspecs,
                "productdetailss"=>$productdetails,
                "cates" =>$cate,
                "productsAttri"=> $productsAttri
            ]);
    }

    public function v_p_view($id, $category_sub)
    {

       
        $products = vendorProducts::find($id);
        // print_r($productInfo);
        $category = Category::get();
        $category_main_data = CategoryMain::get();
        $CategorySub = CategorySub::get();
        
        $gst = GST::get();
        $attribute = Attribute::where('category_sub_id', $category_sub)->get();
       // print_r($attribute);exit();
        $offer = offer::get();
        $specification = Specification::where('category_sub_id', $id)->get();
        $specifi = Specification::get();
        $productdetails = vendorProductsDetails::where('products_id', $id)->get();
        
        $productspecs = ProductSpecs::where('products_id', $id)->get();
        $productsAttri = productsAttri::where('products_id', $id)->get();
        //print_r($productsAttri);exit();
        //print_r($specifi[0]->value);exit();
        // $res['list']= JSON_decode($specifi[0]->value);
        // //print_r($res);exit();
        // foreach ($specifi as $key => $value) {

        //     //echo $key;
        //      //print_r(JSON_decode($value));
        //     // echo $value['id'].','.$value['category_sub_id'].','.$value['name'].','.$value['value'];


        //     //print_r(JSON_decode($value['value']));
        //     $val = JSON_decode($value['value']);
        //     foreach($val as $k =>$v)
        //     {
        //        // echo $k;
        //         echo $v;
        //     }
        //     // exit();
        // }
        // exit();
        // $staff = Staffcreates::where('employee_id',$employee_id)->get();
        //  //print_r($staff[0]['employee_id']);exit();
        //   $employee_id = $staff[0]['employee_id'];
        // //print_r($productdetails);



       $cate = vendorProducts::join('category', 'category.id', '=', 'products.category')
       ->join('category_main','category_main.id','=','products.category_main')
        ->join('category_sub','category_sub.id','=','products.category_sub')
        ->where('products.id', $id)
       ->get();
     // dd($products); 
     //  print_r($cate);exit();



    //    $products1 = DB::table('products as pt')->where('pt.id', '=', $id)
	// ->join('products_details as pd', 'pd.products_id', '=', 'pt.product_id')
	// ->join('products_specs as ps', function($join)
	//  {
	// 	 $join->on('pt.id', '=', 'pt.product_id')->where('ps.products_id', '=', 'pt.id');
	//  })
	// ->select('pt.*',)
	// ->get();
    // print_r($products1);


          $productcollection  =  vendorproductcollection::get();


    //    'products.category as category','products.category-main as category-main','products.category-sub as category-sub','products.product_name as product_name','products.tax-id','products.gst_id','products.product_image','products.description','products.weight','products.lenght','products.width','products.height','products.offers','products.collection'
    //    print_r($product);
              		
    //    ->join('zonals', 'zonals.id', '=', 'routes.zonal_id')
    //           		->get(['pincode.id','routes.name as routename', 'zonals.name as zonalname','pincode.name', 'pincode.area','pincode.post_region']);

        return view('layout.admin.products.EditProduct')
            ->with([
                //"vendorid" => $vendor_id,
                "product" =>$products,
                "category_main_data" => $category_main_data,
                "category" => $category,
                "categorysub" => $CategorySub,
                "gst" => $gst,
                "offers" => $offer,
                "attribute" => $attribute,
                "specification" => $specification,
                "specifi" => $specifi,
                "productspecs"=> $productspecs,
                "productdetailss"=>$productdetails,
                "cates" =>$cate,
                "productsAttri"=> $productsAttri,
                "productcollection" => $productcollection 
            ]);
    }

    public function productsdetailsdelete(Request $request, $id)  
    {
        // dd($request->id);
        
        ProductsDetails::find($id)->delete();
        //echo 'test';
        return response()->json('msg:success');
       //return redirect()->back();
    }
    
    /* Product bulk Delete */
    public function productbulkdelete(Request $request)
    {

        // dd($request->all());

    //   echo 'test';   
      $sts = $request->sts;

          $ids = $request->ids;
          $id = explode(",",$ids);
         // print_r( $id );
    //   $sts = $request->sts;
    foreach($id as $idr)
    {
        Products::where('id',$idr)->update(['flag'=>$sts,'status'=>$sts]);
        // ProductsDetails::where('id',$id)->update(['status'=>$sts]);
    //   DB::table("ordersproduct")->whereIn('id',$idr)->update(['order_status'=>$sts]);
    }
    
      return response()->json(['success'=>"Products Updated successfully."]);

    }

    /* Active Product */

    /* Product bulk Delete */
    public function productbulkactive(Request $request)
    {

        // dd($request->all());

    //   echo 'test';   
      $sts = $request->sts;

          $ids = $request->ids;
          $id = explode(",",$ids);
         // print_r( $id );
    //   $sts = $request->sts;
    foreach($id as $idr)
    {
        Products::where('id',$idr)->update(['status'=>$sts]);
        // ProductsDetails::where('id',$id)->update(['status'=>$sts]);
    //   DB::table("ordersproduct")->whereIn('id',$idr)->update(['order_status'=>$sts]);
    }
    
      return response()->json(['success'=>"Products Updated successfully."]);

    }
    /*End*/

    /* Product bulk Delete */
    public function productbulkdeactive(Request $request)
    {

        // dd($request->all());

    //   echo 'test';   
      $sts = $request->sts;

          $ids = $request->ids;
          $id = explode(",",$ids);
         // print_r( $id );
    //   $sts = $request->sts;
    foreach($id as $idr)
    {
        Products::where('id',$idr)->update(['status'=>$sts]);
        // ProductsDetails::where('id',$id)->update(['status'=>$sts]);
    //   DB::table("ordersproduct")->whereIn('id',$idr)->update(['order_status'=>$sts]);
    }
    
      return response()->json(['success'=>"Products Updated successfully."]);

    }
    /*End*/
    
     /*Vendar*/
    /* Product bulk Delete */
    public function vendorproductbulkdelete(Request $request)
    {

        // dd($request->all());

    //   echo 'test';   
      $sts = $request->sts;

          $ids = $request->ids;
          $id = explode(",",$ids);
         // print_r( $id );
    //   $sts = $request->sts;
    foreach($id as $idr)
    {
        Products::where('id',$idr)->update(['flag'=>$sts,'status'=>$sts,'logintype'=>'Vendor']);
        // ProductsDetails::where('id',$id)->update(['status'=>$sts]);
    //   DB::table("ordersproduct")->whereIn('id',$idr)->update(['order_status'=>$sts]);
    }
    
      return response()->json(['success'=>"Products Updated successfully."]);

    }

    /* Active Product */

    /* Product bulk active */
    public function vendorproductbulkactive(Request $request)
    {

        // dd($request->all());

    //   echo 'test';   
      $sts = $request->sts;

          $ids = $request->ids;
          $id = explode(",",$ids);
         // print_r( $id );
    //   $sts = $request->sts;
    foreach($id as $idr)
    {
        Products::where('id',$idr)->update(['status'=>$sts,'logintype'=>'Vendor']);
        // ProductsDetails::where('id',$id)->update(['status'=>$sts]);
    //   DB::table("ordersproduct")->whereIn('id',$idr)->update(['order_status'=>$sts]);
    }
    
      return response()->json(['success'=>"Products Updated successfully."]);

    }
    /*End*/

    /* Product bulk deactive */
    public function vendorproductbulkdeactive(Request $request)
    {

        // dd($request->all());

    //   echo 'test';   
      $sts = $request->sts;

          $ids = $request->ids;
          $id = explode(",",$ids);
         // print_r( $id );
    //   $sts = $request->sts;
    foreach($id as $idr)
    {
        Products::where('id',$idr)->update(['status'=>$sts,'logintype'=>'Vendor']);
        // ProductsDetails::where('id',$id)->update(['status'=>$sts]);
    //   DB::table("ordersproduct")->whereIn('id',$idr)->update(['order_status'=>$sts]);
    }
    
      return response()->json(['success'=>"Products Updated successfully."]);

    }
    /*End*/
}


