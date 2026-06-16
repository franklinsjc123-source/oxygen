<?php

namespace App\Http\Controllers\Website\Home;

use App\Http\Controllers\Controller;
use App\Models\Banners\mainslider;
use App\Models\Banners\oxygen_adv;
use App\Models\Banners\paid_adv;
use App\Models\bidamount;
use App\Models\Category\Category;
use App\Models\Category\CategoryMain;
use App\Models\Category\CategorySub;
use App\Models\coupon\coupon;
use App\Models\Master\Offers\Offers;
use App\Models\Products\productcollection;
use App\Models\Products\Products;
use App\Models\Products\ProductsDetails;
use App\Models\Products\ProductSpecs;
use App\Models\auction\auction;
use App\Models\PinCode\PinCode;
use App\Models\Master\Attribute\AttributeGroup;
use App\Models\Master\Colors\ProductColor;
use App\Models\User;
use App\Models\Vendor;

use App\Models\User\Userreg;
use App\Models\vendor\Category\Category as vendorcategory;
use App\Models\vendor\Category\CategoryMain as vendorcategorymain;
use App\Models\vendor\Category\CategorySub as vendorcategorysub;
use App\Models\vendor\vendorcreate;

use App\Models\CMSPage;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Darryldecode\Cart\Facades\CartFacade as Cart;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {

        /*if(@Session::get('pincode'))
        {
*/
        $mainslider = mainslider::where('status', 1)->get();

        $newArrivals = Products::with(['vendor', 'productdetails', 'offer'])
            ->where('flag', 1)->where('status', 1)
            ->latest('created_at')->take(10)->get();
        // dd( $newArrivals);


        $topCategories = CategoryMain::select('category_main.id', 'category_main.category_main_name', 'category_main.category_main_image', DB::raw('COUNT(products.id) as product_count'))
            ->leftJoin('products', 'category_main.id', '=', 'products.category_main')
            ->where('category_main.status', 1)
            ->groupBy('category_main.id', 'category_main.category_main_name', 'category_main.category_main_image') // Include the columns needed for grouping
            ->orderByDesc('product_count')
            ->limit(7)
            ->get();

        $oxygenAddBanner = oxygen_adv::where('status', 1)->get();
        $paidAddSlip = paid_adv::where('status', 1)->latest()->first();

        // $ourClients = User::select('users.id', 'users.name as vendor_name', DB::raw('COUNT(products.id) as product_count'))
        // ->leftJoin('products', 'users.login_id', '=', 'products.created_by')
        // ->groupBy('users.id', 'users.name')
        // ->orderByDesc('product_count')
        // ->get();

        $menproducts = Products::with(['CategoryMain', 'vendor', 'productdetails', 'offer'])
            ->where('products.flag', 1)
            ->where('products.status', 1)
            ->whereHas('categoryMain', function ($query) {
                $query->where('category_main_name', 'LIKE', 'men');
            })
            ->latest('products.created_at')->take(10)->get();

        $womenproducts = Products::with(['CategoryMain', 'vendor', 'productdetails', 'offer'])
            ->where('products.flag', 1)
            ->where('products.status', 1)
            ->whereHas('categoryMain', function ($query) {
                $query->where('category_main_name', 'LIKE', 'women');
            })
            ->latest('products.created_at')->take(10)->get();

        $kidsproducts = Products::with(['CategoryMain', 'vendor', 'productdetails', 'offer'])
            ->join('category_main', 'products.category_main', '=', 'category_main.id')
            ->where('products.flag', 1)
            ->where('products.status', 1)
            ->whereHas('categoryMain', function ($query) {
                $query->where('category_main_name', 'LIKE', 'kid');
            })
            ->latest('products.created_at')->take(10)->get();

        $coupon = coupon::where('status', 1)->latest()->first();
        // $categorymain = CategoryMain::where('status', 1)->limit(10)->get();
        // $userregdetails = Userreg::get();
        // $categorymain = CategoryMain::where('status', 1)->limit(7)->get();
        // $category = Category::where('status', 1)->get();
        // $Categorysub = CategorySub::where('status', 1)->get();        
        // $bidamount = bidamount::get();
        // $offers = Offers::where('status', 1)->take(6)->get();
        //  front_end.site.index
        return view('front_end.site.index')
            ->with([
                "mainslider" => $mainslider,
                "topCategories" => $topCategories,
                "newArrivals" => $newArrivals,
                "oxygenAddBanner" => $oxygenAddBanner,
                "menproducts" => $menproducts,
                "womenproducts" => $womenproducts,
                "kidsproducts" => $kidsproducts,
                "paidAddSlip" => $paidAddSlip ?? null,
                "coupon" => $coupon ?? null,
                // "categorymain" =>$categorymain,
                // "category" =>$category,
                // "categorysub" =>$Categorysub,               
                // "bidamount" =>$bidamount,
                // "offers" =>$offers
            ]);
        /*}
        else
        {
            return view('front_end.site.landing');
        }*/
    }
    public function checkPincode(Request $request)
    {
        $pincode = $request->input('pincode');

        // Check if pincode exists in the database
        if ($pincode) {
            // Assuming the table has a 'pincode' column
            $pincodeRecord = Pincode::where('name', $pincode)->first();

            // If pincode exists, create session with the pincode
            if ($pincodeRecord) {
                
                Session::put('pincode', $pincode);
                Session::put('pincode_area', $pincodeRecord->area );
                Session::put('post_region', $pincodeRecord->post_region );

                return response()->json(['status' => 'success', 'message' => 'Pincode is valid and delivery is available.']);
            } else {
                return response()->json(['status' => 'error', 'message' => 'Delivery not available for this area pincode.']);
            }
        }

        return response()->json(['status' => 'error', 'message' => 'No pincode provided.']);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getProducts($productdetail_id)
    {

        $getSpecificProduct =  ProductsDetails::with('product', 'product.CategoryChild')
            ->where('id', $productdetail_id)->first();
        $getProduct = Products::where('product_id', $getSpecificProduct->products_id)->first();
        $ProductSpecs = ProductSpecs::where('products_id', $getSpecificProduct->products_id)->get();

        $vendor_name = Vendor::where('id', $getProduct->vendor_id)->value('shop_name');

        // print_r($getProduct->vendor_id);exit;

        $vendor_details = "";
        if (isset($getProduct) && $getProduct->logintype == 'Vendor') {
            $vendor_details = vendorcreate::where('id', $getProduct->created_by)->first();
        }

        $getrelateProduct =  ProductsDetails::with('product')
            ->where('products_id', $getSpecificProduct->products_id)->get();

        $getRelateVendorProduct = Products::with('productdetails')
            ->where('login_id', $getSpecificProduct->product->login_id)
            ->get();

        $getSimilarProduct =  ProductsDetails::with('product', 'product.CategoryChild')
            ->where('products_id', $getSpecificProduct->products_id)->get();

        //dd($getSimilarProduct);
        return view('front_end.site.productPage')->with([
            "getSpecificProduct" => $getSpecificProduct,
            "getrelateProduct" => $getrelateProduct,
            "getSimilarProduct" => $getSimilarProduct,
            "getRelateVendorProduct" => $getRelateVendorProduct,
            "vendor_details" => $vendor_details,
            "ProductSpecs" => $ProductSpecs,
            "vendor_name" => $vendor_name,
        ]);
        //   $product_det = Products::join('products_details','products.id','=','products_details.products_id')->where('products_details.products_id', '=', $productdetail_id)->get();        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addItem(Request $request)
    {
        $product = Products::find($request->product_id);

        Cart::add([
            'id' => $product->id,
            'name' => $product->name,
            'qty' => $request->qty,
            'price' => $product->price,
        ]);

        return redirect()->route('cart.show')->with('success', 'Item added to cart successfully.');
    }

    public function showCart()
    {
        $cartItems = Cart::content();
        return view('cart', compact('cartItems'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($category_id)
    {
        $product = Products::with(['CategoryMain', 'vendor', 'productdetails', 'offer'])
            ->where('products.flag', 1)->where('products.status', 1)->where('products.category_main', $category_id)
            ->latest('products.created_at')->take(10)->get();

        $category = Category::where('id', $category_id)->where('status', 1)->where('id', $category_id)->first();
        //dd($category);
        return view('front_end.site.shopPage')->with([
            "product" => $product,
            "category" => $category_id
        ]);
    }
    public function pageinfo($id)
    {

        $pageinfo = CMSPage::where('page_name', $id)->where('status', '1')->first();
        //dd($pageinfo);
        return view('front_end.site.pageinfo')->with([
            "pageinfo" => $pageinfo
        ]);
    }

    /*All product details*/

    public function allproductshow($category_id)
    {

        $product = Products::where('id', $category_id)->where('statua', 1)->get();
        // 		$category = Category::where('id',$category_id)->first();
        return view('website.front-end.allpro_details')->with([
            "product" => $product,
            // "category"=>$category_id
        ]);
    }


    /*End*/

    public function maincategoryshow($category_id)
    {

        $products = Products::where('category_main', $category_id)->where('status', 1)->select('id', 'category_main', 'product_name', 'product_image', 'offers', 'collection')->take(20)->get();
        $maincategory = CategoryMain::where('id', $category_id)->where('status', 1)->select('id', 'category_main_name', 'category_main_image', 'category_main_keywords')->first();
        $category = Category::where('main_category_id', $category_id)->where('status', 1)->select('id', 'category_name', 'category_image', 'category_keywords')->orderBy('category_sortorder', 'ASC')->get();
        //dd($products);

        return view('front_end.site.mainshopPage')->with([
            "product" => $products,
            "categories" => $category,
            "maincategory" => $maincategory,

        ]);
    }
    public function categoryshow($category_id)
    {

        $products = Products::where('category', $category_id)->where('status', 1)->select('id', 'category', 'product_name', 'product_image', 'offers', 'collection')->take(20)->get();
        $category = Category::where('id', $category_id)->where('status', 1)->select('id', 'main_category_id', 'category_name', 'category_image', 'category_keywords')->first();
        $subcategory = CategorySub::where('category_id', $category_id)->where('status', 1)->select('id', 'category_sub_name', 'category_sub_image', 'category_sub_keywords')->orderBy('category_sub_sortorder', 'ASC')->get();
        //dd($category);
        $mainid = $category->main_category_id;
        $maincategory = CategoryMain::where('id', $mainid)->where('status', 1)->select('id', 'category_main_name', 'category_main_image', 'category_main_keywords')->first();

        return view('front_end.site.categoryshopPage')->with([
            "product" => $products,
            "categories" => $subcategory,
            "category" => $category,
            "maincategory" => $maincategory
        ]);
    }
    public function subcategoryshow($category_id)
    {
        

        $products = Products::where('category_sub', $category_id)->where('status', 1)->select('id', 'category_sub', 'product_name', 'product_image', 'offers', 'collection')->take(20)->get();

        $subcategory = CategorySub::where('id', $category_id)->where('status', 1)->select('id', 'category_sub_attributes', 'category_main_id', 'category_id', 'category_sub_name', 'category_sub_image', 'category_sub_keywords')->first();

        $mainid = $subcategory->category_main_id;
        $categoryid = $subcategory->category_id;
        $attributearray = explode(',', $subcategory->category_sub_attributes);

        $attributes = AttributeGroup::wherein('id', $attributearray)->get();
        $category = Category::where('id', $categoryid)->where('status', 1)->select('id', 'category_name', 'category_image', 'category_keywords')->first();
        $maincategory = CategoryMain::where('id', $mainid)->where('status', 1)->select('id', 'category_main_name', 'category_main_image', 'category_main_keywords')->first();
        $productbrand = ProductSpecs::where('category_sub_id', $category_id)->where('specify_attribute', 'Brand')->select('specify_value')->groupby('specify_value')->get();
        $productcolors = DB::table('products_details')
            ->leftJoin('products', 'products.id', '=', 'products_details.products_id')
            ->select(DB::raw('DISTINCT(products_details.attributevalue1) as color'))
            ->where('products.category_sub', $category_id)
            ->pluck('color');  

        $colors = $productcolors->toArray();  
        $maincolors = array("Black", "White", "Gray", "Silver", "Maroon", "Red", "Purple", "Fuchsia", "Green", "Lime", "Olive", "Yellow", "Navy", "Blue", "Teal");

        $mergedColors = array_unique(array_merge($maincolors, $colors));

        $mergedColors = array_values($mergedColors);

        //dd($mergedColors); 
        return view('front_end.site.subcategoryshopPage')->with([
            "product" => $products,
            "subcategory" => $subcategory,
            "category" => $category,
            "maincategory" => $maincategory,
            "productbrand" => $productbrand,
            "attributes" => $attributes,
            "colours" => $mergedColors,
        ]);
    }
    public function vendorsubcategoryshow($category_id, $vendor_id)
    {

        $products = Products::where('category_sub', $category_id)->where('created_by', $vendor_id)->where('logintype', 'Vendor')->where('status', 1)->select('id', 'category_sub', 'product_name', 'product_image', 'offers', 'collection')->get();

        $subcategory = CategorySub::where('id', $category_id)->where('status', 1)->select('id', 'category_sub_attributes', 'category_main_id', 'category_id', 'category_sub_name', 'category_sub_image', 'category_sub_keywords')->first();

        $mainid = $subcategory->category_main_id;
        $categoryid = $subcategory->category_id;
        $attributearray = explode(',', $subcategory->category_sub_attributes);

        $attributes = AttributeGroup::wherein('id', $attributearray)->get();
        $category = Category::where('id', $categoryid)->where('status', 1)->select('id', 'category_name', 'category_image', 'category_keywords')->first();
        $maincategory = CategoryMain::where('id', $mainid)->where('status', 1)->select('id', 'category_main_name', 'category_main_image', 'category_main_keywords')->first();
        $productbrand = ProductSpecs::where('category_sub_id', $category_id)->where('specify_attribute', 'Brand')->select('specify_value')->groupby('specify_value')->get();
        $productcolors = DB::table('products_details')
            ->leftJoin('products', 'products.id', '=', 'products_details.products_id')
            ->select(DB::raw('DISTINCT(products_details.attributevalue1) as color'))
            ->where('products.category_sub', $category_id)
            ->pluck('color');  // Use pluck to directly get an array of colors

        $colors = $productcolors->toArray();  // Convert to array if needed
        $maincolors = array("Black", "White", "Gray", "Silver", "Maroon", "Red", "Purple", "Fuchsia", "Green", "Lime", "Olive", "Yellow", "Navy", "Blue", "Teal");

        // Merge the arrays and remove duplicates
        $mergedColors = array_unique(array_merge($maincolors, $colors));

        // Optional: reindex the array if needed
        $mergedColors = array_values($mergedColors);

        //dd($mergedColors); 
        return view('front_end.site.vendorsubcategoryshopPage')->with([
            "product" => $products,
            "subcategory" => $subcategory,
            "category" => $category,
            "maincategory" => $maincategory,
            "productbrand" => $productbrand,
            "attributes" => $attributes,
            "colours" => $mergedColors,
            "vendor_id" => $vendor_id,

        ]);
    }
    public function categorymainshow($category_mainid)
    {
        // echo 'test';
        //$menui =  menu();

        $product = Products::where('category_main', $category_mainid)->get();

        return view('website.front-end.pro_details')->with([
            "product" => $product,
            "category" => $category_mainid
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
                "categorymain" => $categorymain,
                "category" => $category,
                "categorysub" => $Categorysub,
                "userlogin_id" => $userlogin_id,
                "mainslider" => $mainslider,
                "oxygen_adv" => $oxygen_adv,
                "paid_adv" => $paid_adv,
                "bidamount" => $bidamount,
                "offers" => $offers
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
                "categorymain" => $categorymain,
                "category" => $category,
                "categorysub" => $Categorysub
            ]);
    }

    /*vendor all product show*/
    public function Vendor_information($id)
    {


        //  dd($product);

        $products = DB::table('products')
            ->leftJoin('products_details', 'products.id', '=', 'products_details.products_id')
            ->leftJoin('category_sub', 'products.category_sub', '=', 'category_sub.id')
            ->select(
                DB::raw('MIN(products_details.id) as id'),  // Get the minimum (first) products_details.id
                'products_details.products_id',
                'category_sub.category_sub_name',
                'products.product_name',
                'products.product_image',
                'products_details.retail_price',
                'products_details.selling_price'
            )
            ->where('products.login_id', $id)

            ->where('products.status', 1)
            ->groupBy(
                'products_details.products_id', // Group by the product to avoid duplicate product rows
                'category_sub.category_sub_name',
                'products.product_name',
                'products.product_image',
                'products_details.retail_price',
                'products_details.selling_price'
            )->get();

        $vendorcreate = vendorcreate::where('user_id', $id)->first();
        if (!$vendorcreate) {
            $vendorcreate = vendorcreate::where('id', $id)->first();
        }

        if (!$vendorcreate) {
            return redirect('/')->with('error', 'Vendor details not found.');
        }

        $subid = array_filter(explode(',', (string) $vendorcreate->sub_category_ids));
        $Categorysub = count($subid) > 0 ? CategorySub::whereIn('id', $subid)->get() : collect();
        return view('front_end.site.vendor_information')
            ->with([
                "products" => $products,
                "Categorysub" => $Categorysub,
                "vendordetails" => $vendorcreate
                // "bidamount" =>$bidamount
            ]);
    }
   
    public function vendorallproduct($productdetail_id)
    {

        $product = Products::where('id', $productdetail_id)->first();
        //  dd($product);
        $products = Products::join('products_details', 'products.product_id', '=', 'products_details.products_id')
            ->select('products.*', 'products_details.*')
            ->where('products.login_id', $product->login_id)
            ->get();

        $products1 = User::where('login_id', $product->login_id)->get();
        // dd($products1);
        $vendorcreate = vendorcreate::where('user_id', $products1[0]->login_id)->first();

        // dd($vendorcreate);
        // $products = Products::get();



        $userregdetails = Userreg::get();
        $categorymain = CategoryMain::get();
        $category = Category::get();
        $Categorysub = CategorySub::get();
        $categorymain = vendorcategorymain::where('created_byid', $product->created_by)->get();
        $mainslider = mainslider::get();
        $oxygen_adv = oxygen_adv::get();
        $paid_adv = paid_adv::get();
        $User = User::get();
        // $bidamount = bidamount::get();
        // dd($mainslider);

        return view('website.front-end.vendorproduct')
            ->with([
                "products" => $products,
                "categorymain" => $categorymain,
                "category" => $category,
                "categorysub" => $Categorysub,
                "mainslider" => $mainslider,
                "oxygen_adv" => $oxygen_adv,
                "paid_adv" => $paid_adv,
                "user" => $User,
                "vendorcreate" => $vendorcreate
                // "bidamount" =>$bidamount
            ]);
    }

    public function vendorsList()
    {

        $vendorcreate = vendorcreate::get();
        return view('website.front-end.vendor-list')->with([
            "vendorcreate" => $vendorcreate,

        ]);
    }

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
        $category1 = vendorcategorymain::where('id', $category_id)->get();


        $product = Products::where('created_by', $category1[0]->created_byid)
            ->where('logintype', 'vendor')
            ->get();


        $categorys = vendorcategory::where('main_category_id', $category_id)->where('created_by', 'vendor')->where('created_byid', $product[0]->logintype)->get();

        $category1 = vendorcategorymain::where('id', $category_id)->where('created_by', 'vendor')->where('created_byid', $product[0]->created_by)->get();

        $category = vendorCategoryMain::where('id', $category_id)->where('created_by', 'vendor')->where('created_byid', $product[0]->created_by)->first();

        if (count($category1) > 0) {
            return view('website.front-end.viewmaincategory_products')->with([
                "product" => $product,
                "category" => $category,
                "categorys" => $categorys
            ]);
        } else {
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
            } elseif ($pricefilter === 'High_to_Low') {
                $product1->orderBy('selling_price', 'desc');
                //dd('2');
            } elseif ($pricefilter === 'offers') {
                $product1->whereNotNull('t1.offers');
                // dd('3');
            } elseif ($pricefilter === 'currentdate') {
                // Filter for records where 'created_at' matches the current date
                $product1->orderBy('t1.product_id', 'DESC')->limit(1);
                //dd('4');
            }
            //dd('5');
            $product2 = $product1->get();
            //  dd($product2);
            return $product2;
        } else {

            $query = DB::table('products as t1')
                ->leftJoin('products_details as t2', 't1.product_id', '=', 't2.products_id')
                ->select('t1.id', 't1.product_id', 't1.product_image', 't1.created_by', 't1.product_name', DB::raw('MAX(t2.color) as color'), DB::raw('MAX(t2.size) as size'), DB::raw('MAX(t2.selling_price) as selling_price'), DB::raw('MAX(t2.retail_price) as retail_price'))
                ->groupBy('t1.product_id', 't1.id', 't1.product_image', 't1.created_by', 't1.product_name');

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

        $categorys = CategorySub::where('category_id', $category_id)->get();
        //dd($categorys);
        $category1 = Category::where('id', $category_id)->get();
        $category = Category::where('id', $category_id)->first();

        $size_list = Products::join('products_details', 'products.product_id', '=', 'products_details.products_id')
            ->select('products_details.*')
            ->where('products.category', $category_id)
            ->get();
        //dd($size_list);
        $color_list = Products::join('products_details', 'products.product_id', '=', 'products_details.products_id')
            ->select('products_details.*', 'products.*')
            ->where('products.category', $category_id)
            ->get();
        //   dd($color_list);

        if (count($category1) > 0) {
            return view('website.front-end.viewcategory_products')->with([
                "product" => $product,
                "category" => $category,
                "categorys" => $categorys,
                "size_list" => $size_list,
                "color_list" => $color_list,
                "category_id" => $category_id
            ]);
        } else {
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
            } elseif ($pricefilter === 'High_to_Low') {
                $product1->orderBy('selling_price', 'desc');
                //dd('2');
            } elseif ($pricefilter === 'offers') {
                $product1->whereNotNull('t1.offers');
                // dd('3');
            } elseif ($pricefilter === 'currentdate') {
                // Filter for records where 'created_at' matches the current date
                $product1->orderBy('t1.product_id', 'DESC')->limit(1);
                //dd('4');
            }
            //dd('5');
            $product2 = $product1->get();

            return $product2;
        } else {


            $query = Products::join('products_details', 'products.product_id', '=', 'products_details.products_id')
                ->select('products_details.*', 'products.product_image', 'products.offers', 'products.product_id', 'products.category_sub', 'products.id');

            if (!empty($request->color)) {
                $color_array1 = implode(', ', @$request->color);
                $color_array = array_unique(explode(', ', $color_array1));
                $query->whereIn('products_details.color', $color_array);
            }
            if (!empty($request->size)) {
                $size_array1 = implode(', ', @$request->size);
                $size_array = array_unique(explode(', ', $size_array1));
                $query->whereIn('products_details.size', $size_array);
            }
            if (!empty($request->pricemin)) {
                $pricemin = $request->pricemin;
                $query->where('products_details.selling_price', '>=', $pricemin);
            }
            if (!empty($request->pricemax)) {
                $pricemax = $request->pricemax;
                $query->where('products_details.selling_price', '<=', $pricemax);
            }

            if (!empty($request->disc)) {

                $disc_array1 = implode(', ', @$request->disc);
                $disc_array = array_unique(explode(', ', $disc_array1));
                $query->whereIn('products.offers', $disc_array);
            }

            if (!empty($category_id)) {
                $query->where('category_sub', $category_id);
            }

            $product = $query->get();
        }

        // dd($product);

        // $product = Products::where('category_sub',$category_id)->get();

        $category1 = CategorySub::where('id', $category_id)->get();
        $category = CategorySub::where('id', $category_id)->first();
        $size_list = Products::join('products_details', 'products.product_id', '=', 'products_details.products_id')
            ->select('products_details.size')
            ->where('products.category', $category_id)
            ->get();
        $color_list = Products::join('products_details', 'products.product_id', '=', 'products_details.products_id')
            ->select('products_details.color')
            ->where('products.category', $category_id)
            ->get();
        //  dd($product);
        if (count($category1) > 0) {
            return view('website.front-end.viewsubcategory_products')->with([
                "product" => $product,
                "category" => $category,
                "size_list" => $size_list,
                "color_list" => $color_list,
                "subcategory_id" => $category_id,
                "category1" => $category1
            ]);
        } else {
            return view('website.front-end.404');
        }
    }

    /*search product*/
    public function productsearchdetails(Request $request)
    {
        $product = DB::table('products')
            ->leftjoin('category_main', 'products.category_main', '=', 'category_main.id')
            ->leftjoin('category', 'products.category', '=', 'category.id')
            ->leftjoin('category_sub', 'products.category_sub', '=', 'category_sub.id')
            ->leftjoin('products_details', 'products.id', '=', 'products_details.products_id')
            ->leftjoin('master_offers', 'products.offers', '=', 'master_offers.id')
            ->select(
                'products.id',
                'products.product_id',
                'products.product_name',
                'products.product_image',
                'products.created_by',
                'products.category_main',
                'products.category',
                'products.category_sub',
                'master_offers.offer_logo as offer_image',
                DB::raw('MIN(products_details.retail_price) as retail_price'),
                DB::raw('MIN(products_details.selling_price) as selling_price')
            )
            ->where('products.product_name', "LIKE", "%{$request->keywords}%")
            ->orWhere("products.category_main", "LIKE", "%{$request->keywords}%")
            ->orWhere("products.category", "LIKE", "%{$request->keywords}%")
            ->orWhere("products.category_sub", "LIKE", "%{$request->keywords}%")
            ->orWhere("products_details.size", "LIKE", "%{$request->keywords}%")
            ->groupBy(
                'products.id',
                'products.product_id',
                'products.product_name',
                'products.product_image',
                'products.created_by',
                'products.category_main',
                'products.category',
                'products.category_sub',
                'master_offers.offer_logo'
            )
            ->get();

        $categorymain = CategoryMain::where('status', 1)->limit(7)->get();
        $category = Category::get();
        $Categorysub = CategorySub::get();
        $mainslider = mainslider::get();

        $keyword = $request->keywords;

        if (count($product) > 0) {
            return view('website.front-end.search_product')->with([
                "products" => $product,
                "keyword" => $keyword,
                "categorymain" => $categorymain,
                "category" => $category,
                "categorysub" => $Categorysub,
                "mainslider" => $mainslider
            ]);
        } else {
            return view('website.front-end.404');
        }
    }

    public function productsearchdetails_new(Request $request)
    {
        $keyword = trim((string) ($request->input('keywords') ?? $request->input('search') ?? ''));

        if ($keyword === '') {
            return redirect()->back();
        }

        $rawTokens = preg_split('/\s+/', strtolower($keyword), -1, PREG_SPLIT_NO_EMPTY);
        $stopWords = ['for', 'with', 'and', 'the', 'a', 'an', 'of', 'to', 'in', 'on'];
        $tokens = array_values(array_filter($rawTokens, function ($token) use ($stopWords) {
            return !in_array($token, $stopWords, true) && strlen($token) > 1;
        }));
        if (empty($tokens)) {
            $tokens = [strtolower($keyword)];
        }

        $matchedColorNames = ProductColor::query()
            ->where(function ($query) use ($tokens, $keyword) {
                $query->where('color_name', 'LIKE', '%' . $keyword . '%');
                foreach ($tokens as $token) {
                    $query->orWhere('color_name', 'LIKE', '%' . $token . '%');
                }
            })
            ->pluck('color_name')
            ->map(function ($value) {
                return strtolower((string) $value);
            })
            ->unique()
            ->values()
            ->toArray();

        $product = DB::table('products')
            ->leftJoin('category_main as cm', 'products.category_main', '=', 'cm.id')
            ->leftJoin('category as c', 'products.category', '=', 'c.id')
            ->leftJoin('category_sub as cs', 'products.category_sub', '=', 'cs.id')
            ->leftJoin('products_details as pd', 'products.id', '=', 'pd.products_id')
            ->leftJoin('master_offers as o', 'products.offers', '=', 'o.id')
            ->select(
                'products.id',
                'products.product_id',
                'products.product_name',
                'products.product_image',
                'products.created_by',
                'products.category_main',
                'products.category',
                'products.category_sub',
                'products.vendor_id',
                'v.shop_name',
                'cm.category_main_name as main_category_name',
                'c.category_name as category_name',
                'cs.category_sub_name as sub_category_name',
                'o.offer_logo as offer_image',
                DB::raw('MIN(pd.retail_price) as retail_price'),
                DB::raw('MIN(pd.selling_price) as selling_price')
            )
            ->leftJoin('vendor_details as v', 'products.vendor_id', '=', 'v.id')
            ->groupBy(
                'products.id',
                'products.product_id',
                'products.product_name',
                'products.product_image',
                'products.created_by',
                'products.category_main',
                'products.category',
                'products.category_sub',
                'products.vendor_id',
                'v.shop_name',
                'cm.category_main_name',
                'c.category_name',
                'cs.category_sub_name',
                'o.offer_logo'
            )
            ->where('products.status', 1)
            ->where(function ($query) use ($keyword, $matchedColorNames) {
                $query->where('products.product_name', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('cm.category_main_name', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('c.category_name', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('cs.category_sub_name', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('pd.attributevalue1', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('pd.attributevalue2', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('pd.attributevalue3', 'LIKE', '%' . $keyword . '%')
                    ->orWhereExists(function ($brandQuery) use ($keyword) {
                        $brandQuery->select(DB::raw(1))
                            ->from('products_specs as ps')
                            ->whereColumn('ps.products_id', 'products.id')
                            ->whereRaw('LOWER(ps.specify_attribute) = ?', ['brand'])
                            ->where('ps.specify_value', 'LIKE', '%' . $keyword . '%');
                    });

                if (!empty($matchedColorNames)) {
                    $query->orWhereIn(DB::raw('LOWER(pd.attributevalue1)'), $matchedColorNames);
                }
            })
            ->when(!empty($tokens), function ($query) use ($tokens) {
                foreach ($tokens as $token) {
                    $query->where(function ($tokenQuery) use ($token) {
                        $tokenQuery->where('products.product_name', 'LIKE', '%' . $token . '%')
                            ->orWhere('cm.category_main_name', 'LIKE', '%' . $token . '%')
                            ->orWhere('c.category_name', 'LIKE', '%' . $token . '%')
                            ->orWhere('cs.category_sub_name', 'LIKE', '%' . $token . '%')
                            ->orWhere('pd.attributevalue1', 'LIKE', '%' . $token . '%')
                            ->orWhere('pd.attributevalue2', 'LIKE', '%' . $token . '%')
                            ->orWhere('pd.attributevalue3', 'LIKE', '%' . $token . '%')
                            ->orWhereExists(function ($brandTokenQuery) use ($token) {
                                $brandTokenQuery->select(DB::raw(1))
                                    ->from('products_specs as ps')
                                    ->whereColumn('ps.products_id', 'products.id')
                                    ->whereRaw('LOWER(ps.specify_attribute) = ?', ['brand'])
                                    ->where('ps.specify_value', 'LIKE', '%' . $token . '%');
                            });
                    });
                }
            })
            ->orderByRaw("CASE WHEN LOWER(products.product_name) LIKE ? THEN 0 ELSE 1 END", ['%' . strtolower($keyword) . '%'])
            ->orderBy('products.created_at', 'desc')
            ->limit(120)
            ->get();

        foreach ($product as $p) {
            $avg = Rating::where('products_id', $p->id)->avg('star_rating');
            $p->rating_percent = $avg ? ($avg / 5) * 100 : 0;
            $p->review_count = Rating::where('products_id', $p->id)->count();
        }

        return view('website.front-end.search_product_new')->with([
            "products" => $product,
            "keyword" => $keyword
        ]);
    }

    public function ajaxSearch(Request $request)
    {
        $term = trim((string) ($request->input('q') ?? $request->input('keywords') ?? $request->input('search') ?? ''));
        if (strlen($term) < 2) {
            return response()->json(['suggestions' => []]);
        }

        $suggestions = collect();

        $productSuggestions = DB::table('products')
            ->where('status', 1)
            ->where('product_name', 'LIKE', '%' . $term . '%')
            ->select('id', 'product_name as value', 'product_image')
            ->orderBy('created_at', 'desc')
            ->limit(6)
            ->get();

        foreach ($productSuggestions as $row) {
            $suggestions->push([
                'value' => $row->value,
                'type' => 'product',
                'image' => !empty($row->product_image) ? asset('assets/images/products/' . $row->product_image) : null,
                'url' => url('/productsearchdetails?keywords=' . urlencode($row->value)),
            ]);
        }

        $brandSuggestions = DB::table('products_specs')
            ->leftJoin('products as p', 'p.id', '=', 'products_specs.products_id')
            ->whereRaw('LOWER(specify_attribute) = ?', ['brand'])
            ->where('specify_value', 'LIKE', '%' . $term . '%')
            ->where('p.status', 1)
            ->select('specify_value as value', 'p.product_image')
            ->distinct()
            ->limit(4)
            ->get();

        foreach ($brandSuggestions as $row) {
            $suggestions->push([
                'value' => $row->value,
                'type' => 'brand',
                'image' => !empty($row->product_image) ? asset('assets/images/products/' . $row->product_image) : null,
                'url' => url('/productsearchdetails?keywords=' . urlencode($row->value)),
            ]);
        }

        $mainCategorySuggestions = DB::table('category_main')
            ->where('status', 1)
            ->where('category_main_name', 'LIKE', '%' . $term . '%')
            ->select('category_main_name as value', 'category_main_image')
            ->limit(3)
            ->get();

        foreach ($mainCategorySuggestions as $row) {
            $suggestions->push([
                'value' => $row->value,
                'type' => 'category',
                'image' => !empty($row->category_main_image) ? asset('assets/images/categoryMain/' . $row->category_main_image) : null,
                'url' => url('/productsearchdetails?keywords=' . urlencode($row->value)),
            ]);
        }

        $categorySuggestions = DB::table('category')
            ->where('status', 1)
            ->where('category_name', 'LIKE', '%' . $term . '%')
            ->select('category_name as value', 'category_image')
            ->limit(3)
            ->get();

        foreach ($categorySuggestions as $row) {
            $suggestions->push([
                'value' => $row->value,
                'type' => 'category',
                'image' => !empty($row->category_image) ? asset('assets/images/category/' . $row->category_image) : null,
                'url' => url('/productsearchdetails?keywords=' . urlencode($row->value)),
            ]);
        }

        $subCategorySuggestions = DB::table('category_sub')
            ->where('status', 1)
            ->where('category_sub_name', 'LIKE', '%' . $term . '%')
            ->select('category_sub_name as value', 'category_sub_image')
            ->limit(3)
            ->get();

        foreach ($subCategorySuggestions as $row) {
            $suggestions->push([
                'value' => $row->value,
                'type' => 'subcategory',
                'image' => !empty($row->category_sub_image) ? asset('assets/images/categorySub/' . $row->category_sub_image) : null,
                'url' => url('/productsearchdetails?keywords=' . urlencode($row->value)),
            ]);
        }

        $colorSuggestions = ProductColor::query()
            ->where('status', 1)
            ->where('color_name', 'LIKE', '%' . $term . '%')
            ->select('color_name as value')
            ->distinct()
            ->limit(3)
            ->get();

        foreach ($colorSuggestions as $row) {
            $suggestions->push([
                'value' => $row->value,
                'type' => 'color',
                'image' => null,
                'url' => url('/productsearchdetails?keywords=' . urlencode($row->value)),
            ]);
        }

        $suggestions = $suggestions
            ->unique(function ($item) {
                return strtolower((string) ($item['type'] ?? '')) . '|' . strtolower((string) ($item['value'] ?? ''));
            })
            ->take(12)
            ->values();

        return response()->json([
            'suggestions' => $suggestions,
        ]);
    }

    /*End*/
    public function auctionlist(Request $request)
    {
        $getauctionProduct = auction::with('productdetails')
            ->where('status', 1)
            ->where('end_date', '>=', now('Asia/Kolkata')->format('Y-m-d\TH:i'))
            ->get();
        //dd($getauctionProduct);
        return view('front_end.site.auction_products')->with([
            "getauctionProduct" => $getauctionProduct

        ]);
    }
    public function getmainfilterproduct(Request $request)
    {
        $category_id = $request->id;
        $minprice = $request->minprice;
        $maxprice = $request->maxprice;

        $orderby = $request->orderby;

        $products = DB::table('products')
            ->leftJoin('products_details', 'products.id', '=', 'products_details.products_id')
            ->leftJoin('category_main', 'products.category_main', '=', 'category_main.id')
            ->select(
                DB::raw('MIN(products_details.id) as id'),  // Get the minimum (first) products_details.id
                'products_details.products_id',
                'category_main.category_main_name',
                'products.product_name',
                'products.product_image',
                'products_details.retail_price',
                'products_details.selling_price'
            )
            ->where('products.category_main', $category_id);
        if (!is_null($minprice)) {
            $products->where('products_details.selling_price', '>=', $minprice);
        }
        if (!is_null($maxprice)) {
            $products->where('products_details.selling_price', '<=', $maxprice);
        }

        $products->where('products.status', 1)
            ->groupBy(
                'products_details.products_id', // Group by the product to avoid duplicate product rows
                'category_main.category_main_name',
                'products.product_name',
                'products.product_image',
                'products_details.retail_price',
                'products_details.selling_price'
            );

        // Add dynamic orderBy based on the 'orderby' parameter
        switch ($orderby) {
            case 'date':
                $products->orderBy('products.created_at', 'desc'); // Sort by latest
                break;
            case 'price-low':
                $products->orderBy('products_details.selling_price', 'asc'); // Sort by price: low to high
                break;
            case 'price-high':
                $products->orderBy('products_details.selling_price', 'desc'); // Sort by price: high to low
                break;
            default:
                // Optional: You can set a default ordering here (like 'product_name' or other field)
                break;
        }

        // Execute the query and limit to 20 results
        $products = $products->take(20)->get();

        return response()->json([
            'products' => $products

        ]);
    }
    public function getcatefilterproduct(Request $request)
    {
        $category_id = $request->id;
        $minprice = $request->minprice;
        $maxprice = $request->maxprice;

        $orderby = $request->orderby;

        $products = DB::table('products')
            ->leftJoin('products_details', 'products.id', '=', 'products_details.products_id')
            ->leftJoin('category', 'products.category', '=', 'category.id')
            ->select(
                DB::raw('MIN(products_details.id) as id'),  // Get the minimum (first) products_details.id
                'products_details.products_id',
                'category.category_name',
                'products.product_name',
                'products.product_image',
                'products_details.retail_price',
                'products_details.selling_price'
            )
            ->where('products.category', $category_id);
        if (!is_null($minprice)) {
            $products->where('products_details.selling_price', '>=', $minprice);
        }
        if (!is_null($maxprice)) {
            $products->where('products_details.selling_price', '<=', $maxprice);
        }

        $products->where('products.status', 1)
            ->groupBy(
                'products_details.products_id', // Group by the product to avoid duplicate product rows
                'category.category_name',
                'products.product_name',
                'products.product_image',
                'products_details.retail_price',
                'products_details.selling_price'
            );

        // Add dynamic orderBy based on the 'orderby' parameter
        switch ($orderby) {
            case 'date':
                $products->orderBy('products.created_at', 'desc'); // Sort by latest
                break;
            case 'price-low':
                $products->orderBy('products_details.selling_price', 'asc'); // Sort by price: low to high
                break;
            case 'price-high':
                $products->orderBy('products_details.selling_price', 'desc'); // Sort by price: high to low
                break;
            default:
                // Optional: You can set a default ordering here (like 'product_name' or other field)
                break;
        }

        // Execute the query and limit to 20 results
        $products = $products->take(20)->get();

        return response()->json([
            'products' => $products

        ]);
    }


    public function getsubfilterproduct(Request $request)
    {
        $category_id = $request->id;
        $minprice = $request->minprice;
        $maxprice = $request->maxprice;
        $orderby = $request->orderby;

        // Start building the query
        $products = DB::table('products_details')
            ->leftJoin('products', 'products.id', '=', 'products_details.products_id')
            ->leftJoin('category', 'products.category', '=', 'category.id')
            ->leftJoin('products_specs', 'products.id', '=', 'products_specs.products_id')
            ->select(
                DB::raw('MIN(products_details.id) as id'),  // Get the minimum (first) products_details.id
                'products_details.products_id',
                'category.category_name',
                'products.product_name',
                'products.product_image',
                DB::raw('MAX(products_details.retail_price) as retail_price'),  // Use MAX for aggregation
                DB::raw('MAX(products_details.selling_price) as selling_price') // Use MAX for aggregation
            )
            ->where('products.category_sub', $category_id);

        // Price filtering
        if (!is_null($minprice)) {
            $products->where('products_details.selling_price', '>=', $minprice);
        }
        if (!is_null($maxprice)) {
            $products->where('products_details.selling_price', '<=', $maxprice);
        }

        // Color filtering
        if (!empty($request->color)) {
            $products->whereIn('products_details.attributevalue1', $request->color);
        }

        // Size filtering
        if (!empty($request->size1)) {
            $products->whereIn('products_details.attributevalue2', $request->size1);
        }
        if (!empty($request->size2)) {
            $products->orWhereIn('products_details.attributevalue3', $request->size2);
        }

        // Brand filtering
        if (!empty($request->brand)) {
            $products->whereIn('products_specs.specify_value', $request->brand);
        }

        // Only fetch products that are active
        $products->where('products.status', 1)
            ->groupBy('products_details.products_id', 'category.category_name', 'products.product_name', 'products.product_image');

        // Add dynamic orderBy based on the 'orderby' parameter
        switch ($orderby) {
            case 'date':
                $products->orderBy('products.created_at', 'desc');
                break;
            case 'price-low':
                $products->orderBy('products_details.selling_price', 'asc');
                break;
            case 'price-high':
                $products->orderBy('products_details.selling_price', 'desc');
                break;
            default:
                break;
        }

        // Limit to 20 products
        $products = $products->take(20)->get();

        return response()->json([
            'products' => $products
        ]);
    }
    public function getvendorsubfilterproduct(Request $request)
    {
        $category_id = $request->id;
        $vendor_id = $request->vendorid;
        $minprice = $request->minprice;
        $maxprice = $request->maxprice;
        $orderby = $request->orderby;

        // Start building the query
        $products = DB::table('products_details')
            ->leftJoin('products', 'products.id', '=', 'products_details.products_id')
            ->leftJoin('category', 'products.category', '=', 'category.id')
            ->leftJoin('products_specs', 'products.id', '=', 'products_specs.products_id')
            ->select(
                DB::raw('MIN(products_details.id) as id'),  // Get the minimum (first) products_details.id
                'products_details.products_id',
                'category.category_name',
                'products.product_name',
                'products.product_image',
                DB::raw('MAX(products_details.retail_price) as retail_price'),  // Use MAX for aggregation
                DB::raw('MAX(products_details.selling_price) as selling_price') // Use MAX for aggregation
            )
            ->where('products.category_sub', $category_id)
            ->where('products.created_by', $vendor_id)
            ->where('products.logintype', 'Vendor');
        // Price filtering
        if (!is_null($minprice)) {
            $products->where('products_details.selling_price', '>=', $minprice);
        }
        if (!is_null($maxprice)) {
            $products->where('products_details.selling_price', '<=', $maxprice);
        }

        // Color filtering
        if (!empty($request->color)) {
            $products->whereIn('products_details.attributevalue1', $request->color);
        }

        // Size filtering
        if (!empty($request->size1)) {
            $products->whereIn('products_details.attributevalue2', $request->size1);
        }
        if (!empty($request->size2)) {
            $products->orWhereIn('products_details.attributevalue3', $request->size2);
        }

        // Brand filtering
        if (!empty($request->brand)) {
            $products->whereIn('products_specs.specify_value', $request->brand);
        }

        // Only fetch products that are active
        $products->where('products.status', 1)
            ->groupBy('products_details.products_id', 'category.category_name', 'products.product_name', 'products.product_image');

        // Add dynamic orderBy based on the 'orderby' parameter
        switch ($orderby) {
            case 'date':
                $products->orderBy('products.created_at', 'desc');
                break;
            case 'price-low':
                $products->orderBy('products_details.selling_price', 'asc');
                break;
            case 'price-high':
                $products->orderBy('products_details.selling_price', 'desc');
                break;
            default:
                break;
        }

        // Limit to 20 products
        $products = $products->take(20)->get();

        return response()->json([
            'products' => $products
        ]);
    }
}
