<?php

namespace App\Http\Controllers\ProductsController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Products\productcollection;
use App\Helper\ImageUploadHelper\ImageUploadHelper;
use Flasher\Prime\FlasherInterface;

class CollectionController extends Controller
{
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
            $collection->name = $request->name;
            $collection->image = $filename;
            $collection->status = $request->status;
            $collection->created_by = auth()->user()->id;
            $collection->save();

          //  dd($collection);

            $flasher->addSuccess('Data has been saved successfully!');
            return redirect()->route('productcollection.master.index');
        } catch (\Throwable $th) {
            $flasher->addError('Something Error!!');
            return redirect()->route('productcollection.master.index');
        }
    }
    public function index()
    {
        $productcollection = productcollection::all();

        return view('layout.admin.products.product-collection')->with("productcollection", $productcollection);

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
    public function destroy($id, FlasherInterface $flasher)
    
    {
        try {
            productcollection::where("id", $id)->delete();
            $flasher->addsuccess('Product Collection Removed!');
            return redirect()->route('productcollection.master.index');
        } catch (\Throwable $th) {
            $flasher->addError('Something Error!!');
            return redirect()->route('productcollection.master.index');
        }
    }

    public function lists()
    {
       ;
    }

    public function collection()
    {
        
    }
    public function attribute()
    {
        
    }
    public function specification()
    {
        
    }
}