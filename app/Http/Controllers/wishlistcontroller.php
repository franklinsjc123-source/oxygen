<?php
	
	namespace App\Http\Controllers;
	
	use Illuminate\Http\Request;
	
	use App\Models\Products\Products;
	use App\Models\Products\ProductsDetails;
	use App\Models\wishlist;
	
	//use Request;
	
	class wishlistcontroller  extends Controller
	{
		/**
			* Display a listing of the resource.
			*
			* @return \Illuminate\Http\Response
			
		*/
		
		public function index()
		{
			
		}
		
	public function store(Request $request)
		{
			$id=$request->product_id;
			$ip = $request->ip();

		
			$wishlist=wishlist::where ('ecom_wishlist_ipaddress' ,$ip)->where('ecom_product_id',$id)->get();
			$wishCount = count($wishlist);



			$products = ProductsDetails::where('id', $id)->first();

			$productview = Products::where('id', '=', $products->products_id)->first();


			// print_r($productview );exit;
			
			
			if($wishCount==0)
			{
				
				$wishlist=new wishlist;
				
				$wishlist->ecom_wishlist_ipaddress =  $ip;
				
				
				$wishlist->ecom_product_id = $id;
				$wishlist->ecom_product_name = $productview->product_name;
				$wishlist->save();
			}
			
			$wishlist=wishlist::where ('ecom_wishlist_ipaddress' ,$ip)->get();
			$wishCount = count($wishlist);
            return response()->json(['msg' => 'Success','wishcount' => $wishCount], 200 );
			
		}
		
		
		public function show(Request $request)
		{
			$ip = $request->ip();
			
			
			//$wishlist=wishlist :: where ('ecom_wishlist_ipaddress' ,$ip)->get();
			$wishlist = wishlist::select('ecom_wishlist.*','pr.product_name','pd.product_detail_image','pd.retail_price','pd.selling_price')
			->leftJoin('products_details as pd', 'pd.id', '=', 'ecom_wishlist.ecom_product_id')
			->leftJoin('products as pr', 'pd.products_id', '=', 'pr.product_id')
            ->where('ecom_wishlist.ecom_wishlist_ipaddress', '=', $ip)
            ->get();
			$wishCount = count($wishlist);
			return view('front_end.site.wishlist',compact('wishlist','wishCount'));
			
		}
		
		public function destroy($id)
		{
			
			 wishlist :: where('ecom_wishlist_id', $id)->delete();
			 return redirect('/myWishlist');
		
		}
		
	}
