<?php

namespace App\Http\Controllers\NewCode;

use App\Http\Controllers\Controller;
use App\Models\Banners\mainslider;
use App\Models\Category\CategoryMain;
use App\Models\Category\Category;
use App\Models\Category\CategorySub;
use App\Models\Master\Colors\ProductColor;
use App\Models\Products\Products;
use App\Models\Products\ProductsDetails;
use App\Models\Products\ProductSpecs;
use App\Models\Vendor;
use App\Models\Offer\Offer;
use Illuminate\Support\Str;
use App\Models\vendor\vendorcreate;
use Darryldecode\Cart\Facades\CartFacade as Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\City;
use App\Models\Ecom_Customer_info;
use App\Models\Ecom_Customer_Shipping;
use App\Models\Order\Orders;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\PinCode\PinCode;
use App\Models\wishlist;

class FrontendController extends Controller
{


    public function customer_logout()
    {
        Session::forget('customer_id');
        return redirect('/demoEight');
    }


    public function vendorDokenGrid()
    {

        $vendorcreate = vendorcreate::get();
        // dd($vendorcreate);
        return view('frontend/vendor_doken_store_grid', compact('vendorcreate'));
    }


    public function myAccount()
    {

        $customer_id = Session::get('customer_id');
        if ($customer_id) {
            $customer = Ecom_Customer_info::where('customer_id', $customer_id)->first();
            $shipping_address = Ecom_Customer_Shipping::where('customer_id', $customer_id)->get();

            $wishlist = wishlist::select('ecom_wishlist.*', 'pr.product_name', 'pd.product_detail_image', 'pd.retail_price', 'pd.selling_price')
                ->leftJoin('products_details as pd', 'pd.id', '=', 'ecom_wishlist.ecom_product_id')
                ->leftJoin('products as pr', 'pd.products_id', '=', 'pr.product_id')
                ->where('ecom_wishlist.customer_id', '=', $customer_id)
                ->get();
            $wishCount = count($wishlist);


            return view('frontend/my_account', compact('customer', 'wishlist', 'wishCount', 'shipping_address'));
        } else {

            return redirect('/demoEight');
        }
    }



