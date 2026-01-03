<?php

namespace App\Http\Controllers\vendor\ProductsController;

use App\Helper\ImageUploadHelper\ImageUploadHelper;
use App\Http\Controllers\Controller;
use App\Models\Category\CategoryMain;
use App\Models\Products\Products;
use Flasher\Prime\FlasherInterface;
use Illuminate\Http\Request;
use App\Models\vendor\Products\productcollection;
use App\Models\Category\CategorySub;
use App\Models\Master\Attribute\Attribute;
use App\Models\Master\GST\GST;
use App\Models\Master\Specification\Specification;
use App\Models\Products\ProductsDetails;
use App\Models\Products\ProductsSpecs;
use DB;
use Illuminate\Support\Facades\DB as FacadesDB;

class ProductCollectionController extends Controller
{

    private $main_image_path = "assets/images/products";
    private $detail_image_path = "assets/images/products/detail";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, FlasherInterface $flasher)
    {

       
        $collection = new productcollection();
        $IMAGE_PATH = "assets/images/productcollection";
        $file = $request->image;
        $filename = ImageUploadHelper::storeImage($file, $IMAGE_PATH);

        try {
            
            $login_id = session()->get('login_id');
            //$collection->id = auth()->user()->id;
            $collection->vendor_id  = $login_id;
			$collection->name = $request->name;
            $collection->image = $filename;
            $collection->status = $request->status;
            //$collection->created_at = auth()->user()->id;
            $collection->save();

            //dd($collection);

            $flasher->addSuccess('Data has been saved successfully!');
            return redirect()->route('vendorproductcollection.master.index');
        } catch(\Throwable $th) {
            $flasher->addError('Something Error!!');
            //dd($collection);
			//print_r($collection);
			return redirect()->route('vendorproductcollection.master.index');
        }
    }
    public function index()
    {
        $login_id = session()->get('login_id');
        
        $productcollection = productcollection::where('vendor_id', $login_id)->get();

        return view('layout.vendor.products.product-collection')->with("productcollection", $productcollection);

       // return view('layout.admin.products.product-collection');
      //  return view('layout.admin.products.product-collection');
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
	 /**
    public function store(Request $request, FlasherInterface $flasher)
    {

        $statement = FacadesDB::select("SHOW TABLE STATUS LIKE 'products'");
        $next_product_id = $statement[0]->Auto_increment;
        // dd($request->specification);

        $products = new Products();
        $filename = '';
        if (isset($request->main_img)) {
            $file = $request->main_img;

            if ($file !== null) {
                $filename = ImageUploadHelper::storeImage($file, $this->main_image_path);
            }
        }

        try {
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


            // Loop for product details
            $np = count($request->nproducts);
            for ($key = 0; $key < $np; $key++) {
                $products_details = new ProductsDetails();
                $products_details_filename = '';
                if (isset($request->product_detail_image[$key])) {
                    $products_details_file = $request->product_detail_image[$key];

                    if ($products_details_file !== null) {
                        $products_details_filename = ImageUploadHelper::storeImage($products_details_file, $this->detail_image_path);
                    }
                }

                $products_details->products_id = $next_product_id;
                $products_details->product_detail_image = $products_details_filename ?? "-";
                $products_details->attributevalue1 = isset($request->attributeDetails1[$key]) ? $request->attributeDetails1[$key] : '';
                $products_details->attributename1 = isset($request->attributename1[$key]) ? $request->attributename1[$key] : '';
                $products_details->attributevalue2 = isset($request->attributeDetails2[$key]) ? $request->attributeDetails2[$key] : '';
                $products_details->attributename2 = isset($request->attributename2[$key]) ? $request->attributename2[$key] : '';
                $products_details->attributevalue3 = isset($request->attributeDetails3[$key]) ? $request->attributeDetails3[$key] : '';
                $products_details->attributename3 = isset($request->attributename3[$key]) ? $request->attributename3[$key] : '';
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

            // Loop for Spec details
            foreach ($request->specify_attribute as $key => $value) {
                $products_spec = new ProductsSpecs();

                $products_spec->products_id = $next_product_id;
                $products_spec->specify_attribute = $request->specify_attribute[$key];
                $products_spec->specify_value = $request->specify_value[$key];
                $products_spec->save();
            }

            $flasher->addSuccess('New Product Added successfully!');
            return redirect()->route('products.crud.listing');
        } catch (\Throwable $th) {

            $flasher->addError('Something Error!!');
            return redirect()->route('products.crud.index');
        }
    }
    */ 
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

        $productInfo = Products::find($id);
        $category_main_data = CategoryMain::get();
        $gst = GST::get();
        $attribute = Attribute::get();
        $specification = Specification::get();

        return view('layout.admin.products.EditProduct')
            ->with([
                "category_main_data" => $category_main_data,
                "gst" => $gst,
                "attribute" => $attribute,
                "specification" => $specification
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
            productcollection::where("id", $id)->delete();
            $flasher->addsuccess('Product Collection Removed!');
            return redirect()->route('vendorproductcollection.master.index');
        } catch (\Throwable $th) {
            $flasher->addError('Something Error!!');
            return redirect()->route('vendorproductcollection.master.index');
        }
    }

    public function listing()
    {
        $products_list = Products::get();

        $productDetailsCount = Products::select(FacadesDB::raw('COUNT(products.id) as product_details_cnt'))
            ->leftJoin('products_details', 'products.id', '=', 'products_details.products_id')
            ->groupBy('products.id')
            ->get();

        $products_list_arr = array();

        foreach ($products_list as $key => $value) {
            $a = json_decode($products_list[$key]);
            $b = json_decode($productDetailsCount[$key]);
            $arr = (object)array_merge((array)$a, (array)$b);
            array_push($products_list_arr, $arr);
        }

        return view("layout.vendor.products.product-listing")->with("products_list", $products_list_arr);
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
}
