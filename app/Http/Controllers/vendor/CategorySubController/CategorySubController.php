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
        $subcategoryarray = array_values(array_filter(array_map('intval', array_map('trim', explode(',', (string) optional($vendorcreate)->sub_category_ids)))));

        // Only show sub-categories that have at least one attribute or specification mapped for this vendor
        $mappedSubIds = DB::table('sub_category_mapping')
            ->where('vendor_id', $login_id)
            ->where(function ($q) {
                $q->where(function ($sq) {
                    $sq->whereNotNull('category_sub_attribute_ids')
                       ->where('category_sub_attribute_ids', '!=', '[]')
                       ->where('category_sub_attribute_ids', '!=', '');
                })->orWhere(function ($sq) {
                    $sq->whereNotNull('category_sub_specification_ids')
                       ->where('category_sub_specification_ids', '!=', '[]')
                       ->where('category_sub_specification_ids', '!=', '');
                });
            })
            ->pluck('sub_category_id')
            ->toArray();

        // Also include sub-categories referenced by vendor-created attribute/specification groups
        $vendorAttrSubIds = AttributeGroup::where('created_byid', $login_id)
            ->whereNotNull('sub_category_ids')->where('sub_category_ids', '!=', '')
            ->pluck('sub_category_ids')->flatMap(fn($ids) => explode(',', $ids))
            ->filter()->map(fn($id) => (int)$id)->toArray();

        $vendorSpecSubIds = SpecificationGroup::where('created_byid', $login_id)
            ->whereNotNull('sub_category_ids')->where('sub_category_ids', '!=', '')
            ->pluck('sub_category_ids')->flatMap(fn($ids) => explode(',', $ids))
            ->filter()->map(fn($id) => (int)$id)->toArray();

        $activeSubIds = array_values(array_unique(array_merge($mappedSubIds, $vendorAttrSubIds, $vendorSpecSubIds)));
        // Intersect with vendor's authorized sub-category IDs
        $filteredSubIds = !empty($subcategoryarray)
            ? array_values(array_intersect($subcategoryarray, $activeSubIds))
            : [];

        $sub_category_data = CategorySub::join('category', 'category_sub.category_id', '=', 'category.id')
            ->join('category_main', 'category_sub.category_main_id', '=', 'category_main.id')
            ->select('*', 'category_sub.id as me_id', 'category_sub.status as sc_status')
            ->whereIn('category_sub.id', !empty($filteredSubIds) ? $filteredSubIds : [0])->get();
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

                $selectedAttributeIds = [];
                $selectedSpecificationIds = [];
                
                if ($mapping) {
                    $attrData = json_decode($mapping->category_sub_attribute_ids, true);
                    $specData = json_decode($mapping->category_sub_specification_ids, true);
                    if (is_array($attrData)) $selectedAttributeIds = array_values(array_filter(array_map('intval', $attrData)));
                    if (is_array($specData)) $selectedSpecificationIds = array_values(array_filter(array_map('intval', $specData)));
                } else {
                    $adminMapping = DB::table('sub_category_mapping')->where('sub_category_id', $viewId)->whereNull('vendor_id')->first();
                    $adminAttrs = $adminMapping ? (json_decode($adminMapping->category_sub_attribute_ids, true) ?: []) : [];
                    $adminSpecs = $adminMapping ? (json_decode($adminMapping->category_sub_specification_ids, true) ?: []) : [];
                    
                    $globalAttrIds = AttributeGroup::whereRaw("FIND_IN_SET(?, sub_category_ids)", [$viewId])->pluck('id')->toArray();
                    $globalSpecIds = SpecificationGroup::whereRaw("FIND_IN_SET(?, sub_category_ids)", [$viewId])->pluck('id')->toArray();
                    
                    $selectedAttributeIds = array_values(array_unique(array_merge($adminAttrs, $globalAttrIds, $defaultAttributeIds)));
                    $selectedSpecificationIds = array_values(array_unique(array_merge($adminSpecs, $globalSpecIds, $defaultSpecificationIds)));
                }

                // Merge vendor's own mapping which is stored directly in attribute/specification group tables
                $vendorAttrIds = AttributeGroup::where('created_byid', $login_id)
                    ->whereRaw("FIND_IN_SET(?, sub_category_ids)", [$viewId])
                    ->pluck('id')
                    ->toArray();

                $vendorSpecIds = SpecificationGroup::where('created_byid', $login_id)
                    ->whereRaw("FIND_IN_SET(?, sub_category_ids)", [$viewId])
                    ->pluck('id')
                    ->toArray();

                $selectedAttributeIds = array_values(array_unique(array_merge($selectedAttributeIds, $vendorAttrIds)));
                $selectedSpecificationIds = array_values(array_unique(array_merge($selectedSpecificationIds, $vendorSpecIds)));

                $attributegroup = AttributeGroup::where(function($q) use ($viewId, $login_id) {
                        $q->where(function($q1) use ($viewId, $login_id) {
                            $q1->where('created_byid', $login_id)
                               ->whereRaw("FIND_IN_SET(?, sub_category_ids)", [$viewId]);
                        })
                        ->orWhere(function($q2) use ($viewId) {
                            $q2->whereIn('created_byid', [1]) // Admin
                               ->whereRaw("FIND_IN_SET(?, sub_category_ids)", [$viewId]);
                        });
                    })
                    ->orderBy('attribute_group_name', 'asc')
                    ->get();

                $specificationgroup = SpecificationGroup::where(function($q) use ($viewId, $login_id) {
                        $q->where(function($q1) use ($viewId, $login_id) {
                            $q1->where('created_byid', $login_id)
                               ->whereRaw("FIND_IN_SET(?, sub_category_ids)", [$viewId]);
                        })
                        ->orWhere(function($q2) use ($viewId) {
                            $q2->where('created_by', 'Admin')
                               ->whereRaw("FIND_IN_SET(?, sub_category_ids)", [$viewId]);
                        });
                    })
                    ->orderBy('specification_group_name', 'asc')
                    ->get();

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

        $submittedAttributeIds = array_values(array_unique(array_map('intval', $request->input('category_sub_attribute_ids', []))));
        $submittedSpecificationIds = array_values(array_unique(array_map('intval', $request->input('category_sub_specification_ids', []))));

        // Separate Admin-created and Vendor-created attributes/specifications
        $vendorAttrs = AttributeGroup::where('created_byid', $login_id)->get();
        $vendorSpecs = SpecificationGroup::where('created_byid', $login_id)->get();

        $vendorAttrIds = $vendorAttrs->pluck('id')->toArray();
        $vendorSpecIds = $vendorSpecs->pluck('id')->toArray();

        // Admin-created IDs are those in the submitted list that do NOT belong to the vendor
        $adminAttributeIds = array_values(array_diff($submittedAttributeIds, $vendorAttrIds));
        $adminSpecificationIds = array_values(array_diff($submittedSpecificationIds, $vendorSpecIds));

        // Save Admin-created mappings in sub_category_mapping
        DB::table('sub_category_mapping')->updateOrInsert(
            ['sub_category_id' => $id, 'vendor_id' => $login_id],
            [
                'category_sub_attribute_ids' => json_encode($adminAttributeIds),
                'category_sub_specification_ids' => json_encode($adminSpecificationIds),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        // Update Vendor-created groups
        foreach ($vendorAttrs as $group) {
            $subCategoryIds = array_filter(explode(',', $group->sub_category_ids ?? ''));
            $isSubmitted = in_array($group->id, $submittedAttributeIds);

            if ($isSubmitted) {
                if (!in_array((string)$id, $subCategoryIds)) {
                    $subCategoryIds[] = (string)$id;
                }
            } else {
                $subCategoryIds = array_diff($subCategoryIds, [(string)$id]);
            }

            $group->sub_category_ids = implode(',', $subCategoryIds);
            $group->save();
        }

        foreach ($vendorSpecs as $group) {
            $subCategoryIds = array_filter(explode(',', $group->sub_category_ids ?? ''));
            $isSubmitted = in_array($group->id, $submittedSpecificationIds);

            if ($isSubmitted) {
                if (!in_array((string)$id, $subCategoryIds)) {
                    $subCategoryIds[] = (string)$id;
                }
            } else {
                $subCategoryIds = array_diff($subCategoryIds, [(string)$id]);
            }

            $group->sub_category_ids = implode(',', $subCategoryIds);
            $group->save();
        }

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
