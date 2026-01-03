<?php

namespace App\Http\Controllers\vendor\CategoryMainController;

use App\Helper\ImageUploadHelper\ImageUploadHelper;
use App\Http\Controllers\Controller;
use App\Models\Category\CategoryMain;
use Illuminate\Http\Request;
use Flasher\Prime\FlasherInterface;
use Intervention\Image\ImageManagerStatic as Image;
use DB;
use Session;

class CategoryMainController extends Controller
{
    private $image_path = "assets/images/categoryMain";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $login_id = session()->get('login_id');
        $category_main = CategoryMain::where('created_byid', $login_id)->get();

        return view('layout.vendor.category.category_main')->with("category_main", $category_main);
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

        $category_main = new CategoryMain();
        $statement = DB::select("SHOW TABLE STATUS LIKE 'vendor_category_main'");
        $next_maincategory_id = $statement[0]->Auto_increment;
        // $file = $request->main_category_image;

        // if ($file !== null) $filename = ImageUploadHelper::storeImage($file, $this->image_path);

            $login_id = session()->get('login_id');
            if($request->file('main_category_image'))
            {   
                $category_image = $request->file('main_category_image');
                
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
            $category_main->category_main_name = $request->main_category_name;
            $category_main->category_main_image = $filename ?? "-";
            $category_main->status = $request->catstatus ?? 1;
            $category_main->created_by = 'vendor'; 
            $category_main->created_byid = $login_id;
            $category_main->save();
            $flasher->addSuccess('Data has been saved successfully!');
            return redirect()->route('vendorcategory.main.index');
        } catch (\Throwable $th) {
            $flasher->addError('Something Error!!' . $th);
            return redirect()->route('vendorcategory.main.index');
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $category_main = CategoryMain::find($id);
        
        if($category_main)
        {
            return response()->json([

                'status'=>200,
                'category_main'=>$category_main
               
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
       
    //echo 'test123';
        $category_main = CategoryMain::find($id);
        $login_id = session()->get('login_id');
        // if(isset($request->editmain_category_image))
        // {
        //     $file = $request->editmain_category_image;
        //     if ($file !== null) {
        //     $filename = ImageUploadHelper::storeImage($file, $this->image_path);
        //     }
        // } else{

           
        //     $filename = $request->oldeditmain_category_image;
        // }


        if($request->file('editmain_category_image'))
        {   
            $category_image = $request->file('editmain_category_image');
            
            $image=$category_main->id."_image.".$category_image->getClientOriginalExtension();
            
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
            $category_main->category_main_name = $request->editmain_category_name;
            $category_main->category_main_image = $filename ?? "-";
            $category_main->status = $request->editstatus ?? 1;
            $category_main->created_by = 'vendor'; /*auth()->user()->id*/;
            $category_main->created_byid = $login_id;
        
            $category_main->save();
            $flasher->addSuccess('Data has been updated successfully!');
            return redirect()->route('vendorcategory.main.index');
        } catch (\Throwable $th) {
            $flasher->addError('Something Error!!' . $th);
            return redirect()->route('vendorcategory.main.index');
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
        try {
            $image = CategoryMain::find($id);

            $file = $this->image_path . "/" . $image->category_main_image;

            if (!file_exists($file)) unlink($file);

            CategoryMain::where("id", $id)->delete();
            $flasher->addsuccess('Main Category Removed!');
            return redirect()->route('vendorcategory.main.index');
        } catch (\Throwable $th) {
            $flasher->addError('Something Error!!');
            return redirect()->route('vendorcategory.main.index');
        }
    }
}
