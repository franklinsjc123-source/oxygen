<?php

namespace App\Http\Controllers\vendor\ProductsController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Master\Specification\SpecificationGroup;
use App\Models\Category\CategorySub;
use App\Models\Category\Category;
use App\Models\Category\CategoryMain;
use App\Models\vendor\vendorcreate;
use DB;
use SESSION;
class SpecificationGroupController extends Controller
{
    public function index()
    {
        $login_id = session()->get('login_id');
        $groups = SpecificationGroup::where('created_byid', $login_id)
            ->orWhere('created_by', 'Admin')
            ->get();
        return view('layout.vendor.specification_groups.index', compact('groups'));
    }

    public function create()
    {
        $login_id = session()->get('login_id');
        $vendorcreate = vendorcreate::select('sub_category_ids')->where('id', $login_id)->first();
        $subcategoryarray = array_values(array_filter(array_map('intval', array_map('trim', explode(',', (string) optional($vendorcreate)->sub_category_ids)))));

        $CategorySub = DB::table('category_sub as t1')
            ->join('category as t2', 't1.category_id', '=', 't2.id')
            ->join('category_main as t3', 't1.category_main_id', '=', 't3.id')
            ->select('t1.id', 't1.category_main_id', 't1.category_id', 't1.category_sub_name', 't2.category_name', 't3.category_main_name')
            ->where('t1.status', 1)
            ->whereIn('t1.id', $subcategoryarray)
            ->get();

        $categoryIds = $CategorySub->pluck('category_id')->unique();
        $Category = Category::whereIn('id', $categoryIds)->where('status', 1)->select('id', 'main_category_id', 'category_name')->get();

        $mainCategoryIds = $Category->pluck('main_category_id')->unique();
        $CategoryMain = CategoryMain::whereIn('id', $mainCategoryIds)->where('status', 1)->select('id', 'category_main_name')->get();

        return view('layout.vendor.specification_groups.create', compact('CategoryMain', 'Category', 'CategorySub'));
    }

    public function store(Request $request)
    {
        $login_id = session()->get('login_id');
        $validated=$request->validate([
            'specification_group_name' => 'required|string|max:255',
            'specification_group_refname' => 'required|string|max:255',
            'specification_values' => 'nullable|string|max:255',
            'sub_category_ids_csv' => 'nullable|string',
            'status' => 'nullable|string|max:255',
            'created_by' => 'nullable|string|max:255',
            'created_byid' => 'nullable|integer',
        ]);

        $selectedSubCategoryIds = [];
        if ($request->filled('sub_category_ids_csv')) {
            $selectedSubCategoryIds = explode(',', (string) $request->sub_category_ids_csv);
        }
        $selectedSubCategoryIds = array_values(array_unique(array_filter($selectedSubCategoryIds)));

        $validated['specification_values'] = "";
        $validated['sub_category_ids'] = !empty($selectedSubCategoryIds) ? implode(',', $selectedSubCategoryIds) : '';
        $validated['created_by'] = "Vendor";
        $validated['created_byid'] = $login_id;
        SpecificationGroup::create($validated);;

        return redirect()->route('specification_groups.index')->with('success', 'Specification Group created successfully.');
    }

    public function edit($id)
    {
        $group = SpecificationGroup::findOrFail($id);
        $login_id = session()->get('login_id');

        if ($group->created_by === 'Vendor' && $group->created_byid != $login_id) {
            return redirect()->route('specification_groups.index')->with('error', 'Unauthorized access.');
        }

        $vendorcreate = vendorcreate::select('sub_category_ids')->where('id', $login_id)->first();
        $subcategoryarray = array_values(array_filter(array_map('intval', array_map('trim', explode(',', (string) optional($vendorcreate)->sub_category_ids)))));

        $query = DB::table('category_sub as t1')
            ->join('category as t2', 't1.category_id', '=', 't2.id')
            ->join('category_main as t3', 't1.category_main_id', '=', 't3.id')
            ->select('t1.id', 't1.category_main_id', 't1.category_id', 't1.category_sub_name', 't2.category_name', 't3.category_main_name')
            ->where('t1.status', 1)
            ->whereIn('t1.id', $subcategoryarray);

        if ($group->created_by === 'Admin') {
            $adminAssignedIds = array_values(array_filter(array_map('intval', explode(',', $group->sub_category_ids ?? ''))));
            if (!empty($adminAssignedIds)) {
                $query->whereIn('t1.id', $adminAssignedIds);
            } else {
                // If admin didn't assign any, the vendor shouldn't see any
                $query->whereRaw('1 = 0');
            }
        }

        $CategorySub = $query->get();

        $vendorSelectedSubIds = [];
        if ($group->created_by === 'Admin') {
            foreach ($CategorySub as $sub) {
                $subId = $sub->id;
                $mapping = DB::table('sub_category_mapping')->where('sub_category_id', $subId)->where('vendor_id', $login_id)->first();
                if ($mapping) {
                    $specs = json_decode($mapping->category_sub_specification_ids, true) ?: [];
                    if (in_array($id, $specs)) {
                        $vendorSelectedSubIds[] = $subId;
                    }
                } else {
                    $adminMapping = DB::table('sub_category_mapping')->where('sub_category_id', $subId)->whereNull('vendor_id')->first();
                    $specs = $adminMapping ? (json_decode($adminMapping->category_sub_specification_ids, true) ?: []) : [];
                    $globalSpecs = explode(',', $group->sub_category_ids ?? '');
                    if (in_array($id, $specs) || in_array($subId, $globalSpecs)) {
                        $vendorSelectedSubIds[] = $subId;
                    }
                }
            }
        } else {
            $vendorSelectedSubIds = array_filter(explode(',', $group->sub_category_ids ?? ''));
        }

        $categoryIds = $CategorySub->pluck('category_id')->unique();
        $Category = Category::whereIn('id', $categoryIds)->where('status', 1)->select('id', 'main_category_id', 'category_name')->get();

        $mainCategoryIds = $Category->pluck('main_category_id')->unique();
        $CategoryMain = CategoryMain::whereIn('id', $mainCategoryIds)->where('status', 1)->select('id', 'category_main_name')->get();

        return view('layout.vendor.specification_groups.edit', compact('group', 'CategoryMain', 'Category', 'CategorySub', 'vendorSelectedSubIds'));
    }

