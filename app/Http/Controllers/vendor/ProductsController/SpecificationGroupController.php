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
        $groups = SpecificationGroup::where('created_byid', $login_id)->where('created_by', 'Vendor')->get();
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
        if ($group->created_by !== 'Vendor' || $group->created_byid != session()->get('login_id')) {
            return redirect()->route('specification_groups.index')->with('error', 'Unauthorized access.');
        }
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

        return view('layout.vendor.specification_groups.edit', compact('group', 'CategoryMain', 'Category', 'CategorySub'));
    }

    public function update(Request $request, $id)
    {
        $group = SpecificationGroup::findOrFail($id);
        if ($group->created_by !== 'Vendor' || $group->created_byid != session()->get('login_id')) {
            return redirect()->route('specification_groups.index')->with('error', 'Unauthorized access.');
        }
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

        $validated['sub_category_ids'] = !empty($selectedSubCategoryIds) ? implode(',', $selectedSubCategoryIds) : '';
        $validated['created_by'] = "Vendor";
        $validated['created_byid'] = $login_id;
        $group = SpecificationGroup::findOrFail($id);
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
