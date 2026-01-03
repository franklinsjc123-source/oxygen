<?php

namespace App\Http\Controllers\Website\Home;

use App\Http\Controllers\Controller;
use App\Models\Category\CategoryMain;
use App\Models\Category\Category;
use App\Models\Category\CategorySub;
use App\Models\Products\productcollection;
use App\Models\Products\Products;
use App\Models\Master\Offers\Offers;
use App\Models\User\Userreg;
use App\Models\User;
use App\Models\Banners\mainslider;
use App\Models\Banners\oxygen_adv;
use App\Models\Banners\paid_adv;
use App\Models\bidamount;
use Illuminate\Http\Request;
use App\Models\Products\ProductsDetails;
use App\Models\vendor\vendorcreate;
use App\Models\vendor\Category\CategoryMain as vendorcategorymain;
use DB;
use App\Models\vendor\Category\Category as vendorcategory;
use App\Models\vendor\Category\CategorySub as vendorcategorysub;


class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Products::where('flag', 1)->where('status', 1)->get();
        $products1 = Products::where('flag', 1)->where('status', 1)->take(6)->get();
        $userregdetails = Userreg::get();
        $categorymain = CategoryMain::where('status', 1)->limit(7)->get();
        $category = Category::where('status', 1)->get();
        $Categorysub = CategorySub::where('status', 1)->get();
		
        $mainslider = mainslider::where('status', 1)->get();
        $oxygen_adv = oxygen_adv::where('status', 1)->get();
        $paid_adv = paid_adv::where('status', 1)->get();
        $bidamount = bidamount::get();
        $offers = Offers::where('status', 1)->take(6)->get();
       // dd($mainslider);
      //  dd($products);
        return view('front_end.index')
            ->with([
                "products" => $products,
                "products1" => $products1,
                "categorymain" =>$categorymain,
                "category" =>$category,
                "categorysub" =>$Categorysub,
				"mainslider" =>$mainslider,
				"oxygen_adv" =>$oxygen_adv,
                "paid_adv" =>$paid_adv,
                "bidamount" =>$bidamount,
                "offers" =>$offers
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($category_id)
    {

        //$menui =  menu();
        
        $product = Products:: where('flag', 1)->where('status', 1)->where('category',$category_id)->get();
		//dd($product);
        $category = Category::where('id',$category_id)->where('statua', 1)->where('id',$category_id)->first();
        return view('website.front-end.pro_details')->with([
                    "product" => $product,
                    "category"=>$category_id
                ]);
    }
    
    
    /*All product details*/
    
    public function allproductshow()
    {

        $product = Products::where('id',$category_id)->where('statua', 1)->get();
// 		$category = Category::where('id',$category_id)->first();
        return view('website.front-end.allpro_details')->with([
                    "product" => $product,
                    // "category"=>$category_id
                ]);
    }
    
    
    /*End*/
    
	public function maincategoryshow($category_id)
    {

        //$menui =  menu();
        
        $product = Products::where('id',$category_id)->where('statua', 1)->where('category_main',$category_id)->get();
		//dd($product);
		
		$categorys = Category::where('main_category_id',$category_id)->get();
        $category1 = CategoryMain::where('id',$category_id)->where('status', 1)->get();
		$category = CategoryMain::where('id',$category_id)->where('status', 1)->first();
		if(count($category1)>0)
		{
        return view('website.front-end.viewmaincategory_products')->with([
                    "product" => $product,
                    "category"=>$category,
					"categorys"=>$categorys
                ]);
		}
		else
		{
		return view('website.front-end.404');
		}
    }
	public function categoryshow($category_id)
    {

        //$menui =  menu();
        
        $product = Products::where('category',$category_id)->where('flag', 1)->where('status', 1)->get();
		//dd($product);
		$categorys = CategorySub::where('category_id',$category_id)->where('status', 1)->get();
		//dd($categorys);
	    $category1 = Category::where('id',$category_id)->where('status', 1)->get();
        // $category = Category::where('id',$category_id)->first();
        
        $category = Category::join('category_main','category_main.id','=','category.main_category_id')
        ->select('category.*','category_main.category_main_name')
        ->where('category.id',$category_id)->first();
        
        $size_list = Products::join('products_details','products.product_id', '=', 'products_details.products_id')
        ->select('products_details.size')
        ->where('products.category', $category_id)
        ->get();
        $color_list = Products::join('products_details','products.product_id', '=', 'products_details.products_id')
        ->select('products_details.color')
        ->where('products.category', $category_id)
         ->where('products.status', 1)
        ->get();
       if(count($category1)>0)
		{
				return view('website.front-end.viewcategory_products')->with([
                    "product" => $product,
                    "category"=>$category,
					"categorys"=>$categorys,
					"size_list"=>$size_list,
					"color_list"=>$color_list,
                    "category_id"=>$category_id
                ]);
		}
		else
		{
		return view('website.front-end.404');
		}
    }
    public function subcategoryshow($category_id)
    {

        //$menui =  menu();
        
        // $product = Products::where('category_sub',$category_id)->get();
        $product =  DB::table('products as t1','users as t2','products_details as t3')->select('t1.id','t1.product_id', 't1.product_name', 't1.product_image','t1.created_by','t1.offers','t1.category_sub')
            ->selectSub(function ($query) {
                $query->select('name')
                    ->from('users as t2')
                  
                    ->whereColumn('t1.created_by', 't2.login_id')
                    ->limit(1);
            }, 'name')           
            ->selectSub(function ($query) {
                $query->select('t3.color')
                    ->from('products_details as t3')                  
                    ->whereColumn('t1.product_id', 't3.products_id')
                    ->limit(1);
            }, 'color')
			 ->selectSub(function ($query) {
                $query->select('selling_price')
                    ->from('products_details as t3')                  
                    ->whereColumn('t1.product_id', 't3.products_id')
                    ->limit(1);
            }, 'selling_price') 
            ->selectSub(function ($query) {
                $query->select('retail_price')
                    ->from('products_details as t3')                  
                    ->whereColumn('t1.product_id', 't3.products_id')
                    ->limit(1);
            }, 'retail_price') 
            ->selectSub(function ($query) {
                $query->select('type')
                    ->from('master_offers as t4')                  
                    ->whereColumn('t1.offers', 't4.id')
                    ->limit(1);
            }, 'type') 
        
            ->where('t1.category_sub', $category_id)
            ->where('t1.status', '1')
            
            //  ->orderBy("t3.selling_price", "asc")
            ->get(); 
        
        
// 		dd($product);
		 $category1 = CategorySub::where('id',$category_id)->get();
        $category = CategorySub::join('category','category.id','=','category_sub.category_id')
            ->join('category_main','category_main.id','=','category.main_category_id')
            ->select('category_sub.*','category_main.category_main_name','category.category_name')
            ->where('category_sub.id',$category_id)->first();
        
        $size_list = Products::join('products_details','products.product_id', '=', 'products_details.products_id')
        ->select('products_details.size')
        ->where('products.category', $category_id)
        ->get();
        
        $color_list = Products::join('products_details','products.product_id', '=', 'products_details.products_id')
        ->select('products_details.color')
        ->where('products.category', $category_id)
        ->get();
       if(count($category1)>0)
		{
				return view('website.front-end.viewsubcategory_products')->with([
                    "product" => $product,
                    "category"=>$category,
                    "size_list"=>$size_list,
					"color_list"=>$color_list,
                    "subcategory_id"=>$category_id,
                    "category1"=>$category1
                ]);
		}
		else
		{
		return view('website.front-end.404');
		}
    }
    public function categorymainshow($category_mainid)
    {
    // echo 'test';
        //$menui =  menu();
        
        $product = Products::where('category_main',$category_mainid)->get();
        
        return view('website.front-end.pro_details')->with([
                    "product" => $product,
                    "category"=>$category_mainid
                ]);
    }


    public function userloginshow($userlogin_id, $categorysub)
    {
      
        echo 'test';
        // $product = Products::where('category',$categorysub)->get();
        // $userloginid = $userlogin_id;
        // return view('website.front-end.product_details1')->with([
        //             "product" => $product,
        //             "userloginid" => $userloginid,
                    
        //         ]);

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
    public function destroy($id)
    {
        //
    }

    public function userlogin1($id)
    {
     //   echo 'test', $id;
     $userlogin_id = $id;
    //  dd($userlogin_id);

        $products = Products::get();
        $products1 = Products::take(6)->get();
        $userregdetails = Userreg::get();
        $categorymain = CategoryMain::where('status', 1)->limit(7)->get();
        $category = Category::get();
        $Categorysub = CategorySub::get();
        $mainslider = mainslider::get();
        $oxygen_adv = oxygen_adv::get();
        $paid_adv = paid_adv::get();
        $bidamount = bidamount::get();
        $offers = Offers::take(6)->get();
        //print_r($userregdetails);
        

        return view('website.front-end.index')
            ->with([
                "products" => $products,
                "products1" => $products1,
                "categorymain" =>$categorymain,
                "category" =>$category,
                "categorysub" =>$Categorysub,
                "userlogin_id" => $userlogin_id,
                "mainslider" =>$mainslider,
                "oxygen_adv" =>$oxygen_adv,
                "paid_adv" =>$paid_adv,
                "bidamount" =>$bidamount,
                "offers" =>$offers
            ]);
    } 
    public static function menu()
    {
        $products = Products::get();
        $userregdetails = Userreg::get();
        $categorymain = CategoryMain::get();
        $category = Category::get();
        $Categorysub = CategorySub::get();
        //print_r($userregdetails);
        
        // return redirect()->back()
        return view('website.front-end.pro_details')
        ->with([
                "products" => $products,
                "categorymain" =>$categorymain,
                "category" =>$category,
                "categorysub" =>$Categorysub
            ]);
    }
    
    /*vendor all product show*/
    public function vendorallproduct($productdetail_id)
    {
        
        $product = Products::where('id',$productdetail_id)->first();
        //  dd($product);
        $products = Products::join('products_details','products.product_id', '=', 'products_details.products_id')
        ->select('products.*','products_details.*')
        ->where('products.login_id',$product->login_id)
        ->get();

        $products1 = User::where('login_id',$product->login_id)->get();
        // dd($products1);
        $vendorcreate = vendorcreate::where('user_id',$products1[0]->login_id)->first();
        
       // dd($vendorcreate);
        // $products = Products::get();
       

        
        $userregdetails = Userreg::get();
        $categorymain = CategoryMain::get();
        $category = Category::get();
        $Categorysub = CategorySub::get();
		$categorymain = vendorcategorymain::where('created_byid',$product->created_by)->get();
        $mainslider = mainslider::get();
        $oxygen_adv = oxygen_adv::get();
        $paid_adv = paid_adv::get();
         $User = User::get();
        // $bidamount = bidamount::get();
       // dd($mainslider);

        return view('front_end.site.vendor_information')
            ->with([
                "products" => $products,
                "categorymain" =>$categorymain,
                "category" =>$category,
                "categorysub" =>$Categorysub,
				"mainslider" =>$mainslider,
				"oxygen_adv" =>$oxygen_adv,
                "paid_adv" =>$paid_adv,
                "user" =>$User,
                "vendorcreate" =>$vendorcreate
                // "bidamount" =>$bidamount
            ]);
           
     }
    /*end*/
    
    public function allvendors()
    {
        
         $vendorcreate = vendorcreate::get();
                   return view('website.front-end.allvendors')->with([
                    "vendorcreate" => $vendorcreate,
                    
                ]);
         
    }
    
      public function alloffers()
         {
         $offers = Offers::get();
                   return view('website.front-end.alloffers')->with([
                    "offers" => $offers,
                    
                     ]);
         
        }
    
    /*vendor main category*/
    	public function vendormaincategoryshow($category_id)
    {

        //$menui =  menu();
        $category1 = vendorcategorymain::where('id',$category_id)->get();
        
        
        $product = Products::where('created_by', $category1[0]->created_byid)
        ->where('logintype', 'vendor')
        ->get();
        
		
		$categorys = vendorcategory::where('main_category_id',$category_id) ->where('created_by', 'vendor')->where('created_byid', $product[0]->logintype)->get();
		
        $category1 = vendorcategorymain::where('id',$category_id)->where('created_by', 'vendor')->where('created_byid', $product[0]->created_by)->get();
	   
		$category = vendorCategoryMain::where('id',$category_id)->where('created_by', 'vendor')->where('created_byid', $product[0]->created_by)->first();
		
		if(count($category1)>0)
		{
        return view('website.front-end.viewmaincategory_products')->with([
                    "product" => $product,
                    "category"=>$category,
					"categorys"=>$categorys
                ]);
		}
		else
		{
		return view('website.front-end.404');
		}
    }
    /*end*/
    
    /*Filder Product*/
     public function filterproduct(Request $request)
     {
         
         $category_id = $request->cate1;
        //  dd($category_id);

      if (isset($request->sortcategory)) {
        $pricefilter = $request->sortcategory; // Assuming you're testing if it's set
    
        $product1 =  DB::table('products as t1', 'users as t2', 'products_details as t3')
            ->select('t1.id', 't1.product_id', 't1.product_name', 't1.product_image', 't1.created_by', 't1.offers', 't1.category_sub', 't1.offers')
            ->selectSub(function ($query) {
                $query->select('name')
                    ->from('users as t2')
                    ->whereColumn('t1.created_by', 't2.login_id')
                    ->limit(1);
            }, 'name')
            ->selectSub(function ($query) {
                $query->select('t3.color')
                    ->from('products_details as t3')
                    ->whereColumn('t1.product_id', 't3.products_id')
                    ->limit(1);
            }, 'color')
            ->selectSub(function ($query) {
                $query->select('selling_price')
                    ->from('products_details as t3')
                    ->whereColumn('t1.product_id', 't3.products_id')
                    ->limit(1);
            }, 'selling_price')
            ->selectSub(function ($query) {
                $query->select('retail_price')
                    ->from('products_details as t3')
                    ->whereColumn('t1.product_id', 't3.products_id')
                    ->limit(1);
            }, 'retail_price')
            ->selectSub(function ($query) {
                $query->select('type')
                    ->from('master_offers as t4')
                    ->whereColumn('t1.offers', 't4.id')
                    ->limit(1);
            }, 'type')
            ->where('t1.category', $category_id)
            ->where('t1.status', '1');
          //  ->orderBy('selling_price', 'DESC');
          //
        // Default sorting in ascending order
        
    
        if ($pricefilter === 'Low_to_High') {
            
            $product1->orderBy('selling_price', 'asc');
           // dd('1');
        } 
        elseif ($pricefilter === 'High_to_Low') {
            $product1->orderBy('selling_price', 'desc');
            //dd('2');
        }
        elseif ($pricefilter === 'offers') {
            $product1->whereNotNull('t1.offers');
           // dd('3');
        } 
        elseif ($pricefilter === 'currentdate') {
            // Filter for records where 'created_at' matches the current date
            $product1->orderBy('t1.product_id', 'DESC')->limit(1);
            //dd('4');
        }
        //dd('5');
        $product2 = $product1->get();
    //  dd($product2);
         return $product2;
        
    }
    else
       {
       
        $query = DB::table('products as t1')
        ->leftJoin('products_details as t2', 't1.product_id', '=', 't2.products_id')
        ->select('t1.id','t1.product_id','t1.product_image','t1.created_by','t1.product_name', DB::raw('MAX(t2.color) as color'), DB::raw('MAX(t2.size) as size'), DB::raw('MAX(t2.selling_price) as selling_price'), DB::raw('MAX(t2.retail_price) as retail_price'))
          ->groupBy('t1.product_id','t1.id','t1.product_image','t1.created_by','t1.product_name');
    
        if (!empty($request->cate)) {
            $cate_array1 = implode(', ', @$request->cate);
            $cate_array = array_unique(explode(', ', @$cate_array1));
            $query->whereIn('t1.category_sub', $cate_array);
        }
        
        if (!empty($request->color)) {
            $color_array1 = implode(', ', @$request->color);
            $color_array = array_unique(explode(', ', $color_array1));
            $query->whereIn('t2.color', $color_array);
        }
        
        if (!empty($request->size)) {
            $size_array1 = implode(', ', @$request->size);
            $size_array = array_unique(explode(', ', $size_array1));
            $query->whereIn('t2.size', $size_array);
        }
        
        if (!empty($request->pricemin)) {
            $pricemin = $request->pricemin;
            $query->where('t2.selling_price', '>=', $pricemin);
        }
        
        if (!empty($request->pricemax)) {
            $pricemax = $request->pricemax;
            $query->where('t2.selling_price', '<=', $pricemax);
        }
        
        if (!empty($request->disc)) {
            $disc_array1 = implode(', ', @$request->disc);
            $disc_array = array_unique(explode(', ', $disc_array1));
            $query->whereIn('t1.offers', $disc_array);
        }
        
        $product = $query->get();
       
       }
        
         $categorys = CategorySub::where('category_id',$category_id)->get();
        //dd($categorys);
        $category1 = Category::where('id',$category_id)->get();
        $category = Category::where('id',$category_id)->first();

        $size_list = Products::join('products_details','products.product_id', '=', 'products_details.products_id')
        ->select('products_details.*')
        ->where('products.category', $category_id)
        ->get();
        //dd($size_list);
        $color_list = Products::join('products_details','products.product_id', '=', 'products_details.products_id')
        ->select('products_details.*','products.*')
        ->where('products.category', $category_id)
        ->get();
        //   dd($color_list);
    
        if(count($category1)>0)
		{
				return view('website.front-end.viewcategory_products')->with([
                    "product" => $product,
                    "category"=>$category,
					"categorys"=>$categorys,
                    "size_list"=>$size_list,
					"color_list"=>$color_list,
                    "category_id"=>$category_id
                ]);
		}
		else
		{
		return view('website.front-end.404');
		}
         

    
    }
     /*End*/
     
     
      public function subfilterproducts(Request $request)
     {
        $category_id = $request->cate1;
       // dd($category_id);
        if (isset($request->sortcategory)) {
            $pricefilter = $request->sortcategory; // Assuming you're testing if it's set
        
            $product1 =  DB::table('products as t1', 'users as t2', 'products_details as t3')
                ->select('t1.id', 't1.product_id', 't1.product_name', 't1.product_image', 't1.created_by', 't1.offers', 't1.category_sub', 't1.offers')
                ->selectSub(function ($query) {
                    $query->select('name')
                        ->from('users as t2')
                        ->whereColumn('t1.created_by', 't2.login_id')
                        ->limit(1);
                }, 'name')
                ->selectSub(function ($query) {
                    $query->select('t3.color')
                        ->from('products_details as t3')
                        ->whereColumn('t1.product_id', 't3.products_id')
                        ->limit(1);
                }, 'color')
                ->selectSub(function ($query) {
                    $query->select('selling_price')
                        ->from('products_details as t3')
                        ->whereColumn('t1.product_id', 't3.products_id')
                        ->limit(1);
                }, 'selling_price')
                ->selectSub(function ($query) {
                    $query->select('retail_price')
                        ->from('products_details as t3')
                        ->whereColumn('t1.product_id', 't3.products_id')
                        ->limit(1);
                }, 'retail_price')
                ->selectSub(function ($query) {
                    $query->select('type')
                        ->from('master_offers as t4')
                        ->whereColumn('t1.offers', 't4.id')
                        ->limit(1);
                }, 'type')
                ->where('t1.category_sub', $category_id)
                ->where('t1.status', '1');
              //  ->orderBy('selling_price', 'DESC');
              //
            // Default sorting in ascending order
            
        
            if ($pricefilter === 'Low_to_High') {
                
                $product1->orderBy('selling_price', 'asc');
               // dd('1');
            } 
            elseif ($pricefilter === 'High_to_Low') {
                $product1->orderBy('selling_price', 'desc');
                //dd('2');
            }
             elseif ($pricefilter === 'offers') {
                $product1->whereNotNull('t1.offers');
               // dd('3');
            } 
            elseif ($pricefilter === 'currentdate') {
                // Filter for records where 'created_at' matches the current date
                $product1->orderBy('t1.product_id', 'DESC')->limit(1);
                //dd('4');
            }
            //dd('5');
            $product2 = $product1->get();
        
             return $product2;
            
        }
        
         else{


              $query = Products::join('products_details','products.product_id', '=', 'products_details.products_id')
        ->select('products_details.*','products.product_image', 'products.offers','products.product_id','products.category_sub','products.id');
       
        if(!empty($request->color))
        {
            $color_array1 = implode( ', ', @$request->color);
            $color_array = array_unique(explode( ', ', $color_array1));
            $query->whereIn('products_details.color', $color_array);
        }
        if(!empty($request->size))
        {  
            $size_array1 = implode( ', ',@$request->size);
            $size_array = array_unique(explode( ', ', $size_array1));
            $query->whereIn('products_details.size', $size_array);
        }
        if(!empty($request->pricemin))
        {
            $pricemin = $request->pricemin;
            $query->where('products_details.selling_price', '>=',$pricemin);
        }
        if(!empty($request->pricemax))
        {
            $pricemax = $request->pricemax;
            $query->where('products_details.selling_price', '<=',$pricemax);
        }

        if(!empty($request->disc))
        {
            
            $disc_array1 = implode( ', ',@$request->disc);
            $disc_array = array_unique(explode( ', ', $disc_array1));
            $query->whereIn('products.offers', $disc_array);
        }

        if (!empty($category_id)) {
            $query->where('category_sub', $category_id);
        }

        $product = $query->get();
         }
        
        // dd($product);

        // $product = Products::where('category_sub',$category_id)->get();

		$category1 = CategorySub::where('id',$category_id)->get();
        $category = CategorySub::where('id',$category_id)->first();
        $size_list = Products::join('products_details','products.product_id', '=', 'products_details.products_id')
        ->select('products_details.size')
        ->where('products.category', $category_id)
        ->get();
        $color_list = Products::join('products_details','products.product_id', '=', 'products_details.products_id')
        ->select('products_details.color')
        ->where('products.category', $category_id)
        ->get();
        //  dd($product);
       if(count($category1)>0)
		{
				return view('website.front-end.viewsubcategory_products')->with([
                    "product" => $product,
                    "category"=>$category,
                    "size_list"=>$size_list,
					"color_list"=>$color_list,
                    "subcategory_id"=>$category_id,
                    "category1"=>$category1
                ]);
		}
		else
		{
		return view('website.front-end.404');
		}
     }
     
     /*search product*/
     public function productsearchdetails(Request $request)
     {
        // dd($request->keywords);
         // $product_view = Ecom_Product::where("ecom_product_name", "LIKE", "%{$request->keywords}%")->get();
         $product = DB::table('products')
             ->leftjoin('category_main', 'products.category_main', '=', 'category_main.id')
             ->leftjoin('category', 'products.category', '=', 'category.id')
             ->leftjoin('category_sub', 'products.category_sub', '=', 'category_sub.id')
             ->leftjoin('products_details', 'products.id', '=', 'products_details.products_id')
             ->select('products.*','products_details.*')
             ->where('products.product_name', "LIKE", "%{$request->keywords}%")
             ->orWhere("products.category_main", "LIKE", "%{$request->keywords}%")
             ->orWhere("products.category", "LIKE", "%{$request->keywords}%")
             ->orWhere("products.category_sub", "LIKE", "%{$request->keywords}%")
             ->orWhere("products_details.size", "LIKE", "%{$request->keywords}%")
             ->get();
           
             $categorymain = CategoryMain::where('status', 1)->limit(7)->get();
             $category = Category::get();
             $Categorysub = CategorySub::get();
             $mainslider = mainslider::get();

         $keyword = $request->keywords;

         if(count($product)>0)
         {
                 return view('website.front-end.search_product')->with([
                     "products" => $product,
                     "keyword"=>$keyword,
                     "categorymain" =>$categorymain,
                     "category" =>$category,
                     "categorysub" =>$Categorysub,
                     "mainslider" =>$mainslider
 
                 ]);
         }
         else
         {
         return view('website.front-end.404');
         }
     }

     /*End*/
}