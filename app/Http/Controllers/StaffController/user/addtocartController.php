<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Products\ProductsDetails;
use App\Models\Products\Products;
use Illuminate\Http\Request;

class addtocartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
        {
            //  echo $productdetail_id;
            //  exit();

    //     // $product_det = ProductsDetails::find($productdetail_id);
    //     $product_det = ProductsDetails::join('products','products.product_id','=','products_details.products_id')->where('products_details.id', '=', $productdetail_id)->get();
    //     //dd($product_det);
    //    return view('website.front-end.product_view')->with([
    //     "product_det" =>$product_det
    //        ]);
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

    public function datashow($productdetail_id)
    {
        // $product_det = ProductsDetails::join('products','products.product_id','=','products_details.products_id')->where('products_details.id', '=', $productdetail_id)->get();
        $product_det = Products::join('products_details','products.product_id','=','products_details.products_id')->where('products_details.id', '=', $productdetail_id)->get();
        //  dd($product_det[0]->category);
        $product = Products::where('category',$product_det[0]->category)->get();
        // dd($productdetails);
        // $product = ProductsDetails::where('products_id',$productdetails[0]->product_id)->get();
       // dd($product);
       return view('website.front-end.product_view')->with([
        "product_det" =>$product_det,
        "product" =>$product
           ]);
    }
}
