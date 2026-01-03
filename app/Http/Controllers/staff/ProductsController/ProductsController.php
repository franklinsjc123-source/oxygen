<?php
namespace App\Http\Controllers\staff\ProductsController;
use App\Models\vendor\Products\Products as vendorproducts;
use App\Models\vendor\Products\ProductsDetails as vendorProductsDetails;
use App\Models\vendor\Products\productcollection as vendorproductcollection;; 

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
use App\Models\vendor\vendorcreate;
use App\Models\Offer\Offer;
use session;
use DB;
use Illuminate\Support\Facades\DB as FacadesDB;
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
        $category_main_data = CategoryMain::get();
        $gst = GST::get();
        $attribute = Attribute::get();
        $specification = Specification::get();
        $productcollection = productcollection::get();
        $offer = offer::get();
        $login_id = session()->get('login_id');
        //dd($login_id);
        return view('layout.staff.products.add-product')
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


    

     
    public function store(Request $request, FlasherInterface $flasher)
    {
       // return 'adminstore';
        // echo 'test';
         $products = new Products();
        // print_r($products);
        $login_id = session()->get('login_id');
        //dd($login_id);
        $statement = FacadesDB::select("SHOW TABLE STATUS LIKE 'products'");
        $next_product_id = $statement[0]->Auto_increment;
        // // dd($request->specification);

        $products = new Products();
        $filename = '';
        // if (isset($request->mainImage)) {
        //     $file = $request->mainImage;

        //     if ($file !== null) {
        //         $filename = ImageUploadHelper::storeImage($file, $this->main_image_path);
        //     }
        // }



        if($request->file('mainImage'))
        {   
            $category_image = $request->file('mainImage');
            
            $image = $next_product_id."_image.".$category_image->getClientOriginalExtension();
            
            $img = Image::make($category_image->getRealPath());
            
            $img->resize(500, 300, function ($constraint) {
                
                $constraint->aspectRatio();
                
            })->save($this->main_image_path.'/'.$image);
            
            
            
            $filename =  $image;
        }
        else
        {
            $filename ="";
        }



            $products->login_id   =  $login_id; 
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
            $products->specification= $request->specification;

            $products->offers = $request->offers;
            $products->collection = $request->collection;
            $products->flag = 0;
            $products->status = $request->status ?? 1;
			
			$products->logintype = "Staff";
            $products->created_by =$login_id;
            $products->save();
           


                  // Loop for product details
                  
                  $np = count($request->product_details_id);
          
           
            for ($key = 0; $key < $np; $key++) {
                $products_details = new ProductsDetails();                

                $arr=[];

                if (isset($request->mainimg[$key])) {

                   // $products_details_file = $request->nproducts[$key]; 
                   $products_details_filename  = '';
                   $products_details_filename1 = '';
                   $products_details_filename2 = '';
                   $products_details_filename3 = '';
                   
                    $products_details_file = $request->mainimg[$key];
                    $products_details_file1 = isset($request->subimg1[$key]) ? $request->subimg1[$key]: NULL;
                    $products_details_file2 = isset($request->subimg2[$key]) ? $request->subimg2[$key]: NULL;
                    $products_details_file3 = isset($request->subimg3[$key]) ? $request->subimg3[$key]: NULL;

                    if ($products_details_file !=null) {
                      $products_details_filename = $next_product_id.'.'.time().'.'.$products_details_file->getClientOriginalName();
                      //dd($products_details_filename);
                      //$products_details_file->move('assets/images/products/detail', $products_details_filename);       
                        $img = Image::make($products_details_file->getRealPath());
                
                        $img->resize(500, 300, function ($constraint) {
                            
                            $constraint->aspectRatio();
                            
                        })->save('assets/images/products/detail'.'/'.$products_details_filename);
                        
                        
                        
                        $filename =  $products_details_filename;

                      }  
                    
                    if ($products_details_file1 != null) {
                        $products_details_filename1 = $next_product_id.'.'.$products_details_file1->getClientOriginalName();
                       // $products_details_file1->move('assets/images/products/detail', $products_details_filename1);       
                       $img = Image::make($products_details_file1->getRealPath());
                
                       $img->resize(500, 300, function ($constraint) {

                           
                           $constraint->aspectRatio();
                           
                       })->save('assets/images/products/detail'.'/'.$products_details_filename1);
                       
                       
                       
                       $filename =  $products_details_filename1;
                      }
                      
                    if ($products_details_file2 != null) {
                        $products_details_filename2 = $next_product_id.'.'.$products_details_file2->getClientOriginalName();
                        // $products_details_file2->move('assets/images/products/detail', $products_details_file2);       
                        $img = Image::make($products_details_file2->getRealPath());
                
                        $img->resize(500, 300, function ($constraint) {
                            
                            $constraint->aspectRatio();
                            
                        })->save('assets/images/products/detail'.'/'.$products_details_filename2);
                        
                        
                        
                        $filename =  $products_details_filename2;
                      }

                    if ($products_details_file3 != null) {
                        $products_details_filename3 = $next_product_id.'.'.$products_details_file3->getClientOriginalName();
                       // $products_details_file3->move('assets/images/products/detail', $products_details_filename3);       
                       $products_details_filename3 = $next_product_id.'.'.$products_details_file2->getClientOriginalName();
                       // $products_details_file2->move('assets/images/products/detail', $products_details_file2);       
                       $img = Image::make($products_details_file3->getRealPath());
               
                       $img->resize(500, 300, function ($constraint) {
                           
                           $constraint->aspectRatio();
                           
                       })->save('assets/images/products/detail'.'/'.$products_details_filename3);
                       
                       
                       
                       $filename =  $products_details_filename3;
                      }

                    array_push($arr,$products_details_filename,$products_details_filename1,$products_details_filename2,$products_details_filename3);
                } 
            
            
                // dd($arr);
            
                $products_details->products_id = $next_product_id;
                $products_details->product_detail_image = json_encode($arr) ?? "-";
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
                //dd($key);
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
                        $productsAttri->created_by = $login_id;
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
    public function edit($id, $category_sub, FlasherInterface $flasher)
    {
        try{
        //return'adminedit';
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
        $specification = Specification::where('category_sub_id', $category_sub)->get();
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

            $productcollection = productcollection::get();

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

        return view('layout.staff.products.EditProduct')
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
                "productsAttri"=> $productsAttri,
                "productcollection" => $productcollection 
            ]);
    
        } catch(\Throwable $th) {
            $flasher->addError('Something Error!');
            return redirect()->route('products.crud.listing');
        }
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

        try{
        //
         $login_id = session()->get('login_id');
         $Products = Products::find($id);
         //dd($Products->product_id);
         //$input = $request->all();
         //print_r($input);exit;
         //$login_id = session()->get('login_id');
         // return ($Products);
         $filename = '';
    
            // if(isset($request->mainImage))
            // {
            //     $file = $request->mainImage;
            //     if ($file !== null) {
            //     $filename = ImageUploadHelper::storeImage($file, $this->main_image_path);
            //     }
            // }else{
            //     $filename = $request->oldmainImage;
            // }


            if($request->file('mainImage'))
            {   
                $category_image = $request->file('mainImage');
                
                $image = $Products->product_id."_image.".$category_image->getClientOriginalExtension();
                
                $img = Image::make($category_image->getRealPath());
                
                $img->resize(500, 300, function ($constraint) {
                    
                    $constraint->aspectRatio();
                    
                })->save($this->main_image_path.'/'.$image);
                
                
                
                $filename =  $image;
            }
            else
            {
                $filename =$request->oldmainImage;
            }


        $Products->login_id = $login_id ;
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
    
       
        $np = count($request->product_details_id);
       
        if($np > 0){

           //foreach ($request->nproducts as $key => $value) {
            for ($key = 0; $key < $np; $key++) {


               
               $details_id =$request->product_details_id[$key];
                // $products_details = new ProductsDetails();
            //if($details_id>0)
            // {
                if($details_id != null){
                    $products_details = ProductsDetails::find($details_id);
                    $pr_id = $login_id;
                
                    $prarr=[];

                    //if (isset($request->mainimg[$key])) {
    
                       // $products_details_file = $request->nproducts[$key]; 
                       $products_details_filename  = '';
                       $products_details_filename1 = '';
                       $products_details_filename2 = '';
                       $products_details_filename3 = '';
    
                        $products_details_file =  isset($request->mainimg[$key]) ? $request->mainimg[$key] :NULL;
                        $products_details_file1 = isset($request->subimg1[$key]) ? $request->subimg1[$key] :NULL;
                        $products_details_file2 = isset($request->subimg2[$key]) ? $request->subimg2[$key] :NULL;
                        $products_details_file3 = isset($request->subimg3[$key]) ? $request->subimg3[$key] :NULL;
                        
    
                        if ($products_details_file !=null) {
                          $products_details_filename = $details_id.'.'.time().'.'.$products_details_file->getClientOriginalName();

                          //   $products_details_file->move('assets/images/products/detail', $products_details_filename);       
                            
                            $img = Image::make($products_details_file->getRealPath());
                    
                            $img->resize(500, 300, function ($constraint) {
                                
                                $constraint->aspectRatio();
                                
                            })->save('assets/images/products/detail'.'/'.$products_details_filename);
                            
                            $filename =  $products_details_filename;


                          }else{
                            $products_details_filename = $request->old_mainimg[$key];
                          }  
                        
                        if ($products_details_file1 != null) {
                            $products_details_filename1 = $details_id.'.'.$products_details_file1->getClientOriginalName();
                            $img = Image::make($products_details_file1->getRealPath());
                    
                            $img->resize(500, 300, function ($constraint) {
                                
                                $constraint->aspectRatio();
                                
                            })->save('assets/images/products/detail'.'/'.$products_details_filename1);
                            
                            $filename =  $products_details_filename1;
                            // $products_details_file1->move('assets/images/products/detail', $products_details_filename1);       
                          }else{
                            $products_details_filename1 = $request->old_subimg1[$key];
                          } 
                          
                        if ($products_details_file2 != null) {
                            $products_details_filename2 = $details_id.'.'.$products_details_file2->getClientOriginalName();
                            $img = Image::make($products_details_file2->getRealPath());
                    
                            $img->resize(500, 300, function ($constraint) {
                                
                                $constraint->aspectRatio();
                                
                            })->save('assets/images/products/detail'.'/'.$products_details_filename2);
                            
                            $filename =  $products_details_filename2;

                            // $products_details_file2->move('assets/images/products/detail', $products_details_file2);       
                          }else{

                            $products_details_filename2 = $request->old_subimg2[$key];
                          } 
    
                        if ($products_details_file3 != null) {
                            $products_details_filename3 = $details_id.'.'.$products_details_file3->getClientOriginalName();
                            $img = Image::make($products_details_file3->getRealPath());
                    
                            $img->resize(500, 300, function ($constraint) {
                                
                                $constraint->aspectRatio();
                                
                            })->save('assets/images/products/detail'.'/'.$products_details_filename3);
                            
                            $filename =  $products_details_filename3;

                            // $products_details_file3->move('assets/images/products/detail', $products_details_filename3);       
                          }else{
                            $products_details_filename3 = $request->old_subimg3[$key];
                          } 
    
                        array_push($prarr,$products_details_filename,$products_details_filename1,$products_details_filename2,$products_details_filename3);
                   // } 
                  // dd($prarr);
                   $products_details->product_detail_image = json_encode($prarr) ?? "-";

                
                }else{
                    $products_details = new ProductsDetails();
                    $pr_id = $login_id;

                     $nprarr=[];
                // if (isset($request->mainimg[$key])) {
                   // $products_details_file = $request->nproducts[$key]; 
                   $newproducts_details_filename  = '';
                   $newproducts_details_filename1 = '';
                   $newproducts_details_filename2 = '';
                   $newproducts_details_filename3 = '';
                   
                    $products_details_file  = $request->mainimg[$key];
                    $products_details_file1 = isset($request->subimg1[$key]) ? $request->subimg1[$key]: NULL;
                    $products_details_file2 = isset($request->subimg2[$key]) ? $request->subimg2[$key]: NULL;
                    $products_details_file3 = isset($request->subimg3[$key]) ? $request->subimg3[$key]: NULL;
                    
                    if ($products_details_file !=null) {
                      $newproducts_details_filename = time().'.'.$products_details_file->getClientOriginalName().'.'.$pr_id;
                      $img = Image::make($products_details_file->getRealPath());
                    
                            $img->resize(500, 300, function ($constraint) {
                                
                                $constraint->aspectRatio();
                                
                            })->save('assets/images/products/detail'.'/'.$products_details_filename);
                            
                            $filename =  $products_details_filename;

                    //   $products_details_file->move('assets/images/products/detail', $newproducts_details_filename);       
                      }  
                    
                    if ($products_details_file1 != null) {
                        $newproducts_details_filename1 = $products_details_file1->getClientOriginalName().'.'.$pr_id;
                        $img = Image::make($products_details_file1->getRealPath());
                    
                            $img->resize(500, 300, function ($constraint) {
                                
                                $constraint->aspectRatio();
                                
                            })->save('assets/images/products/detail'.'/'.$products_details_filename1);
                            
                            $filename =  $products_details_filename1;
                        // $products_details_file1->move('assets/images/products/detail', $newproducts_details_filename1);       
                      }
                      
                    if ($products_details_file2 != null) {
                        $newproducts_details_filename2 = $products_details_file2->getClientOriginalName().'.'.$pr_id;
                        $img = Image::make($products_details_file2->getRealPath());
                    
                            $img->resize(500, 300, function ($constraint) {
                                
                                $constraint->aspectRatio();
                                
                            })->save('assets/images/products/detail'.'/'.$products_details_filename2);
                            
                            $filename =  $products_details_filename2;
                        // $products_details_file2->move('assets/images/products/detail', $products_details_file2);       
                      }

                    if ($products_details_file3 != null) {
                        $newproducts_details_filename3 = $products_details_file3->getClientOriginalName().'.'.$pr_id;
                        $img = Image::make($products_details_file3->getRealPath());
                    
                            $img->resize(500, 300, function ($constraint) {
                                
                                $constraint->aspectRatio();
                                
                            })->save('assets/images/products/detail'.'/'.$products_details_filename3);
                            
                            $filename =  $products_details_filename3;
                        // $products_details_file3->move('assets/images/products/detail', $newproducts_details_filename3);       
                      }

                    array_push($nprarr,$newproducts_details_filename,$newproducts_details_filename1,$newproducts_details_filename2,$newproducts_details_filename3);
                // } 
                $products_details->product_detail_image = json_encode($nprarr) ?? "-";
               //dd($products_details->product_detail_image);
                $products_details->products_id = $id;
             
                }
             
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
            // }
            }            
        }



        
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
                        //    $products_spec->update();
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

            $flasher->addSuccess('Product Updated successfully!');
            return redirect()->route('products.crud.listing');
           
        } catch(\Throwable $th) {
            $flasher->addError('Something Error!');
            return redirect()->route('products.crud.listing');
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
            return redirect()->route('products.crud.listing');
        } catch(Throwable $th) {
            $flasher->addError('Something Error!');
            return redirect()->route('products.crud.listing');
        }
		
    }



    public function v_p_destroy($id, FlasherInterface $flasher)
    {
        $Products = vendorProducts::find($id);
        $vendor_id = $Products->user_id;
		try {
            $image = vendorProducts::find($id);
           // print_r($image);exit();
            $file = $this->image_path1 . "/" . $image->product_image;
            
            if (file_exists($file)) unlink($file);

            vendorProducts::where("id", $id)->delete();

        // $productsdetails = new ProductsDetails();
        $productsdetails = vendorProductsDetails::where('products_id',$id)->get();
        $productsdetails_id = $productsdetails[0]['products_id'];
    //    print_r($productsdetails_id);exit();
        
        if($productsdetails_id){
            vendorProductsDetails::where("products_id", $productsdetails_id)->delete();
        }

        $productsspecs = ProductSpecs::where('products_id',$id)->get();
        // print_r($productsspecs);
        $productsspecs_id = $productsspecs[0]['products_id'];
       // print_r($productsspecs_id);exit();
        if($productsspecs_id){
            ProductSpecs::where("products_id", $id)->delete();
        }

            $flasher->addsuccess('Product Removed!');
            return redirect()->route('vendor_products.crud.listing', $vendor_id);
        } catch(Throwable $th) {
            $flasher->addError('Something Error!');
            return redirect()->route('vendor_products.crud.listing', $vendor_id);
        }
		
    }



    public function listing()
    {
        //return'rgdrf';
        $products_list = Products::where('logintype', "Admin")->get();
         $categorySub = CategorySub::get();
         $products_details = ProductsDetails::get();
        // $offer = offer::get();
        $offer = offer::get();

        $productDetailsCount = Products::select(FacadesDB::raw('COUNT(products.id) as product_details_cnt'))
            ->leftJoin('products_details', 'products.id', '=', 'products_details.products_id')
			->where('products.logintype', "Admin")
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



        return view("layout.staff.products.product-listing")->with(
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
       //return'rgdrf';
        $products_list = Products::where('logintype', "Vendor")->get();
         $categorySub = CategorySub::get();
         $products_details = ProductsDetails::get();
        // $offer = offer::get();
        $offer = offer::get();
		
        $productDetailsCount = Products::select(FacadesDB::raw('COUNT(products.id) as vendor_product_details_cnt'))
            ->leftJoin('products_details', 'products.id', '=', 'products_details.products_id')
			->where('products.logintype', "Vendor")
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



        return view("layout.staff.products.vendor_product-listing")->with(
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
     
        return view('layout.staff.products.ViewProduct')
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


          $productcollection  =  vendorproductcollection::get();


    //    'products.category as category','products.category-main as category-main','products.category-sub as category-sub','products.product_name as product_name','products.tax-id','products.gst_id','products.product_image','products.description','products.weight','products.lenght','products.width','products.height','products.offers','products.collection'
    //    print_r($product);
              		
    //    ->join('zonals', 'zonals.id', '=', 'routes.zonal_id')
    //           		->get(['pincode.id','routes.name as routename', 'zonals.name as zonalname','pincode.name', 'pincode.area','pincode.post_region']);

        return view('layout.staff.products.EditProduct')
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
}
