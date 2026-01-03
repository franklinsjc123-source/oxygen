<?php

namespace App\Http\Controllers\staff\CategorySubController;

use App\Helper\ImageUploadHelper\ImageUploadHelper;
use App\Http\Controllers\Controller;
use App\Models\Category\CategoryMain;
use App\Models\Category\CategorySub;
use Illuminate\Http\Request;
use Flasher\Prime\FlasherInterface;
use App\Models\Category\Category;
use Intervention\Image\ImageManagerStatic as Image;
use DB;

class CategorySubController extends Controller
{
    private $image_path  = "assets/images/categorySub";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $sub_category_data = CategorySub::
         join('category', 'category_sub.category_id', '=', 'category.id') 
         -> join('category_main', 'category_sub.category_main_id', '=', 'category_main.id')
         ->select('*','category_sub.id as me_id', 'category_sub.status as sc_status' )
             ->get();

             
            //  $sub_category_data = CategoryMain::
            //  join('category', 'category.main_category_id', '=', 'category_main.id')
            //  ->join('category_sub',  'category_sub.category_main_id', '=', 'category_main.id')   
           
            //->join('', 'category_sub.id', '=', 'category_sub.id')         
            // ->get();
//return ('ftu');
        $category_main = CategoryMain::get();
        $category = Category::get();

        return view('layout.staff.category.category_sub')
            ->with([
                "sub_category_data" => $sub_category_data,
                "category_main" => $category_main,
                "category" => $category,
                
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

        $sub_category = new CategorySub();
        $statement = DB::select("SHOW TABLE STATUS LIKE 'category_sub'");
        $next_maincategory_id = $statement[0]->Auto_increment;
        // $file = $request->sub_category_iamge;

        // if ($file !== null) $filename = ImageUploadHelper::storeImage($file, $this->image_path);

        if($request->file('sub_category_iamge'))
        {   
            $category_image = $request->file('sub_category_iamge');
            
            $image=$next_maincategory_id."_image.".$category_image->getClientOriginalExtension();
            
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
            $sub_category->category_id = $request->category_id ?? "0";
            $sub_category->category_main_id = $request->main_category_id;
            $sub_category->category_sub_name = $request->sub_category_name;
            $sub_category->category_sub_image = $filename?? "-";
            $sub_category->status = $request->status;
            $sub_category->created_by = 1 /*auth()->user()->id*/;
            $sub_category->save();
            $flasher->addSuccess('New Category Added successfully!');
            return redirect()->route('category.sub.index');
        } catch (\Throwable $th) {
            $flasher->addError('Something Error!! =>' . $th);
           // return redirect()->route('category.sub.index');
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, FlasherInterface $flasher)
    {
        

        $category =  CategorySub::find($id);

        // if(isset($request->editsub_category_iamge))
        // {
        //   $file = $request->editsub_category_iamge;
        //   if ($file !== null) {
        //   $filename = ImageUploadHelper::storeImage($file, $this->image_path);
        //   }
        //  } else{
 
            
        //      $filename = $request->oldeditsub_category_iamge;
        //  }
        //    return ([
        //       $request->editmain_category_id,
        //       $request->editcategory_id,
        //       $request->oldeditsub_category_iamge,
        //       $request->editstatus
        //    ]);



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
              $category->flag = 0;
              $category->created_by = 1 ;
              
              $category->update();
              return redirect()->route('category.main.index');
             } catch (\Throwable $th) {
                //  $flasher->addError('Something Error!!' . $th);
               // return error();
               dd($th);
                  return redirect()->route('category.main.index')->withErrors($th);
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
            return redirect()->route('category.sub.index');
        //} catch (\Throwable $th) {
            //$flasher->addError('Something Error!');
           // return redirect()->route('category.sub.index');
        //}
    }
}
