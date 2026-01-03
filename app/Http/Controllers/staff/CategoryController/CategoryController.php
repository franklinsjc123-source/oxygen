<?php

namespace App\Http\Controllers\staff\CategoryController;

use App\Helper\ImageUploadHelper\ImageUploadHelper;
use App\Http\Controllers\Controller;
use App\Models\Category\Category;
use App\Models\Category\CategoryMain;
use App\Models\Category\CategorySub;
use Flasher\Prime\FlasherInterface;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;
use DB;

class CategoryController extends Controller
{
    private $image_path = "assets/images/category";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category_data = Categorymain::join('category', 'category.main_category_id', '=', 'category_main.id')
            ->get();
        $category_main = CategoryMain::get();

        return view('layout.staff.category.category')
            ->with([
                "category" => $category_data,
                "category_main" => $category_main
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
        $category = new Category();
        $statement = DB::select("SHOW TABLE STATUS LIKE 'category'");
        $next_maincategory_id = $statement[0]->Auto_increment;
        // $file = $request->category_image;

        // if ($file !== null) $filename = ImageUploadHelper::storeImage($file, $this->image_path);


        if($request->file('category_image'))
        {   
            $category_image = $request->file('category_image');
            
            $image = $next_maincategory_id."_image.".$category_image->getClientOriginalExtension();
            
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
            $category->main_category_id = $request->main_category_id;
            $category->category_name = $request->category_name;

            $category->category_image = $filename ?? "-";

            $category->status = $request->catstatus ?? "1";
            $category->flag = 0;
            $category->created_by = 1 /*auth()->user()->id*/;
            $category->save();
            $flasher->addSuccess('New Category Added successfully!');
            return redirect()->route('category.index');
        } catch (\Throwable $th) {
            dd($th);
            $flasher->addError('Something Error!!');
            return redirect()->route('category.index');
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
        $Category = Category::find($id);
         
        
        return response()->json([
            'Category'=>$Category
             //$zone_data
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, FlasherInterface $flasher)
    {

         
       // return ($id);

    //    if(isset($request->editcategory_image))
    //    {
    //      $file = $request->editcategory_image;
    //      if ($file !== null) {
    //      $filename = ImageUploadHelper::storeImage($file, $this->image_path);
    //      }
    //     } else{

           
    //         $filename = $request->oldeditcategory_image;
    //     }

    if($request->file('editcategory_image'))
        {   
            $category_image = $request->file('editcategory_image');
            
            $image=$id."_image.".$category_image->getClientOriginalExtension();
            
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
            $category =  Category::find($id);
             $category->main_category_id = $request->editmain_category_id;
             
             $category->category_name = $request->editcategory_name;
             $category->category_image = $filename ?? "-";
            
            $category->status = $request->editstatus;
             $category->flag = 0;
             $category->created_by = 1 ;
            
             $category->update();
             //return ($id);
            $flasher->addSuccess('New Category Added successfully!');
            //  return response()->json([

            //           'Category'=>'stored'
                   
            //       ]);
             return redirect()->route('category.index');
          } catch (\Throwable $th) {
             // dd($th);
              $flasher->addError('Something Error!!');
              return redirect()->route('category.index');
          }
              
        
        //  $Category = Category::find($id);
        //  $input  = $request->all();
        //  $Category->update($input);
        //  return response()->json([
        //      'Category'=>$Category
           
        //  ]);
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
            $image = Category::find($id);
            //unlink($this->image_path . "/" . $image->category_image);
            $file = $this->image_path . "/" . $image->category_image;

            if (!file_exists($file)) unlink($file);
            Category::where("id", $id)->delete();
            $flasher->addsuccess('Category Removed!');
            return redirect()->route('category.index');
        } catch (\Throwable $th) {
            $flasher->addError('Something Error!');
            return redirect()->route('category.index');
        }
    }

    public function getCategory(Request $request)
    {
        $category_data = Category::where('main_category_id', $request->main_category_id)->get();
        return response()->json($category_data);
    }

    public function getSubCategory(Request $request)
    {
        $sub_category_data = CategorySub::where('category_id', $request->category_id)->get();
        return response()->json($sub_category_data);
    }
}
