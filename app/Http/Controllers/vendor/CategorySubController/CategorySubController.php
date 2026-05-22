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
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CategorySubController extends Controller
{

    public function index(Request $request)
    {
        $login_id = session()->get('login_id');
        $vendorcreate = vendorcreate::select('sub_category_ids')->where('id', $login_id)->first();
        $subcategoryarray = ($vendorcreate && $vendorcreate->sub_category_ids) ? explode(',', $vendorcreate->sub_category_ids) : [];

        $sub_category_data = CategorySub::join('category', 'category_sub.category_id', '=', 'category.id')
            ->join('category_main', 'category_sub.category_main_id', '=', 'category_main.id')
            ->select('*', 'category_sub.id as me_id', 'category_sub.status as sc_status')
            ->whereIn('category_sub.id', $subcategoryarray)->get();
        $viewId = (int) $request->query('view_id', 0);
        if ($viewId > 0) {
            $sub_category_viewdata = CategorySub::join('category', 'category_sub.category_id', '=', 'category.id')
                ->join('category_main', 'category_sub.category_main_id', '=', 'category_main.id')
                ->select('*', 'category_sub.id as me_id', 'category_sub.status as sc_status')
                ->where('category_sub.id', $viewId)
                ->first();

            if ($sub_category_viewdata) {
                $defaultAttributeIds = ($sub_category_viewdata->category_sub_attributes)
                    ? array_values(array_filter(array_map('intval', explode(',', $sub_category_viewdata->category_sub_attributes))))
                    : [];

                $defaultSpecificationIds = ($sub_category_viewdata->category_sub_specifications)
                    ? array_values(array_filter(array_map('intval', explode(',', $sub_category_viewdata->category_sub_specifications))))
                    : [];

                $mapping = DB::table('sub_category_mapping')->where('sub_category_id', $viewId)->where('vendor_id', $login_id)->first();

                if ($mapping && $mapping->category_sub_attribute_ids) {
                    $vendorAttrs = array_map('intval', json_decode($mapping->category_sub_attribute_ids, true) ?: []);
                    $attributegroup = AttributeGroup::where(function ($q) use ($vendorAttrs, $viewId, $login_id) {
                            $q->whereIn('id', $vendorAttrs)
                              ->where(function ($subQ) use ($viewId, $login_id) {
                                  $subQ->whereRaw("FIND_IN_SET(?, sub_category_ids)", [$viewId])
                                       ->orWhere('created_byid', $login_id);
                              });
                        })
                        ->orWhere('created_byid', $login_id)
                        ->orderBy('attribute_group_name', 'asc')
                        ->get();
                } else {
                    $attributegroup = AttributeGroup::where('created_byid', $login_id)
                        ->orderBy('attribute_group_name', 'asc')
                        ->get();
                }

                $mappedAttributeIds = $attributegroup->pluck('id')->toArray();

                $selectedAttributeIds = ($mapping && $mapping->category_sub_attribute_ids)
                    ? array_values(array_filter(array_map('intval', json_decode($mapping->category_sub_attribute_ids, true) ?: [])))
                    : [];

                $specificationgroup = SpecificationGroup::whereRaw("FIND_IN_SET(?, sub_category_ids)", [$viewId])
                    ->orWhereIn('id', $defaultSpecificationIds)
                    ->orWhere(function ($query) use ($login_id) {
                        $query->where('created_byid', $login_id)
                            ->where('created_by', 'Vendor');
                    })
                    ->orderBy('specification_group_name', 'asc')
                    ->get();

                $mappedSpecificationIds = $specificationgroup->pluck('id')->toArray();

                $selectedSpecificationIds = ($mapping && $mapping->category_sub_specification_ids)
                    ? array_values(array_filter(array_map('intval', json_decode($mapping->category_sub_specification_ids, true) ?: [])))
                    : [];

                return view('layout.vendor.category.category_sub')->with([
                    "sub_category_data" => $sub_category_data,
                    "view" => "Modal",
                    "sub_category_viewdata" => $sub_category_viewdata,
                    "attributegroup" => $attributegroup,
                    "specificationgroup" => $specificationgroup,
                    "selectedAttributeIds" => $selectedAttributeIds,
                    "selectedSpecificationIds" => $selectedSpecificationIds,
                ]);
            }
        }

        $attributegroup = AttributeGroup::all(); // Keep all for main table or filter if needed, but for now focus on the modal filter above.
        // Actually, let's keep all here as it's not the modal view.
        $specificationgroup = SpecificationGroup::all();
        return view('layout.vendor.category.category_sub')->with([
            "sub_category_data" => $sub_category_data,
            "view" => "table",
            "attributegroup" => $attributegroup,
            "specificationgroup" => $specificationgroup,
        ]);
    }

    public function viewcategory_sub($id)
    {
        return redirect()->route('vendorcategory.sub.index', ['view_id' => $id]);
    }

    public function updateMapping(Request $request, $id)
    {
        $login_id = session()->get('login_id');
        $request->validate([
            'category_sub_attribute_ids' => 'nullable|array',
            'category_sub_attribute_ids.*' => 'integer',
            'category_sub_specification_ids' => 'nullable|array',
            'category_sub_specification_ids.*' => 'integer',
        ]);

        $attributeIds = array_values(array_unique(array_map('intval', $request->input('category_sub_attribute_ids', []))));
        $specificationIds = array_values(array_unique(array_map('intval', $request->input('category_sub_specification_ids', []))));

        DB::table('sub_category_mapping')->updateOrInsert(
            ['sub_category_id' => $id, 'vendor_id' => $login_id],
            [
                'category_sub_attribute_ids' => json_encode($attributeIds),
                'category_sub_specification_ids' => json_encode($specificationIds),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        return redirect()->route('vendorcategory.sub.index')->with('success', 'Sub-category mapping updated successfully.');
    }

    public function edit($id)
    {
        $category_sub = CategorySub::find($id);
        if ($category_sub) {
            return response()->json([

                'status' => 200,
                'category_sub' => $category_sub

            ]);
        } else {
            return response()->json([

                'status' => 404,
                'message' => 'Package not found',
            ]);
        }
    }


    public function update(Request $request, $id, FlasherInterface $flasher)
    {


        $category =  CategorySub::find($id);
        $login_id  = Session::get('login_id');

        if ($request->file('editsub_category_iamge')) {
            $category_image = $request->file('editsub_category_iamge');

            $image = $category->id . "_image." . $category_image->getClientOriginalExtension();

            $img = Image::make($category_image->getRealPath());

            $img->resize(500, 300, function ($constraint) {

                $constraint->aspectRatio();
            })->save($this->image_path . '/' . $image);



            $filename =  $image;
        } else {
            $filename = "";
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