    public function changeCustomerPassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required',
            'confirm_password' => 'required',
        ]);

        $customer_id = Session::get('customer_id');

        $customer = Ecom_Customer_info::where('customer_id', $customer_id)->first();

        if (!$customer) {
            return redirect('/myAccount#account-details')->with('error', 'Customer not found.');
        }

        $dbPassword = base64_decode(base64_decode($customer->customer_password));

        if ($request->current_password !== $dbPassword) {
           return redirect('/myAccount#account-details')->with('error', 'Old password is incorrect.');
        }


        if ($request->new_password !== $request->confirm_password) {
           return redirect('/myAccount#account-details')->with('error', 'New password and confirm password not matched .');
        }

       Ecom_Customer_info::where('customer_id', $customer_id)->update(
            ['customer_password' => base64_encode(base64_encode($request->new_password))]
        );

        return redirect('/myAccount#account-details')->with('success', 'Password Updated Successfully.');
    }



    // public function changeCustomerPassword(Request $request)
    // {

    //     $customer_id = Session::get('customer_id');
    //     Ecom_Customer_info::where('customer_id', $customer_id)->update(
    //         ['customer_password' => base64_encode(base64_encode($request->new_password))]
    //     );
    //     session()->flash('success', 'Password Updated Successfully.');
    //     return redirect('/myAccount');
    // }



    public function saveShippingAddress(Request $request)
    {

        if ($request->address_id) {

            Ecom_Customer_Shipping::where('id', $request->address_id)
                ->update([
                    'customer_firstname' => $request->customer_firstname,
                    'customer_mobileno'  => $request->customer_mobileno,
                    'customer_email'     => $request->customer_email,
                    'customer_address'   => $request->customer_address,
                    'customer_state'     => $request->customer_state,
                    'customer_pincode'   => $request->customer_pincode,
                ]);

            return redirect()->back()->with('success', 'Address updated  successfully');
        } else {
            // ADD NEW
            Ecom_Customer_Shipping::create([
                'customer_id'        =>  Session::get('customer_id'),
                'customer_firstname' => $request->customer_firstname,
                'customer_mobileno'  => $request->customer_mobileno,
                'customer_email'     => $request->customer_email,
                'customer_address'   => $request->customer_address,
                'customer_state'     => $request->customer_state,
                'customer_pincode'   => $request->customer_pincode,
            ]);

            return redirect()->back()->with('success', 'Address saved successfully');
        }
    }

    public function deleteShippingAddress(Request $request)
    {
        Ecom_Customer_Shipping::where('id', $request->address_id)->delete();

        return response()->json(['success' => true]);
    }

    public function setDefaultShippingAddress(Request $request)
    {
        $customerId = Session::get('customer_id');

        Ecom_Customer_Shipping::where('customer_id', $customerId)
            ->update(['is_default' => 0]);

        Ecom_Customer_Shipping::where('id', $request->address_id)
            ->where('customer_id', $customerId)
            ->update(['is_default' => 1]);

        return response()->json(['success' => true]);
    }

    public function getProductImageList($id)
    {
        $imageList = ProductsDetails::from('products_details as pd')
            ->Where('products_id', $id)
            ->get(['product_detail_image']);
        $imageArr = $img = [];
        $images   = '';
        foreach ($imageList as $val) {
            $imageArr[] = json_decode($val->product_detail_image);
        }

        if (isset($imageArr) && count($imageArr) > 0) {
            foreach ($imageArr as $key => $val) {
                $img[] = isset($val[$key]) ? $val[$key] : '';
            }
        }
        return $img;
    }

    public function vendorDetails($id)
    {

        $products = DB::table('products')
            ->leftJoin('products_details', 'products.id', '=', 'products_details.products_id')
            ->leftJoin('category_sub', 'products.category_sub', '=', 'category_sub.id')
            ->select(
                'products.id',
                'products.product_name',
                'products.product_image',
                'category_sub.category_sub_name',
                DB::raw('MIN(products_details.retail_price) as retail_price'),
                DB::raw('MIN(products_details.selling_price) as selling_price')
            )
            ->where('products.vendor_id', $id)
            ->where('products.status', 1)
            ->groupBy(
                'products.id',
                'products.product_name',
                'products.product_image',
                'category_sub.category_sub_name'
            )
            ->get();

        $offerList = $this->getProductByVendorOffers($id, $offer_id = '');

        // print_r(  $prouctsList);exit;



        $topCollection = DB::table('products')
            ->leftJoin('products_details', 'products.id', '=', 'products_details.products_id')
            ->leftJoin('category_sub', 'products.category_sub', '=', 'category_sub.id')
            ->select(
                'products.id',
                'products.product_name',
                'products.product_image',
                'category_sub.category_sub_name',
                DB::raw('MIN(products_details.retail_price) as retail_price'),
                DB::raw('MIN(products_details.selling_price) as selling_price')
            )
            ->where('products.vendor_id', $id)
            ->where('products.status', 0)
            ->groupBy(
                'products.id',
                'products.product_name',
                'products.product_image',
                'category_sub.category_sub_name'
            )
            ->get();

        $vendorcreate = vendorcreate::where('user_id', $id)->first();
        $subid        = explode(',', $vendorcreate->sub_category_ids);

        $Categorysub = CategorySub::whereIn('id', $subid)->get();
        return view('frontend/vendor_doken_store')
            ->with([
                "products"          => $products,
                "topCollection"     => $topCollection,
                "newCollection"     => $products,
                "featuredProducts"  => $products,
                "offerList"         => $offerList,
                "Categorysub"       => $Categorysub,
                "vendordetails"     => $vendorcreate,
            ]);
    }

    public function vendorDokenStore()
    {
        return view('frontend/vendor_doken_store');
    }

    public function getSpecificProduct($id = '')
    {
        $productsData = Products::from('products as p')
            ->leftJoin('category as c', 'c.id', '=', 'p.category')
            ->leftJoin('category_sub as cs', 'cs.id', '=', 'p.category_sub')
            ->leftJoin('category_main as cm', 'cm.id', '=', 'p.category_main')
            ->leftJoin('products_details as pd', 'pd.products_id', '=', 'p.id')
            ->leftJoin('vendor_details as vp', 'vp.id', '=', 'p.vendor_id');
        if ($id != '') {
            $productsData = $productsData->where('p.id', $id);
        }
        $productsData = $productsData->select(
            'p.id',
            'p.vendor_id',
            'p.product_name',
            'p.product_image',
            'p.description',
            'p.specification',
            'pd.selling_price',
            'pd.retail_price',
            'c.category_name',
            'cs.category_sub_name',
            'cm.category_main_name',
            'vp.shop_name',
            'vp.profile_image',
            'pd.attributevalue2 as size',
            'pd.attributevalue1 as color',
            'pd.product_detail_image'
        )->get();
        $resultArr = [];
        foreach ($productsData as $val) {
            $productId = $val->id;
            if (! isset($resultArr[$productId])) {
                $resultArr[$productId] = [
                    'id'                 => $val->id,
                    'vendor_id'          => $val->vendor_id,
                    'product_name'       => $val->product_name,
                    'product_image'      => $val->product_image,
                    'description'        => $val->description,
                    'specification'      => $val->specification,
                    'selling_price'      => $val->selling_price,
                    'retail_price'       => $val->retail_price,
                    'category_name'      => $val->category_name,
                    'category_sub_name'  => $val->category_sub_name,
                    'category_main_name' => $val->category_main_name,
                    'shop_name'          => $val->shop_name,
                    'profile_image'      => $val->profile_image,
                ];
            }
        }

        return $resultArr;
    }






    public function getProduct($id = '')
    {

        $productsData = Products::from('products as p')
            ->leftJoin('category as c', 'c.id', '=', 'p.category')
            ->leftJoin('category_sub as cs', 'cs.id', '=', 'p.category_sub')
            ->leftJoin('category_main as cm', 'cm.id', '=', 'p.category_main')
            ->leftJoin('products_details as pd', 'pd.products_id', '=', 'p.id')
            ->leftJoin('vendor_details as vp', 'vp.id', '=', 'p.vendor_id');
        if ($id != '') {
            $productsData = $productsData->where('p.id', $id);
        }
        $productsData = $productsData->select(
            'p.id',
            'p.product_name',
            'p.description',
            'p.specification',
            'p.product_image',
            'pd.selling_price',
            'pd.retail_price',
            'c.category_name',
            'cs.category_sub_name',
            'cm.category_main_name',
            'vp.shop_name',
            'vp.profile_image',
            'pd.attributevalue2 as size',
            'pd.attributevalue1 as color',
            'pd.retail_price as retail_amount',
            'pd.selling_price as selling_amount',
            'pd.product_detail_image'
        )->get();
        $resultArr = [];
        foreach ($productsData as $val) {
            $productId = $val->id;

            if (! isset($resultArr[$productId])) {
                $resultArr[$productId] = [
                    'id'                 => $val->id,
                    'product_name'       => $val->product_name,
                    'description'        => $val->description,
                    'specification'      => $val->specification,
                    'product_image'      => $val->product_image,
                    'selling_price'      => $val->selling_price,
                    'category_name'      => $val->category_name,
                    'category_sub_name'  => $val->category_sub_name,
                    'category_main_name' => $val->category_main_name,
                    'shop_name'          => $val->shop_name,
                    'profile_image'      => $val->profile_image,
                    'retail_price'       => $val->retail_price,
                    'colors'             => [],
                    'size'               => [],
                    'images'             => [],
                    'retail_amount'      => [],
                    'selling_amount'     => [],
                    'images'             => [],
                ];
            }

            if (! in_array($val->color, $resultArr[$productId]['colors'])) {
                $color                             = ProductColor::Where('color_name', $val->color)->value('color_code');
                $resultArr[$productId]['colors'][] = isset($color) ? $color : '';
            }

            if (! in_array($val->retail_amount, $resultArr[$productId]['retail_amount'])) {
                $resultArr[$productId]['retail_amount'][] = $val->retail_amount;
            }

            if (! in_array($val->selling_amount, $resultArr[$productId]['selling_amount'])) {
                $resultArr[$productId]['selling_amount'][] = $val->selling_amount;
            }

            if (! in_array($val->size, $resultArr[$productId]['size'])) {
                $resultArr[$productId]['size'][] = $val->size;
            }

            if (! in_array($val->product_detail_image, $resultArr[$productId]['images'])) {
                $resultArr[$productId]['images'][] = $val->product_detail_image;
            }
        }
        if ($id != '') {
            return $resultArr[$id];
        } else {
            return $resultArr;
        }
    }

    public function demoEight()
    {








        // dd($pincode);

        $mainslider = mainslider::where('status', 1)->get();

        $topCategories = CategoryMain::select('category_main.id', 'category_main.category_main_name', 'category_main.category_main_image', DB::raw('COUNT(products.id) as product_count'))
            ->leftJoin('products', 'category_main.id', '=', 'products.category_main')
            ->where('category_main.status', 1)
            ->groupBy('category_main.id', 'category_main.category_main_name', 'category_main.category_main_image') // Include the columns needed for grouping
            ->orderByDesc('product_count')
            ->limit(12)
            ->get();

        $prouctsList = $this->getSpecificProduct('');

        $vendorcreate = vendorcreate::get();

        $pincode = session('pincode');

        if ($pincode) {
            $zonal_id = PinCode::where('name', $pincode)->value('zonal_id');

            $locations = PinCode::where('zonal_id', $zonal_id)
                ->select('area')
                ->get();
        } else {
            $locations = PinCode::select('area')
                ->inRandomOrder()
                ->limit(8)
                ->get();
        }


        return view('frontend/demo_eight', compact('mainslider', 'topCategories', 'prouctsList', 'vendorcreate', 'locations'));
    }

    public function productVar($id = '')
    {
        $prouctsList = $this->getProduct($id);
        $imageList   = $this->getProductImageList($id);
        $getSpecificProduct =  ProductsDetails::with('product', 'product.CategoryChild')
            ->where('id', $id)->first();
        $getProduct = Products::where('product_id', $getSpecificProduct->products_id)->first();

        $ProductSpecs = ProductSpecs::where('products_id', $getSpecificProduct->products_id)->get();

        $vendor_name = Vendor::where('id', $getProduct->vendor_id)->value('shop_name');

        // print_r($getProduct->vendor_id);exit;
        $vendor_details = vendorcreate::where('id', $getProduct->created_by)->first();
        return view('frontend/product', compact('id', 'vendor_details', 'prouctsList', 'imageList', 'getSpecificProduct', 'ProductSpecs'));
    }

    public function quickView($id)
    {
        $prouctsList = $this->getSpecificProduct($id);
        $imageList   = $this->getProductImageList($id);
        return view('frontend/quick_view', compact('id', 'prouctsList', 'imageList'));
    }

    public function customCart(Request $request)
    {
        $input = $request->all();
        $size  = $input['size'];
        $color = $input['color'];
        $id    = $input['id'];
        $qty   = $input['qty'];
        $prouctsList = $this->getSpecificProduct($id)[$id];
        $cartArray = array(
            'id'        => $prouctsList['id'],
            'name'      => $prouctsList['product_name'],
            'price'     => $prouctsList['selling_price'],
            'quantity'  => $qty,
            'attributes' => array(
                'image'     => isset($prouctsList['product_image']) ? $prouctsList['product_image'] : '',
                'size'      => $size,
                'color'      => $color,
            )
        );
        Cart::add($cartArray);
        $count = Cart::getContent()->count();
        return response()->json([
            'message' => 'Item added to cart successfully.',
            'count'   => $count,
            'cart' => Cart::getContent()
        ]);
    }



    public function getProductByCategory($category_id  = '', $sub_category_id = '')
    {
        $productsData = Products::from('products as p')
            ->leftJoin('category as c', 'c.id', '=', 'p.category')
            ->leftJoin('category_sub as cs', 'cs.id', '=', 'p.category_sub')
            ->leftJoin('category_main as cm', 'cm.id', '=', 'p.category_main')
            ->leftJoin('products_details as pd', 'pd.products_id', '=', 'p.id')
            ->leftJoin('vendor_details as vp', 'vp.id', '=', 'p.vendor_id');

        if ($category_id != '') {
            $productsData = $productsData->where('p.category', $category_id);
        }

        if ($sub_category_id != '') {
            $productsData = $productsData->where('p.category_sub', $sub_category_id);
        }

        $productsData = $productsData->select(
            'p.id',
            'p.vendor_id',
            'p.product_name',
            'p.product_image',
            'pd.selling_price',
            'pd.retail_price',
            'c.category_name',
            'cs.category_sub_name',
            'cm.category_main_name',
            'vp.shop_name',
            'vp.profile_image',
            'pd.attributevalue2 as size',
            'pd.attributevalue1 as color',
            'pd.product_detail_image'
        )->get();
        $resultArr = [];
        foreach ($productsData as $val) {
            $productId = $val->id;
            if (! isset($resultArr[$productId])) {
                $resultArr[$productId] = [
                    'id'                 => $val->id,
                    'vendor_id'          => $val->vendor_id,
                    'product_name'       => $val->product_name,
                    'product_image'      => $val->product_image,
                    'selling_price'      => $val->selling_price,
                    'retail_price'       => $val->retail_price,
                    'category_name'      => $val->category_name,
                    'category_sub_name'  => $val->category_sub_name,
                    'category_main_name' => $val->category_main_name,
                    'shop_name'          => $val->shop_name,
                    'profile_image'      => $val->profile_image,
                ];
            }
        }

        return $resultArr;
    }






    public function getProductByVendorOffers($vendor_id  = '', $offer_id = '')
    {
        $productsData = Products::from('products as p')
            ->leftJoin('category as c', 'c.id', '=', 'p.category')
            ->leftJoin('category_sub as cs', 'cs.id', '=', 'p.category_sub')
            ->leftJoin('category_main as cm', 'cm.id', '=', 'p.category_main')
            ->leftJoin('products_details as pd', 'pd.products_id', '=', 'p.id')
            ->leftJoin('vendor_details as vp', 'vp.id', '=', 'p.vendor_id');

        if ($vendor_id != '') {
            $productsData = $productsData->where('p.vendor_id', $vendor_id);
        }
        if ($offer_id != '') {
            $productsData = $productsData->where('p.offers', $offer_id);
        } else {
            $productsData = $productsData->whereNotNull('p.offers');
        }

        $productsData = $productsData->select(
            'p.id',
            'p.vendor_id',
            'p.product_name',
            'p.product_image',
            'pd.selling_price',
            'pd.retail_price',
            'c.category_name',
            'cs.category_sub_name',
            'cm.category_main_name',
            'vp.shop_name',
            'vp.profile_image',
            'pd.attributevalue2 as size',
            'pd.attributevalue1 as color',
            'pd.product_detail_image'
        )->get();
        $resultArr = [];
        foreach ($productsData as $val) {
            $productId = $val->id;
            if (! isset($resultArr[$productId])) {
                $resultArr[$productId] = [
                    'id'                 => $val->id,
                    'vendor_id'          => $val->vendor_id,
                    'product_name'       => $val->product_name,
                    'product_image'      => $val->product_image,
                    'selling_price'      => $val->selling_price,
                    'retail_price'       => $val->retail_price,
                    'category_name'      => $val->category_name,
                    'category_sub_name'  => $val->category_sub_name,
                    'category_main_name' => $val->category_main_name,
                    'shop_name'          => $val->shop_name,
                    'profile_image'      => $val->profile_image,
                ];
            }
        }

        return $resultArr;
    }





    public function getProductByMainCategory($main_category_id = '')
    {
        $productsData = Products::from('products as p')
            ->leftJoin('category as c', 'c.id', '=', 'p.category')
            ->leftJoin('category_sub as cs', 'cs.id', '=', 'p.category_sub')
            ->leftJoin('category_main as cm', 'cm.id', '=', 'p.category_main')
            ->leftJoin('products_details as pd', 'pd.products_id', '=', 'p.id')
            ->leftJoin('vendor_details as vp', 'vp.id', '=', 'p.vendor_id');

        if ($main_category_id != '') {
            $productsData = $productsData->where('p.category_main', $main_category_id);
        }

        $productsData = $productsData->select(
            'p.id',
            'p.category_main',
            'p.vendor_id',
            'p.product_name',
            'p.product_image',
            'pd.selling_price',
            'pd.retail_price',
            'c.category_name',
            'cs.category_sub_name',
            'cm.category_main_name',
            'vp.shop_name',
            'vp.profile_image',
            'pd.attributevalue2 as size',
            'pd.attributevalue1 as color',
            'pd.product_detail_image'
        )->get();


        $resultArr = [];
        foreach ($productsData as $val) {
            $productId = $val->id;
            if (! isset($resultArr[$productId])) {
                $resultArr[$productId] = [
                    'id'                 => $val->id,
                    'category_id'        => $val->category_main,
                    'vendor_id'          => $val->vendor_id,
                    'product_name'       => $val->product_name,
                    'product_image'      => $val->product_image,
                    'selling_price'      => $val->selling_price,
                    'retail_price'       => $val->retail_price,
                    'category_name'      => $val->category_name,
                    'category_sub_name'  => $val->category_sub_name,
                    'category_main_name' => $val->category_main_name,
                    'shop_name'          => $val->shop_name,
                    'profile_image'      => $val->profile_image,
                ];
            }
        }


        return $resultArr;
    }


    public function mainCategoryShop($main_category_id)
    {

        $prouctsList = $this->getProductByMainCategory($main_category_id);

        $categories = Category::where('main_category_id', $main_category_id)->get();

        $main_category = CategoryMain::where('id', $main_category_id)->first();


        $productcolors = DB::table('products_details')
            ->leftJoin('products', 'products.id', '=', 'products_details.products_id')
            ->select(DB::raw('DISTINCT(products_details.attributevalue1) as color'))
            ->where('products.category_sub', $main_category_id)
            ->pluck('color');

        $colors = $productcolors->toArray();

        $maincolors   = array("Black", "White", "Gray", "Silver", "Maroon", "Red", "Purple", "Fuchsia", "Green", "Lime", "Olive", "Yellow", "Navy", "Blue", "Teal");

        $mergedColors = array_unique(array_merge($maincolors, $colors));

        $colours = array_values($mergedColors);

        return view('frontend/main_category', compact('prouctsList', 'categories', 'colours', 'main_category'));
    }


    public function categoryShop($category_id, $sub_category_id = '')
    {

        $category = Category::where('id', $category_id)->first();
        $main_category = CategoryMain::where('id',  $category->main_category_id)->first();
        $sub_category = CategorySub::where('id',  $sub_category_id)->first();


        $product = Products::where('status', 1)
            ->where('category', $category_id);

        if ($sub_category_id > 0) {
            $product->where('category_sub', $sub_category_id);
        }
        $product->get();

        $sub_categories_menu = CategorySub::where('category_id', $category_id)->where('status', 1)->get();

        $prouctsList = $this->getProductByCategory($category_id, $sub_category_id);



        $productcolors = DB::table('products_details')
            ->leftJoin('products', 'products.id', '=', 'products_details.products_id')
            ->select(DB::raw('DISTINCT(products_details.attributevalue1) as color'))
            ->where('products.category', $category_id);

        if ($sub_category_id > 0) {
            $productcolors->where('products.category_sub', $sub_category_id);
        }

        $colors = $productcolors->pluck('color')->toArray();

        $maincolors   = array("Black", "White", "Gray", "Silver", "Maroon", "Red", "Purple", "Fuchsia", "Green", "Lime", "Olive", "Yellow", "Navy", "Blue", "Teal");

        $mergedColors = array_unique(array_merge($maincolors, $colors));

        $colours = array_values($mergedColors);

        return view('frontend/category', compact('product', 'sub_categories_menu', 'prouctsList', 'main_category', 'category', 'sub_category', 'colours'));
    }


    public function offers()
    {

        $offer_id  = isset($_GET['id']) ? $_GET['id'] : 0;
        if ($offer_id != '') {
            $offer_name = Offer::where('id', $offer_id)->value('title');
        } else {
            $offer_name = '';
        }

        $offer = Offer::get();

        $query = DB::table('vendor_details as vd')
            ->leftJoin('products as p', 'p.vendor_id', '=', 'vd.id')
            ->leftJoin('master_offers as o', 'o.id', '=', 'p.offers')
            ->select(
                'vd.*',
                DB::raw('GROUP_CONCAT(DISTINCT p.product_name) as products'),
                DB::raw('GROUP_CONCAT(DISTINCT o.title) as offers'),
                DB::raw('GROUP_CONCAT(DISTINCT o.id) as offer_ids')
            )
            ->groupBy('vd.id');

        if ($offer_id) {
            $query->where('o.id', $offer_id);
        } else {
            $query->whereNotNull('o.id');
        }

        $vendorcreate = $query->get();

        return view('frontend/offers', compact('offer', 'vendorcreate', 'offer_id', 'offer_name'));
    }



    public function offers_products($vendor_id)
    {
        $offer = Offer::get();

        $offer_id = isset($_GET['id']) ? $_GET['id'] : '';
        if ($offer_id != '') {
            $offer_name = Offer::where('id', $offer_id)->value('title');
        } else {
            $offer_name = '';
        }

        $prouctsList = $this->getProductByVendorOffers($vendor_id, $offer_id);

        return view('frontend/offers-products', compact('offer', 'prouctsList', 'offer_id', 'vendor_id', 'offer_name'));
    }




    // public function subCategoryShop($sub_category_id)
    // {

    //     $product = Products::where('status', 1)->where('category_sub', $sub_category_id)->get();
    //     $category_id = Category::where('id', $sub_category_id)->value('id');
    //     $sub_categories = CategorySub::where('category_id',$category_id)->where('status', 1)->get();


    //     return view('frontend/sub_category',compact('product','sub_categories'));

    // }




    public function getSideCart()
    {
        $count   = Cart::getContent()->count();
        $records = Cart::getContent();
        $total   = Cart::getTotal();
        return view('frontend.side_cart', compact('count', 'records', 'total'));
    }


    public function showCarts(Request $request)
    {

        $count   = Cart::getContent()->count();
        $records = Cart::getContent();
        $total   = Cart::getTotal();
        return view('frontend.view_cart', compact('count', 'records', 'total'));
    }


    public function checkoutPage(Request $request)
    {
        $count   = Cart::getContent()->count();
        $records = Cart::getContent();
        $total   = Cart::getTotal();
        return view('frontend.checkout', compact('count', 'records', 'total'));
    }

    public function checkout_store(Request $request)
    {
        $request->validate([
            'billing_first_name' => 'required',
            'billing_last_name'  => 'required',
            'billing_phone'      => 'required',
            'billing_email'      => 'required|email',
            'billing_address'    => 'required',
            'billing_city'       => 'required',
            'billing_state'      => 'required',
            'billing_country'    => 'required',
            'billing_postcode'   => 'required',
        ]);

        /* ===============================
        USER / CUSTOMER LOGIC
        =============================== */

        if (auth()->check()) {

            // Logged in user
            $userId = auth()->id();

        } else {

            // Check customer already exists by mobile or email
            $customer = Ecom_Customer_info::where('customer_mobileno', $request->billing_phone)
                ->orWhere('customer_email', $request->billing_email)
                ->first();

            if (!$customer) {

                $customerCode = 'OXY-C' . str_pad(Ecom_Customer_info::max('id') + 1, 5, '0', STR_PAD_LEFT);

                $customer = Ecom_Customer_info::create([
                    'customer_id'        => $customerCode,
                    'customer_firstname' => $request->billing_first_name,
                    'customer_lastname'  => $request->billing_last_name,
                    'customer_email'     => $request->billing_email,
                    'customer_mobileno'  => $request->billing_phone,
                    'customer_password'  => base64_encode('welcome@123'), // default password
                    'customer_address'   => $request->billing_address,
                    'customer_address1'  => $request->billing_address,
                    'customer_city'      => $request->billing_city,
                    'customer_state'     => $request->billing_state,
                    'customer_pincode'   => $request->billing_postcode,
                    'customer_type'      => 'Customer',
                ]);
            }

            // Use customer table ID or customer_id
            $userId = $customer->customer_id; // OR $customer->id
        }

        /* ===============================
        SHIPPING LOGIC
        =============================== */

        if ($request->has('ship_to_different')) {
            $shipping_address = $request->shipping_address;
            $shipping_city    = $request->shipping_city;
            $shipping_state   = $request->shipping_state;
            $shipping_country = $request->shipping_country;
            $shipping_postcode= $request->shipping_postcode;
        } else {
            $shipping_address = $request->billing_address;
            $shipping_city    = $request->billing_city;
            $shipping_state   = $request->billing_state;
            $shipping_country = $request->billing_country;
            $shipping_postcode= $request->billing_postcode;
        }

        /* ===============================
        ORDER INSERT
        =============================== */

        Orders::create([
            'User_id'        => $userId,
            'orders_id'      => 'ORD-' . strtoupper(Str::random(8)),

            'firstname'      => $request->billing_first_name,
            'lastname'       => $request->billing_last_name,
            'phone'          => $request->billing_phone,
            'email'          => $request->billing_email,

            'address'        => $shipping_address,
            'town'           => $shipping_city,
            'state'          => $shipping_state,
            'country'        => $shipping_country,
            'postelcode'     => $shipping_postcode,

            'value'          => 100,
            'shipping'       => $request->shipping_method ?? 'free',
            'total'          => 100,
            'grandtotal'     => 100,

            'order_status'   => 'Pending',
            'payment_status' => 'Pending',
            'order_notes'    => $request->order_notes,
            'order_date'     => now(),
            'status'         => 1,
        ]);

        return redirect()->back()->with('success', 'Order placed successfully!');
    }


    public function getFilterProducts(Request $request)
    {
        $main_category_id = $request->main_category_id;
        $category_id = $request->category_id;
        $sub_category_id = $request->sub_category_id;
        $minprice = $request->minprice;
        $maxprice = $request->maxprice;
        $orderby = $request->orderby;

        $productsQuery = Products::from('products as p')
            ->leftJoin('category as c', 'c.id', '=', 'p.category')
            ->leftJoin('category_sub as cs', 'cs.id', '=', 'p.category_sub')
            ->leftJoin('category_main as cm', 'cm.id', '=', 'p.category_main')
            ->leftJoin('products_details as pd', 'pd.products_id', '=', 'p.id')
            ->leftJoin('vendor_details as vp', 'vp.id', '=', 'p.vendor_id')
            ->where('p.status', 1);

        if (!empty($main_category_id)) {
            $productsQuery->where('p.category_main', $main_category_id);
        }

        if (!empty($category_id)) {
            $productsQuery->where('p.category', $category_id);
        }

        if (!empty($sub_category_id)) {
            $productsQuery->where('p.category_sub', $sub_category_id);
        }

        if (!empty($minprice)) {
            $productsQuery->where('pd.selling_price', '>=', $minprice);
        }

        if (!empty($maxprice)) {
            $productsQuery->where('pd.selling_price', '<=', $maxprice);
        }

        if (!empty($request->color)) {
            $productsQuery->whereIn('pd.attributevalue1', $request->color);
        }

        switch ($orderby) {
            case 'price-low':
                $productsQuery->orderBy('pd.selling_price', 'asc');
                break;
            case 'price-high':
                $productsQuery->orderBy('pd.selling_price', 'desc');
                break;
        }

        $products = $productsQuery->select(
            'p.id',
            'p.category_main',
            'p.vendor_id',
            'p.product_name',
            'p.product_image',
            'pd.selling_price',
            'pd.retail_price',
            'c.category_name',
            'cs.category_sub_name',
            'cm.category_main_name',
            'vp.shop_name',
            'vp.profile_image',
            'pd.attributevalue2 as size',
            'pd.attributevalue1 as color',
            'pd.product_detail_image'
        )->get();

        $resultArr = [];
        $discount_percentage = 0;
        foreach ($products as $val) {
            $productId = $val->id;


            if ($val->retail_price > 0) {
                $discount_percentage = round((($val->retail_price - $val->selling_price) / $val->retail_price) * 100);
            }
            if (!isset($resultArr[$productId])) {
                $resultArr[$productId] = [
                    'id'                 => $val->id,
                    'category_id'        => $val->category_main,
                    'vendor_id'          => $val->vendor_id,
                    'product_name'       => $val->product_name,
                    'product_image'      => $val->product_image,
                    'selling_price'      => $val->selling_price,
                    'retail_price'       => $val->retail_price,
                    'category_name'      => $val->category_name,
                    'category_sub_name'  => $val->category_sub_name,
                    'category_main_name' => $val->category_main_name,
                    'shop_name'          => $val->shop_name,
                    'profile_image'      => $val->profile_image,
                    'size'               => $val->size,
                    'color'              => $val->color,
                    'product_detail_image' => $val->product_detail_image,
                    'discount'           => $discount_percentage,
                ];
            }
        }

        return response()->json(['products' => array_values($resultArr)]);
    }



    public function myWishlist(Request $request)
    {
        $customer_id = Session::get('customer_id');

        $wishlist = wishlist::select('ecom_wishlist.*', 'pr.product_name', 'pd.product_detail_image', 'pd.retail_price', 'pd.selling_price')
            ->leftJoin('products_details as pd', 'pd.id', '=', 'ecom_wishlist.ecom_product_id')
            ->leftJoin('products as pr', 'pd.products_id', '=', 'pr.product_id')
            ->where('ecom_wishlist.customer_id', '=', $customer_id)
            ->get();
        $wishCount = count($wishlist);
        return view('frontend.wishlist', compact('wishlist', 'wishCount'));
    }



    public function addWishlist(Request $request)
    {
        $customer_id = Session::get('customer_id');
        $id = $request->product_id;
        $ip = $request->ip();

        $wishlist = wishlist::where('customer_id', $customer_id)->where('ecom_product_id', $id)->get();

        $wishCount = count($wishlist);

        $products = ProductsDetails::where('id', $id)->first();

        $productview = Products::where('id', '=', $products->products_id)->first();


        if ($wishCount == 0) {

            $wishlist = new wishlist;

            $wishlist->ecom_wishlist_ipaddress =  $ip;
            $wishlist->ecom_product_id = $id;
            $wishlist->customer_id =  $customer_id;
            $wishlist->ecom_product_name = $productview->product_name;
            $wishlist->save();
        }

        $wishlist = wishlist::where('customer_id', $customer_id)->get();
        $wishCount = count($wishlist);
        return response()->json(['msg' => 'Success', 'wishcount' => $wishCount], 200);
    }
}
