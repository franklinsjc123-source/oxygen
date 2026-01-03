<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Category\CategoryMain;
use App\Models\Category\Category;
use App\Models\Category\CategorySub;
use App\Models\Products\productcollection;
use App\Models\Products\Products;
use App\Models\User\Userreg;
use Illuminate\Http\Request;
use App\Models\Products\ProductsDetails;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Products::get();
      
        $userregdetails = Userreg::get();
        $categorymain = CategoryMain::get();
        $category = Category::get();
        $Categorysub = CategorySub::get();
        //print_r($userregdetails);
            
        return view('website.front-end.index')
            ->with([
                "products" => $products,
                "categorymain" =>$categorymain,
                "category" =>$category,
                "categorysub" =>$Categorysub
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
        
        $product = Products::where('category',$category_id)->get();
        
        return view('website.front-end.pro_details')->with([
                    "product" => $product,
                    "category"=>$category_id
                    ]);
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
        $userregdetails = Userreg::get();
        $categorymain = CategoryMain::get();
        $category = Category::get();
        $Categorysub = CategorySub::get();
        //print_r($userregdetails);

        return view('website.front-end.index')
            ->with([
                "products" => $products,
                "categorymain" =>$categorymain,
                "category" =>$category,
                "categorysub" =>$Categorysub,
                "userlogin_id" => $userlogin_id
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
}