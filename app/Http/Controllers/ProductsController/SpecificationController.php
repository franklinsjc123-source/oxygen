<?php

namespace App\Http\Controllers\ProductsController;

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
        $specification =Specification::where('created_byid', 1)->get();
        // $specification = CategorySub::join(
        //     'master_specification',
        //     'category_sub.id',
        //     '=',
        //     'master_specification.category_sub_id'
        // )->get();

        return view('layout.admin.products.specification-listing')->with([
            'subcategory' => $subcategory,
            'subcategory1' => $subcategory,
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
         $request->validate([
        
        'name' => 'required|unique:master_specification,name',
        ]);
         $spec_name = Specification::where('name',$request->name)->first();
         if(empty($spec_name)){
             
        $ProdSpecs = new Specification();

        try {
            $ProdSpecs->category_sub_id = $request->category_sub_id;
            $ProdSpecs->name = $request->name;
            $ProdSpecs->value = json_encode($request->value);
            $ProdSpecs->status = $request->status ?? 1;
            $ProdSpecs->created_by = 'admin';
			$ProdSpecs->created_byid = 1;
            
			
			//print_r($ProdSpecs);
			
			$ProdSpecs->save();
          
		   
		  
		  
            $flasher->addSuccess('New Product Specification Added successfully!');
            return redirect()->route('product.specification.index');
        } catch (\Throwable $th) {
            $flasher->addError('Something Error!! =>' . $th);
            return redirect()->route('product.specification.index');
        }
         }
         else{
            $flasher->addError('Specification name already exit!');
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
     /*Edit Specfication*/
    public function editspec($id)
    {
        // $subcategory = CategorySub::find($id);
        $subcategory = Specification::select('master_specification.id', 'master_specification.category_sub_id', 'master_specification.name', 'master_specification.value','master_specification.status')

        // ->join(
        //     'category_sub',
        //     'master_specification.category_sub_id',
        //     '=',
        //     'category_sub.id'
        // )
        ->where([['master_specification.id', $id]])
            ->get();
            //  dd($subcategory);
        if($subcategory)
        {
            return response()->json([

                'status'=>200,
                'subcategory'=>$subcategory
               
            ]);
        }
        else
        {
            return response()->json([

                'status'=>404,
                'message'=>'Package not found',
            ]);
        }
    }

    public function updatespec(Request $request, $id, FlasherInterface $flasher)
    {
        try {
            $Specification =  Specification::find($id);
            // dd($Specification);
             $Specification->category_sub_id = $request->editcategory_sub_id;
             $Specification->name = $request->editname;
             $Specification->value = json_encode($request->value);
             $Specification->status = $request->editstatus;
             $Specification->created_by = 'adminr';
		  	 $Specification->created_byid = 1;
              //dd($Specification);
             $Specification->update();
             //return ($id);
            $flasher->addSuccess('New Attribute Updated successfully!');
            //  return response()->json([

            //           'Category'=>'stored'
                   
            //       ]);
             return redirect()->route('product.specification.index');
          } catch (\Throwable $th) {
             // dd($th);
              $flasher->addError('Something Error!!');
              return redirect()->route('product.specification.index');
          }
              
    }
    
    /*Category Details*/
    public function scatedetails(Request $request)
    {
        // echo $request->sub_category_id;
        // exit;
        // $category_main_data = CategoryMain::get();
        // $category = Category::get();
        $catedetails = CategorySub::select('category_sub.id', 'category_sub.category_sub_name','category.id', 'category.category_name', 'category_main.id','category_main.category_main_name','category_sub.category_sub_name','category_sub.category_id','category_sub.id')
        ->join('category','category.id','=','category_sub.category_id')
        ->join('category_main','category_main.id','=','category_sub.category_main_id')
        ->where('category_sub.id', $request->sub_category_id)
        ->get();
        // dd($catedetails);
        if($catedetails)
        {
            return response()->json([

                'status'=>200,
                'catedetails'=>$catedetails
               
            ]);
        }
        else
        {
            return response()->json([

                'status'=>404,
                'message'=>'Details not found',
            ]);
        }

    }
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
        $spec_data = Specification::all();
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
