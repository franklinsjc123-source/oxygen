<?php

namespace App\Http\Controllers\vendor\CategorySubController;

use App\Helper\ImageUploadHelper\ImageUploadHelper;
use App\Http\Controllers\Controller;
use App\Models\Category\CategoryMain;
use App\Models\Category\CategorySub;
use App\Models\Category\Category;
use App\Models\Master\Specification\SpecificationGroup;
use App\Models\Master\Attribute\AttributeGroup;
use App\Models\vendor\vendorcreate;
use Illuminate\Http\Request;
use Flasher\Prime\FlasherInterface;
use DB;
use Illuminate\Support\Facades\Session;
class CategorySubController extends Controller
{
   
    public function index()
    {
        $login_id = session()->get('login_id');
        $vendorcreate = vendorcreate::select('sub_category_ids')->where('id',$login_id)->first();
        $subcategoryarray=($vendorcreate->sub_category_ids)?explode(',',$vendorcreate->sub_category_ids):0;
        
        $sub_category_data = CategorySub::
        join('category', 'category_sub.category_id', '=', 'category.id') 
        -> join('category_main', 'category_sub.category_main_id', '=', 'category_main.id')
        ->select('*','category_sub.id as me_id', 'category_sub.status as sc_status' )        
        ->whereIn('category_sub.id', $subcategoryarray)->get(); 
        $attributegroup = AttributeGroup::all();
        $specificationgroup = SpecificationGroup::all();
        return view('layout.vendor.category.category_sub')
            ->with([
                "sub_category_data" => $sub_category_data,
                "view" => "table",
                "attributegroup" => $attributegroup,
                "specificationgroup" => $specificationgroup,
                
            ]);
            
    }
    public function viewcategory_sub($id)
    {
        $login_id = session()->get('login_id');
        $vendorcreate = vendorcreate::select('sub_category_ids')->where('id',$login_id)->first();
        $subcategoryarray=($vendorcreate->sub_category_ids)?explode(',',$vendorcreate->sub_category_ids):0;
        //dd($subcategoryarray);
        $sub_category_data = CategorySub::
        join('category', 'category_sub.category_id', '=', 'category.id') 
        -> join('category_main', 'category_sub.category_main_id', '=', 'category_main.id')
        ->select('*','category_sub.id as me_id', 'category_sub.status as sc_status' )        
        ->whereIn('category_sub.id', $subcategoryarray)->get(); 
        
        $sub_category_viewdata = CategorySub::
        join('category', 'category_sub.category_id', '=', 'category.id') 
        -> join('category_main', 'category_sub.category_main_id', '=', 'category_main.id')
        ->select('*','category_sub.id as me_id', 'category_sub.status as sc_status' )        
        ->where('category_sub.id', $id)->first(); 
        $category_sub_attributes=($sub_category_viewdata->category_sub_attributes)?explode(',',$sub_category_viewdata->category_sub_attributes):['0'];
        $category_sub_specifications=($sub_category_viewdata->category_sub_specifications)?explode(',',$sub_category_viewdata->category_sub_specifications):['0'];
       
        $attributegroup = AttributeGroup::whereIn('id', $category_sub_attributes)->get();
        //dd($attributegroup);
        $specificationgroup = SpecificationGroup::whereIn('id', $category_sub_specifications)->get(); 
        return view('layout.vendor.category.category_sub')
            ->with([
                "sub_category_data" => $sub_category_data,
                "view" => "Modal",
                "sub_category_viewdata" => $sub_category_viewdata,
                "attributegroup" => $attributegroup,
                "specificationgroup" => $specificationgroup,
                
            ]);
            
    }
    public function edit($id)
    {
        $category_sub = CategorySub::find($id);
        if($category_sub)
        {
            return response()->json([

                'status'=>200,
                'category_sub'=>$category_sub
               
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

   
    public function update(Request $request, $id, FlasherInterface $flasher)
    {
        
        
        $category =  CategorySub::find($id);
        $login_id  = Session::get('login_id');
       
        if($request->file('editsub_category_iamge'))
        {   
            $category_image = $request->file('editsub_category_iamge');
            
            $image=$category->id."_image.".$category_image->getClientOriginalExtension();
            
            $img = Image::make($category_image->getRealPath());
            
            $img->resize(500, 300, function ($constraint) {
                
                $constraint->aspectRatio();
                
            })->save($this->image_path.'/'.$image);
            
            
            
            $filename =  $image;
        }
        else
        {
            $filename ="";
        }


         try {
             
              $category->category_main_id = $request->editmain_category_id;
              $category->category_id = $request->editcategory_id;
              $category->category_sub_name = $request->editsub_category_name;
              $category->category_sub_image = $filename ?? "-";
              $category->status = $request->editstatus;
              $category->flag = 1;
              $category->created_by = 'vendor'; /*auth()->user()->id*/;
              $category->created_byid = $login_id;
              $category->update();
              return redirect()->route('vendorcategory.main.index');
             } catch (\Throwable $th) {
                //  $flasher->addError('Something Error!!' . $th);
               // return error();
               dd($th);
                  return redirect()->route('vendorcategory.main.index')->withErrors($th);
             }
               
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, FlasherInterface $flasher)
    {
       // try {

       // return ($id);

      // $sc_id = ($id);

            $image = CategorySub::find($id);
           // unlink($this->image_path . "/" . $image->category_sub_image);
            $file  = $this->image_path . "/" . $image->category_sub_image;
            //$image->delete();
            if (!file_exists($file)) unlink($file);
            CategorySub::where('id', $id)->delete();
            $flasher->addsuccess('Sub Category Removed!');
            return redirect()->route('vendorcategory.sub.index');
        //} catch (\Throwable $th) {
            //$flasher->addError('Something Error!');
           // return redirect()->route('category.sub.index');
        //}
    }
}
