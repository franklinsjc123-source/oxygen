<?php

namespace App\Http\Controllers\ProductsController;

use App\Helper\ImageUploadHelper\ImageUploadHelper;
use App\Http\Controllers\Controller;
use App\Models\Category\CategoryMain;
use App\Models\Products\Products;
use Flasher\Prime\FlasherInterface;
use Illuminate\Http\Request;
use App\Models\Products\productcollection;
use App\Models\Category\Category;
use App\Models\Category\CategorySub;
use App\Models\Master\Attribute\Attribute;
use App\Models\Master\GST\GST;
use App\Models\Master\Specification\Specification;
use App\Models\Products\ProductsDetails;
use App\Models\Products\ProductsSpecs;
use App\Models\Products\ProductSpecs;
use App\Models\Products\productsAttri;
use App\Models\Offer\offer;

use DB;
use Illuminate\Support\Facades\DB as FacadesDB;

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
        $category_main_data = CategoryMain::get();
        $gst = GST::get();
        $attribute = Attribute::get();
        $specification = Specification::get();
        $productcollection = productcollection::get();
        $offer = offer::get();

        return view('layout.admin.products.add-product')
            ->with([
                "category_main_data" => $category_main_data,
                "gst" => $gst,
                "attribute" => $attribute,
                "productcollection" => $productcollection,
                "specification" => $specification,
                "offers" => $offer
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


    //  public function store(Request $request, FlasherInterface $flasher)
    //  {
    //     $products = new Products();

    //     // print_r($products);
    //     $file = $request->mainImage;
    //     // $file1 = $request->galleryImages;

    //     if ($file !== null) $filename = ImageUploadHelper::storeImage($file, $this->image_path1);
    //     // if ($file1 !== null) $filename1 = ImageUploadHelper::storeImage($file1, $this->image_path1);

    //     $statement = FacadesDB::select("SHOW TABLE STATUS LIKE 'products'");
    //     $next_product_id = $statement[0]->Auto_increment;
    //     //   print_r($next_product_id);exit();
    //    try {
            
    //         $products->product_id = $next_product_id;
	// 		$products->category = $request->category;
    //         $products->category_main = $request->category_main;
    //         $products->category_sub = $request->category_sub;
    //         $products->product_name = $request->product_name;
    //         $products->tax_id = $request->tax_id;
    //         $products->gst_id = $request->gst_id;

    //         $products->product_image = $filename ?? "-";
    //         // $products->product_gallery_image = $filename1 ?? "-";
    //         $products->description = $request->description;
    //         $products->weight = $request->weight;
    //         $products->length = $request->length;
    //         $products->width = $request->width;
    //         $products->height = $request->height;

    //         $products->offers = $request->offer;
    //         $products->collection = $request->collection;
    //         $products->flag = 0;
    //         $products->status = $request->status ?? 1;
    //         $products->created_by = "1";
    //         // echo $query;exit();
    //         if( $products->save()){
    //             $np = count($request->nproducts);
    //             echo $np;exit();
                
    //             for ($key = 0; $key < $np; $key++) {
    //             $products_details = new ProductsDetails();
    //             $products_details->products_id = $next_product_id;
    //              $products_details->retail_price = $request->retail_price[$key];
    //             $products_details->save();
    //             // dd($products_details);
    //             exit();
    //             // echo($query1);exit();
    //             }
                

    //         //    echo $products_details->products_id = $request->retail_price;

    //         }


    //         $flasher->addSuccess('New Product Added successfully!');
    //         return redirect()->route('products.crud.listing');
    //    } catch (\Throwable $th) {
    
    //         $flasher->addError('Something Error!!');
    //         return redirect()->route('products.crud.index');
    //    }

    
    //  }

     
    public function store(Request $request, FlasherInterface $flasher)
    {
        // echo 'test';
         $products = new Products();
        // print_r($products);

        $statement = FacadesDB::select("SHOW TABLE STATUS LIKE 'products'");
        $next_product_id = $statement[0]->Auto_increment;
        // // dd($request->specification);

        $products = new Products();
        $filename = '';
        if (isset($request->mainImage)) {
            $file = $request->mainImage;

            if ($file !== null) {
                $filename = ImageUploadHelper::storeImage($file, $this->main_image_path);
            }
        }

            $products->product_id = $next_product_id;
			$products->category = $request->category;
            $products->category_main = $request->category_main;
            $products->category_sub = $request->category_sub;
            $products->product_name = $request->product_name;
            $products->tax_id = $request->tax_id;
            $products->gst_id = $request->gst_id;
            $products->product_image = $filename ?? "-";
            $products->description = $request->description;
            $products->weight = $request->weight;
            $products->length = $request->length;
            $products->width = $request->width;
            $products->height = $request->height;
            $products->offers = $request->offers;
            $products->collection = $request->collection;
            $products->flag = 0;
            $products->status = $request->status ?? 1;
            $products->created_by = "1";
            $products->save();
                // $np = count($request->nproducts);
                // // echo  $np;exit();
                // if($np>0){
                // for ($key = 0; $key <=$np; $key++) {
                // //    print_r($request->specify_attri);
                // //    print_r($request->atttibute_value);
               
                //     $products_details = new ProductsDetails();
                //     $products_details_filename = '';
                //     if (isset($request->nproducts[$key])) {
                //         $products_details_file = $request->nproducts[$key];    
                //         if ($products_details_file !== null) {
                //             $products_details_filename = ImageUploadHelper::storeImage($products_details_file, $this->detail_image_path);
                //         }
                //     }
                
                //     $products_details->products_id = $next_product_id;
                //     $products_details->product_detail_image = $products_details_filename ?? "-";        
                       
                //     $products_details->quantity = $request->quantity[$key];
                //     $products_details->retail_price = $request->retail_price[$key];
                //     $products_details->selling_price = $request->selling_price[$key];
                //     $products_details->sku = $request->sku[$key];
                //     $products_details->return_replace = $request->return_replace[$key] ?? 1;
                //     $products_details->r_days = $request->r_days[$key];
                //     $products_details->low_stock_limit = $request->low_stock_limit[$key];                 
                //     $products_details->save();
                   
                // }
                // }



                  // Loop for product details
            $np = count($request->nproducts);
           // foreach ($request->nproducts as $key => $value) {
            for ($key = 0; $key < $np; $key++) {
                $products_details = new ProductsDetails();
                $products_details_filename = '';
                if (isset($request->nproducts[$key])) {
                      
                    $products_details_file = $request->nproducts[$key];
                  

                    if ($products_details_file != null) {
                      
                     // $products_details_filename = ImageUploadHelper::storeImage($products_details_file, $this->detail_image_path);
                    

                      
                      $products_details_filename = $products_details_file->getClientOriginalName();
                      
                      $products_details_file->move('assets/images/products/detail', $products_details_filename);


       
                    }
                }

                $products_details->products_id = $next_product_id;
                $products_details->product_detail_image = $products_details_filename ?? "-";
                // $products_details->attributevalue1 = isset($request->attributeDetails1[$key]) ? $request->attributeDetails1[$key] : '';
                // $products_details->attributename1 = isset($request->attributename1[$key]) ? $request->attributename1[$key] : '';
                // $products_details->attributevalue2 = isset($request->attributeDetails2[$key]) ? $request->attributeDetails2[$key] : '';
                // $products_details->attributename2 = isset($request->attributename2[$key]) ? $request->attributename2[$key] : '';
                // $products_details->attributevalue3 = isset($request->attributeDetails3[$key]) ? $request->attributeDetails3[$key] : '';
                // $products_details->attributename3 = isset($request->attributename3[$key]) ? $request->attributename3[$key] : '';
                
                $products_details->color = isset($request->attrcolor[$key]) ? $request->attrcolor[$key] : NULL;
                $products_details->size = isset($request->attrsize[$key]) ? $request->attrsize[$key] : NULL;
                                // $products_details->size = $request->attrsize[$key];
                $products_details->quantity = $request->quantity[$key];
                $products_details->retail_price = $request->retail_price[$key];
                $products_details->selling_price = $request->selling_price[$key];
                $products_details->sku = $request->sku[$key];
               $products_details->return_replace = $request->return_replace[$key] ?? 1;
                $products_details->r_days = $request->r_days[$key];
                $products_details->low_stock_limit = $request->low_stock_limit[$key];
                //$products_details->threshold = $request->threshold[$key];

                 $products_details->save();
                
            }
           
           
                if(isset($request->specify_attribute)){

            
                    foreach ($request->specify_attribute as $key => $value) {

                        $products_spec = new ProductSpecs();
        
                        $products_spec->products_id = $next_product_id;
                        $products_spec->category_sub_id = $request->category_sub;
                        $products_spec->specify_attribute = $request->specify_attribute[$key];
                        $products_spec->specify_value = $request->specify_value[$key];
                        $products_spec->save();
                    }	
               
                }
                if(isset($request->specify_attri)){

                    foreach($request->specify_attri as $k=>$v){
                        $productsAttri = new productsAttri();
                        $productsAttri->products_id = $next_product_id;
                        $productsAttri->category_sub_id = $request->category_sub;   
                        $productsAttri->spec_attribute = $request->specify_attri[$k];
                        $productsAttri->spec_value = $request->atttibute_value[$k];                    
                        $productsAttri->flag = 0;
                        $productsAttri->status = $request->status ?? 1;
                        $productsAttri->created_by = "1";
                        $productsAttri->save();
                   }
                }
                
           

            
          



            $flasher->addSuccess('New Product Added successfully!');
            return redirect()->route('products.crud.listing');
        // } catch (\Throwable $th) {
        // print_r($th);exit();
            $flasher->addError('Something Error!!');
            return redirect()->route('products.crud.index');
        // }
    }

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
    public function edit($id, $category_sub)
    {
        //  echo $id;exit();
        $products = Products::find($id);
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
        $productdetails = ProductsDetails::where('products_id', $id)->get();
        
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



       $cate = Products::join('category', 'category.id', '=', 'products.category')
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





    //    'products.category as category','products.category-main as category-main','products.category-sub as category-sub','products.product_name as product_name','products.tax-id','products.gst_id','products.product_image','products.description','products.weight','products.lenght','products.width','products.height','products.offers','products.collection'
    //    print_r($product);
              		
    //    ->join('zonals', 'zonals.id', '=', 'routes.zonal_id')
    //           		->get(['pincode.id','routes.name as routename', 'zonals.name as zonalname','pincode.name', 'pincode.area','pincode.post_region']);

        return view('layout.admin.products.EditProduct')
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, FlasherInterface $flasher)
    {
        
         $Products = Products::find($id);
         //$input = $request->all();
         //print_r($input);exit;
    

         $filename = '';
    
            if(isset($request->mainImage))
            {
            
                $file = $request->mainImage;
                if ($file !== null) {
                $filename = ImageUploadHelper::storeImage($file, $this->main_image_path);
                }
            } else{

               
                $filename = $request->oldmainImage;
            }
         
         $products = new Products();
        $Products->category = $request->input('category');
        $Products->category_main = $request->input('category_main');
       
        $Products->category_sub = $request->input('category_sub');
        $Products->product_name = $request->input('product_name');
        $Products->tax_id = $request->input('tax_id');
        $Products->gst_id = $request->input('gst_id');
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
        $Products->created_by = 1;
        $Products->save();


        


        $filename1 = '';
    
       

        $np = count($request->oldnproducts);
      // echo $np;exit(); 
        // dd($request->all());
        if($np > 0){
       // echo  $np;exit;
      //  $np = count($request->nproducts);
          //  print_r($np);exit();



           //foreach ($request->nproducts as $key => $value) {

            for ($key = 0; $key < $np; $key++) {


               
               $details_id =$request->product_details_id[$key];
                // $products_details = new ProductsDetails();
                $products_details = ProductsDetails::find($details_id);
                $products_details_filename = '';
                if (isset($request->nproducts[$key])) {
                $products_details_file = $request->nproducts[$key];

                    if ($products_details_file !== null) {
                        $products_details_filename = $products_details_file->getClientOriginalName();
                        $products_details_file->move('assets/images/products/detail', $products_details_filename);
                   // $products_details_filename = ImageUploadHelper::storeImage($products_details_file, $this->detail_image_path);
                    }
                }
                else{
        
                     $products_details_filename = $request->oldnproducts[$key];
                    }

          
                
                // $products_details->products_id = $next_product_id;
              //  dd($request->all());
            // echo $products_details->product_detail_image = $products_details_filename ?? "$request->nproducts";
                
                $products_details->product_detail_image = $products_details_filename ?? "-";

                 $products_details->color = $request->attrcolor[$key];
                 $products_details->size = $request->attrsize[$key];

                // echo  $products_details->color = isset($request->attrcolor[$key]) ? $request->attrcolor[$key] : NULL;
                //  echo $products_details->size = isset($request->attrsize[$key]) ? $request->attrsize[$key] : NULL; exit();
                 $products_details->quantity = $request->quantity[$key];
                 $products_details->retail_price = $request->retail_price[$key];
                 $products_details->selling_price = $request->selling_price[$key];
                 $products_details->sku = $request->sku[$key];
                $products_details->return_replace = $request->return_replace[$key] ?? 1;
                 $products_details->r_days = $request->r_days[$key];
                 $products_details->low_stock_limit = $request->low_stock_limit[$key];
           
                // $products_details->threshold = $request->threshold[$key];
             //  print_r($products_details);exit();
              //  exit();
                $products_details->update();
            }
            
        }
            //print_r($request->spec_value);exit();
          
            //  if(isset($request->specify_attribute)){
                if(isset($request->speci_value)){
               // spec_value
             // dd($request->all());
             //print_r($request->speci_value);exit;
                $ischanged= false;
               
                 foreach ($request->speci_value as $key => $value)
                
                {   
                    
                    // echo $key;
                    // echo $value;
                    // exit();
                   
                    if(!is_null($request->speci_value[$key])){
                        
                        $ischanged= true;
                //     $products_spec = new ProductSpecs();
    
                //     $products_spec->products_id = $id;
                //     $products_spec->category_sub_id = $request->category_sub;
                   
                //    $products_spec->specify_attribute = $request->speci_value[$key];
                //    $products_spec->specify_value = $request->spec_value[$key];
                //     $products_spec->update();
                    }
                    if($ischanged){
                        $ischanged= true;
                        $products_spec = new ProductSpecs();
        
                        $products_spec->products_id = $id;
                        $products_spec->category_sub_id = $request->category_sub;
                       
                       $products_spec->specify_attribute = $request->speci_value[$key];
                       $products_spec->specify_value = $request->speci_value[$key];
                        $products_spec->update();
                       // $products_spec = ProductSpecs::where('products_id',$id)->delete();
                        // foreach ($request->spec_value as $key => $value) {
                        // $products_spec = new ProductSpecs();
    
                        // $products_spec->products_id = $id;
                        // $products_spec->category_sub_id = $request->category_sub;
                        // $products_spec->specify_attribute = $request->spec_value[$key];
                        // $products_spec->specify_value = $request->specify_value[$key];
                        // $products_spec->save();
                        // }
                    }
                   
                }	
               
               

                //print_r($request->specify_attribute);exit();    
                //  ProductSpecs::where("products_id", $id)->delete();

                        //     foreach ($request->specify_attribute as $key => $value) {
                        //         // echo $key;
                        //         // echo $key;
                        //         // exit();
                            
                        //         //dd($request->all());
                        //         // dd($products_spec);
                            
                        //         // echo $value;
                        //         // echo $key;exit();
                        //         // $products_spec = new ProductSpecs();
                        //         // print_r($products_spec);exit();
                        //         //print_r($products_spec);exit();
                        //        // $products_spec->products_id = $next_product_id;
                            
                        //      $products_spec->category_sub_id = $request->category_sub;

                        //       $products_spec->specify_attribute = $request->specify_attribute[$key];
                        //       $products_spec->specify_value = $request->specify_value[$key];
                        //    //  print_r($products_spec);exit();
                        //   //  dd($products_spec);
                        //       $products_spec->save();
                        //     }	
                
             }
           // print_r($request->specify_attri);exit();
             if(isset($request->specify_attri)){
                
            //  dd($request->all());
            
                $ischange= false;
              
               foreach ($request->specify_attri as $k => $v)
              // for ($k = 0; $k < $res; $k++) 
                {
                     if(!is_null($request->specify_attri)){
                        $ischange= true;
                        $productsAttri = new productsAttri();
    
                        $productsAttri->products_id = $id;
                        $productsAttri->category_sub_id = $request->category_sub;
                        $productsAttri->spec_attribute = $request->specify_attri[$k];
                        $productsAttri->spec_value = $request->atttibute_value[$k];
                        
                         $productsAttri->save();
                    }
                    if($ischange){
                       // $productsAttri->products_id = $id;
                         $productsAttri = productsAttri::where('products_id',$id)->delete();
                         foreach ($request->specify_attri as $ke => $va)
                          {
                            
                            $productsAttri = new productsAttri();
    
                            $productsAttri->products_id = $id;
                            $productsAttri->category_sub_id = $request->category_sub;
                           $productsAttri->spec_attribute = $request->specify_attri[$ke];
                           $productsAttri->spec_value = $request->atttibute_value[$ke];exit();
                            $productsAttri->flag = 1;
                            $productsAttri->status = 1;
                            $productsAttri->created_by = "1";
                       
                             $productsAttri->save();
                        }
                       
                    }
               }
           
              
            }

            $flasher->addSuccess('New Product Updated successfully!');
            return redirect()->route('products.crud.listing');
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
            
            if (!file_exists($file)) unlink($file);

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
            return redirect()->route('products.crud.listing');
        } catch(Throwable $th) {
            $flasher->addError('Something Error!');
            return redirect()->route('products.crud.listing');
        }
		
    }

    public function listing()
    {
        $products_list = Products::get();
         $categorySub = CategorySub::get();
         $products_details = ProductsDetails::get();
        // $offer = offer::get();
        $offer = offer::get();

        $productDetailsCount = Products::select(FacadesDB::raw('COUNT(products.id) as product_details_cnt'))
            ->leftJoin('products_details', 'products.id', '=', 'products_details.products_id')
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


    public function getProductDetails(Request $request)
    {
        $productDetails = ProductsDetails::where("products_id", "=", $request->product_id)->get();
        return response()->json($productDetails);
    }

    public function updateProductDetails(Request $request, FlasherInterface $flasher)
    {

        $UpdateProductDetails = ProductsDetails::where("products_id", "=", $request->product_id)->get();
        try {
            foreach ($UpdateProductDetails as $key => $value) {
                $UpdateProductDetails[$key]->attributevalue1 = $request->attributevalue1[$key];
                $UpdateProductDetails[$key]->attributevalue2 = $request->attributevalue2[$key];
                $UpdateProductDetails[$key]->quantity = $request->quantity[$key];
                $UpdateProductDetails[$key]->retail_price = $request->retail_price[$key];
                $UpdateProductDetails[$key]->save();
            }

            $flasher->addSuccess('Product Details Updated successfully!');
            return redirect()->route('products.crud.listing');
        } catch (\Throwable $th) {
            $flasher->addError('Something Error!!');
            return redirect()->route('products.crud.listing');
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



    public function productdetailsdelete(Request $request)
    {

        //echo 'test';
        ProductsDetails::find($request->id)->delete();
        
        
        return response()->json([
            'success' => 'Record deleted successfully!'
        ]);
        

        
    }
}
