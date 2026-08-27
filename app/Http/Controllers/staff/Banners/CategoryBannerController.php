<?php

namespace App\Http\Controllers\staff\Banners;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Banners\CategoryBanner;
use Flasher\Prime\FlasherInterface;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;

use Carbon\Carbon;
use DateTime;
use DateTimeZone;

class CategoryBannerController extends Controller
{
    private $main_image_path = "assets/images/banners/category-banner";

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        date_default_timezone_set('GMT');
        $dt = new DateTime('Asia/Kolkata');
        $dat = $dt->format('Y-m-d');
        $time = $dt->format('H:i:s');
        $date = "$dat";

        $categoryBanners = CategoryBanner::all();
        return view('layout.staff.banner.categorybanner')
            ->with([
                'categoryBanners' => $categoryBanners,
                "date" => $date,
                "time" => $time
            ]);
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
            'mainImage' => 'required|image|dimensions:width=447,height=230',
        ]);

        try {
            $banner = new CategoryBanner();

            $file = $request->file('mainImage');
            $image = time().'.'.$file->getClientOriginalExtension();
            
            $img = Image::make($file->getRealPath());
            $img->resize(447, 230, function ($constraint) {
                $constraint->aspectRatio();
            })->save($this->main_image_path.'/'.$image);

            $banner->admin_id = session()->get('login_id');
            $banner->title = strip_tags($request->title);
            $banner->sub_title = strip_tags($request->sub_title);
            $banner->image = $image;
            $banner->link = $request->link;
            $banner->sort = $request->sort;
            $banner->status = $request->status;

            $banner->save();

            $flasher->addSuccess('Category Banner Information has been saved successfully!');
            return redirect()->route('staffcategory-banners.index');
        } catch (\Throwable $th) {
            $flasher->addError('Something went wrong: ' . $th->getMessage());
            return redirect()->route('staffcategory-banners.index');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $banner = CategoryBanner::find($id);
        
        if ($banner) {
            return response()->json([
                'status' => 200,
                'banner' => $banner
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Banner not found',
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
        try {
            $id = $request->editid;
            $banner = CategoryBanner::find($id);

            if ($request->file('editmainImage')) {
                $request->validate([
                    'editmainImage' => 'nullable|image|dimensions:width=447,height=230',
                ]);

                $file = $request->file('editmainImage');
                $image = time().'.'.$file->getClientOriginalExtension();
                
                $img = Image::make($file->getRealPath());
                $img->resize(447, 230, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($this->main_image_path.'/'.$image);
                
                $banner->image = $image;

                $dltfile = $this->main_image_path . "/" . $request->editoldImage;
                if (file_exists($dltfile)) {
                    unlink($dltfile);
                }
            } else {
                $banner->image = $request->editoldImage;
            }

            $banner->admin_id = session()->get('login_id');
            $banner->title = strip_tags($request->edittitle);
            $banner->sub_title = strip_tags($request->editsub_title);
            $banner->link = $request->editlink;
            $banner->sort = $request->editsort;
            $banner->status = $request->editstatus;

            $banner->save();

            $flasher->addSuccess('Category Banner Information has been Updated successfully!');
            return redirect()->route('staffcategory-banners.index');
        } catch (\Throwable $th) {
            $flasher->addError('Something went wrong: ' . $th->getMessage());
            return redirect()->route('staffcategory-banners.index');
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
            $banner = CategoryBanner::find($id);
            $file = $this->main_image_path . "/" . $banner->image;
            
            if (file_exists($file)) {
                unlink($file);
            }
            $banner->delete();

            $flasher->addSuccess('Category Banner Removed!');
            return redirect()->route('staffcategory-banners.index');
        } catch (\Throwable $th) {
            $flasher->addError('Something went wrong!');
            return redirect()->route('staffcategory-banners.index');
        }
    }

    public function changestatus(Request $request)
    {
        $banner = CategoryBanner::find($request->id);
        $banner->status = $request->status;
        $banner->save();

        return response()->json(['success' => 'Status changed successfully.']);
    }
}
