<?php

namespace App\Http\Controllers\NewCode;

use App\Http\Controllers\Controller;
use Darryldecode\Cart\Facades\CartFacade as Cart;


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
use App\Models\User;
use App\Models\Vendor;

use App\Models\User\Userreg;
use App\Models\vendor\Category\Category as vendorcategory;
use App\Models\vendor\Category\CategoryMain as vendorcategorymain;
use App\Models\vendor\Category\CategorySub as vendorcategorysub;
use App\Models\vendor\vendorcreate;

use App\Models\CMSPage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{

    public function getProduct($id = '', $name = '')

    {
       
        $products = DB::table('products as p')
            ->leftJoin('category as c', 'c.id', '=', 'p.category')
            ->leftJoin('products_details as i', 'i.products_id', '=', 'p.id');
            //->leftJoin('size as s', 's.id', '=', 'p.size_id');
        if ($id > 0 && $id != '') {
            $products = $products->Where('p.id', $id);
        }
        if (urldecode($name) != '' && !empty(urldecode($name))) {
            $products = $products->where('p.product_name', 'like', '%' . urldecode($name) . '%');
        }

        $products = $products->select(['p.*','i.selling_price as price', 'i.product_detail_image as image_path', 'c.category_name'])
            ->get();
        
        
        $recordsArr = $imageArr = $mergedImages = [];
        foreach ($products as $key => $val) {
            $productId = $val->product_id;
            if (!isset($recordsArr[$productId])) {
                $recordsArr[$productId] = get_object_vars($val);
                $recordsArr[$productId]['images'] = [];
            }
            $images = json_decode($val->image_path);
            $imageArr = array_merge($imageArr,$images);           
            $recordsArr[$productId]['images'][] = $imageArr;
        }

        foreach ($recordsArr as $imgArray) {
            $mergedImages =  array_merge($mergedImages, $imgArray);
        }
        $recordsArr['images'] = $mergedImages;       
        return $recordsArr; 
    }




     public function customCart(Request $request)
    {
        $input  =  $request->all();
        $size   = $input['size'];
        $color   = $input['color'];
        $id     = $input['id'];
        $qty    = $input['qty'];

        $records = $this->getProduct($id, '');
        $row = $records[$id];
        $image = isset($row['image_path']) ? json_decode($row['image_path']) : '';
        $cartArray = array(
            'id'        => $row['id'],
            'name'      => $row['product_name'],
            'price'     => $row['price'],
            'quantity'  => $qty,
            'attributes' => array(
                'image'     => isset($image[0]) ? $image[0]:'',
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

    public function getSideCart()
    {
        $count   = Cart::getContent()->count();
        $records = Cart::getContent();
        $total   = Cart::getTotal();           
        return view('front_end.site.side_cart', compact('count', 'records', 'total'));
    }

     public function removeCart($id)
    {
        Cart::remove($id);
        return response()->json([
            'message' => 'Item removed successfully.',
            'removed'   => 1,
        ]);
    }

    public function showCarts(Request $request)
    {

         $count   = Cart::getContent()->count();
        $records = Cart::getContent();
        $total   = Cart::getTotal();
         return view('front_end.site.view_cart',compact('count','records','total'));
    }

    public function clearCart()
    {
        Cart::clear();
        return redirect('home');
    }

     public function updateQty(Request $request)
    {
        $input  = $request->all();
        $id     = $input['id'];
        $qty    = $input['qty'];
        $type   = $input['type'];

        $item = Cart::get($id);
        if (!$item) {
            return response()->json(['message' => 'Item not found'], 404);
        }
        $currentQty = $item->quantity;

        if ($type === 'Add') {
            $newQty = $currentQty + 1;
        } elseif ($type === 'Minus') {
            $newQty = max(1, $currentQty - 1);
        } else {
            return response()->json(['message' => 'Invalid update type'], 400);
        }
        Cart::update($id, ['quantity' => [
            'relative' => false,
            'value' => $newQty
        ]]);
        return response()->json([
            'message' => 'Qty Updated successfully.',
        ]);
    }

    public function getItemCart()
    {
         $count   = Cart::getContent()->count();
        $records = Cart::getContent();
        $total   = Cart::getTotal();
         return view('front_end.site.show_cart',compact('count','records','total'));
    }



    public function getProducts($productdetail_id)
    {
        
       $getSpecificProduct =  ProductsDetails::with('product', 'product.CategoryChild')
        ->where('id', $productdetail_id)->first();
        $getProduct = Products::where('product_id',$getSpecificProduct->products_id)->first();
        $ProductSpecs = ProductSpecs::where('products_id',$getSpecificProduct->products_id)->get();

        $vendor_name = Vendor::where('id',$getProduct->vendor_id)->value('shop_name');
        
        // print_r($getProduct->vendor_id);exit;

        $vendor_details="";
        if(isset($getProduct)&& $getProduct->logintype=='Vendor')
        {
        $vendor_details=vendorcreate::where('id',$getProduct->created_by)->first();
        }
       
        $getrelateProduct =  ProductsDetails::with('product')
        ->where('products_id', $getSpecificProduct->products_id)->get();

        $getRelateVendorProduct = Products::with('productdetails')
        ->where('login_id',$getSpecificProduct->product->login_id)
        ->get();

        $getSimilarProduct =  ProductsDetails::with('product', 'product.CategoryChild')
        ->where('products_id', $getSpecificProduct->products_id)->get();
       
       //dd($getSimilarProduct);
       return view('front_end.site.productPage')->with([
                        "getSpecificProduct" =>$getSpecificProduct,
                        "getrelateProduct" => $getrelateProduct,
                        "getSimilarProduct" => $getSimilarProduct,
                        "getRelateVendorProduct" => $getRelateVendorProduct,
                        "vendor_details"=>$vendor_details,
                        "ProductSpecs"=>$ProductSpecs,
                        "vendor_name"=>$vendor_name,
                    ]);
        //   $product_det = Products::join('products_details','products.id','=','products_details.products_id')->where('products_details.products_id', '=', $productdetail_id)->get();        
    }


}
