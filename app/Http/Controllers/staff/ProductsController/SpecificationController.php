<?php

namespace App\Http\Controllers\staff\ProductsController;

use App\Http\Controllers\Controller;
use App\Models\Category\CategorySub;
use App\Models\Master\Specification\Specification;
use Flasher\Prime\FlasherInterface;
use Illuminate\Http\Request;
use Nette\Utils\Arrays;


class SpecificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $subcategory = CategorySub::get();

        $specification = CategorySub::join(
            'master_specification',
            'category_sub.id',
            '=',
            'master_specification.category_sub_id'
        )->get();

        return view('layout.staff.products.specification-listing')->with([
            'subcategory' => $subcategory,
            'specification' => $specification
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
        $ProdSpecs = new Specification();

        try {
            $ProdSpecs->category_sub_id = $request->category_sub_id;
            $ProdSpecs->name = $request->name;
            $ProdSpecs->value = json_encode($request->value);
            $ProdSpecs->status = $request->status ?? 1;
            
			
			//print_r($ProdSpecs);
			
			$ProdSpecs->save();
          
		   
		  
		  
            $flasher->addSuccess('New Product Specification Added successfully!');
            return redirect()->route('product.specification.index');
        } catch (\Throwable $th) {
            $flasher->addError('Something Error!! =>' . $th);
            return redirect()->route('product.specification.index');
        }
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
    public function destroy($id, FlasherInterface $flasher)
    {
        try {
            Specification::where("id", $id)->delete();
            $flasher->addsuccess('Product Specification Removed!');
            return redirect()->route('product.specification.index');
        } catch (\Throwable $th) {
            $flasher->addError('Something Error!!');
            return redirect()->route('product.specification.index');
        }
    }
	
    public function getSpecifications(Request $request)
    {
        $spec_data = Specification::where('category_sub_id', $request->sub_category_id)->get();
       // print_r($spec_data);exit();
        return response()->json($spec_data);
    }
    public function getSpecValue(Request $request)
    {
        $spec_value = Specification::where('id', $request->specification_id)->pluck('value');

        $spec_value = json_decode($spec_value);

        return response()->json($spec_value);
    }



    // public function getsubproductdetails(Request $request)
    // {
    //     $spec_data = Specification::where('category_sub_id', $request->sub_category_id)->get();
    //    // print_r($spec_data);exit();
    //     return response()->json($spec_data);
    // }
}