    public function update(Request $request, $id)
    {
        $group = SpecificationGroup::findOrFail($id);
        $login_id = session()->get('login_id');

        if ($group->created_by === 'Vendor' && $group->created_byid != $login_id) {
            return redirect()->route('specification_groups.index')->with('error', 'Unauthorized access.');
        }

        $validated=$request->validate([
            'specification_group_name' => 'required|string|max:255',
            'specification_group_refname' => 'required|string|max:255',
            'specification_values' => 'nullable|string|max:255',
            'sub_category_ids_csv' => 'nullable|string',
            'status' => 'nullable|string|max:255',
            'created_by' => 'nullable|string|max:255',
            'created_byid' => 'nullable|integer',
        ]);

        $selectedSubCategoryIds = [];
        if ($request->filled('sub_category_ids_csv')) {
            $selectedSubCategoryIds = explode(',', (string) $request->sub_category_ids_csv);
        }
        $selectedSubCategoryIds = array_values(array_unique(array_filter($selectedSubCategoryIds)));

        if ($group->created_by === 'Admin') {
            $vendorcreate = vendorcreate::select('sub_category_ids')->where('id', $login_id)->first();
            $vendorSubCategoryIds = ($vendorcreate && $vendorcreate->sub_category_ids) ? explode(',', $vendorcreate->sub_category_ids) : [];
            
            foreach ($vendorSubCategoryIds as $subId) {
                $mapping = DB::table('sub_category_mapping')->where('sub_category_id', $subId)->where('vendor_id', $login_id)->first();
                if (!$mapping) {
                    $adminMapping = DB::table('sub_category_mapping')->where('sub_category_id', $subId)->whereNull('vendor_id')->first();
                    $attrs = $adminMapping ? json_decode($adminMapping->category_sub_attribute_ids, true) : [];
                    $specs = $adminMapping ? json_decode($adminMapping->category_sub_specification_ids, true) : [];
                    if (!is_array($attrs)) $attrs = [];
                    if (!is_array($specs)) $specs = [];
                    
                    $globalSpecs = SpecificationGroup::whereRaw("FIND_IN_SET(?, sub_category_ids)", [$subId])->pluck('id')->toArray();
                    $specs = array_unique(array_merge($specs, $globalSpecs));
                } else {
                    $attrs = json_decode($mapping->category_sub_attribute_ids, true);
                    if (!is_array($attrs)) $attrs = [];
                    $specs = json_decode($mapping->category_sub_specification_ids, true);
                    if (!is_array($specs)) $specs = [];
                }
                
                $specs = array_map('intval', $specs);
                
                if (in_array($subId, $selectedSubCategoryIds)) {
                    if (!in_array($id, $specs)) {
                        $specs[] = $id;
                    }
                } else {
                    $specs = array_values(array_diff($specs, [$id]));
                }
                
                DB::table('sub_category_mapping')->updateOrInsert(
                    ['sub_category_id' => $subId, 'vendor_id' => $login_id],
                    [
                        'category_sub_attribute_ids' => json_encode($attrs),
                        'category_sub_specification_ids' => json_encode($specs),
                        'updated_at' => now(),
                    ]
                );
            }

            return redirect()->route('specification_groups.index')->with('success', 'Specification Category mapping updated specifically for your profile.');
        }

        $validated['sub_category_ids'] = !empty($selectedSubCategoryIds) ? implode(',', $selectedSubCategoryIds) : '';
        $group->update($validated);

        return redirect()->route('specification_groups.index')->with('success', 'Specification Group updated successfully.');
    }
    public function update_specification(Request $request)
    {
        $id = $request->id;
        $group = SpecificationGroup::findOrFail($id);
        if ($group->created_by !== 'Vendor' || $group->created_byid != session()->get('login_id')) {
            return redirect()->route('specification_groups.index')->with('error', 'Unauthorized access.');
        }
        $group->update([
            'specification_values' => json_encode($request->value)
        ]);

        return redirect()->route('specification_groups.index')->with('success', 'Specification updated successfully.');
    }
    public function destroy($id)
    {
        $group = SpecificationGroup::findOrFail($id);
        if ($group->created_by !== 'Vendor' || $group->created_byid != session()->get('login_id')) {
            return redirect()->route('specification_groups.index')->with('error', 'Unauthorized access.');
        }
        $group->delete();

        return redirect()->route('specification_groups.index')->with('success', 'Specification Group deleted successfully.');
    }
}
