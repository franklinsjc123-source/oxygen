<?php

namespace App\Http\Controllers\vendor\ProductsController;

use App\Http\Controllers\Controller;
use App\Models\Category\CategorySub;
use App\Models\Master\Specification\Specification;
use Flasher\Prime\FlasherInterface;
use Illuminate\Http\Request;
use Nette\Utils\Arrays;
use Session;


class SpecificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $login_id = session()->get('login_id');
        $subcategory = CategorySub::get();
        $specification =Specification::wherein('master_specification.created_byid', [$login_id,1])->get();
        // $specification = CategorySub::join(
        //     'master_specification',
        //     'category_sub.id',
        //     '=',
        //     'master_specification.category_sub_id'
        // )
        //  ->wherein('master_specification.created_byid', [$login_id,1])
        //  ->where('master_specification.created_by','vendor')
        //  ->get();

        return view('layout.vendor.products.specification-listing')->with([
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
         $login_id = session()->get('login_id');
         $spec_name = Specification::where('name',$request->name)->first();
         if(empty($spec_name)){
             
         
         $ProdSpecs = new Specification();
         
          

        try {
            $ProdSpecs->category_sub_id = $request->category_sub_id;
            $ProdSpecs->name = $request->name;
            $ProdSpecs->value = json_encode($request->value);
            $ProdSpecs->status = $request->status ?? 1;
            $ProdSpecs->created_by = 'vendor';
			$ProdSpecs->created_byid = $login_id;
			//print_r($ProdSpecs);
			
			$ProdSpecs->save();
          
		   
		  
		  
            $flasher->addSuccess('New Product Specification Added successfully!');
            return redirect()->route('vendorproduct.specification.index');
        } catch (\Throwable $th) {
            $flasher->addError('Something Error!! =>' . $th);
            return redirect()->route('vendorproduct.specification.index');
        }
         }
         else{
               $flasher->addError('Specification name already exit!');
            return redirect()->route('vendorproduct.specification.index');
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
            return redirect()->route('vendorproduct.specification.index');
        } catch (\Throwable $th) {
            $flasher->addError('Something Error!!');
            return redirect()->route('vendorproduct.specification.index');
        }
    }
	
    public function getSpecifications(Request $request)
    {
        $login_id = session()->get('login_id');
        $spec_data = Specification::whereIn('created_byid', [$login_id, 1])->get();
        // ->where('created_by','vendor')
    
       
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
    
    
     /*Edit Specfication*/
     public function vendoreditspec($id)
         {
            $login_id = session()->get('login_id');
             // $subcategory = CategorySub::find($id);
             $subcategory = Specification::select('master_specification.id', 'master_specification.category_sub_id', 'master_specification.name', 'master_specification.value','master_specification.status','master_specification.created_byid', 'category_sub.category_sub_name','category_sub.category_id')
        ->join(
            'category_sub',
            'master_specification.category_sub_id',
            '=',
            'category_sub.id'
        )
        ->where('master_specification.id', $id)
        ->where('master_specification.created_byid', $login_id)
        ->get();

             // dd($subcategory);
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
         $login_id = session()->get('login_id');
         try {
             $Specification =  Specification::find($id);
             // dd($Specification);
              $Specification->category_sub_id = $request->editcategory_sub_id;
              $Specification->name = $request->editname;
              $Specification->value = json_encode($request->value);
              $Specification->status = $request->editstatus;
              $Specification->created_by = 'vendor';
		  	  $Specification->created_byid = $login_id;
            
              $Specification->update();
              //return ($id);
             $flasher->addSuccess('New Attribute Updated successfully!');
             //  return response()->json([
 
             //           'Category'=>'stored'
                    
             //       ]);
              return redirect()->route('vendorproduct.specification.index');
           } catch (\Throwable $th) {
              // dd($th);
               $flasher->addError('Something Error!!');
               return redirect()->route('vendorproduct.specification.index');
           }
               
     }

}
