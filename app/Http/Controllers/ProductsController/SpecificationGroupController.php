<?php

namespace App\Http\Controllers\ProductsController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Master\Specification\SpecificationGroup;
use App\Models\Category\CategorySub;
use App\Models\Category\Category;
use App\Models\Category\CategoryMain;
use App\Models\Vendor;
use DB;
use Session;

class SpecificationGroupController extends Controller
{
    public function index()
    {
        $groups = SpecificationGroup::leftJoin('vendor_details', function ($join) {
                $join->on('specification_group.created_byid', '=', 'vendor_details.id')
                     ->where('specification_group.created_by', '=', 'Vendor');
            })
            ->select('specification_group.*', 'vendor_details.shop_name as vendor_name')
            ->orderBy('specification_group.id', 'desc')
            ->get();
        return view('layout.admin.specification_groups.index', compact('groups'));
    }

    public function create()
    {
        $CategoryMain = CategoryMain::where('status', 1)->select('id', 'category_main_name')->get();
        $Category = Category::where('status', 1)->select('id', 'main_category_id', 'category_name')->get();
        $CategorySub = DB::table('category_sub as t1')
            ->join('category as t2', 't1.category_id', '=', 't2.id')
            ->join('category_main as t3', 't1.category_main_id', '=', 't3.id')
            ->select('t1.id', 't1.category_main_id', 't1.category_id', 't1.category_sub_name', 't2.category_name', 't3.category_main_name')
            ->where('t1.status', 1)
            ->get();
        $Vendors = Vendor::select('id', 'shop_name')->get();
        return view('layout.admin.specification_groups.create', compact('CategoryMain', 'Category', 'CategorySub', 'Vendors'));
    }

    public function store(Request $request)
    {
        $login_id = session()->get('login_id');
        $validated = $request->validate([
            'specification_group_name' => 'required|string|max:255',
            'specification_group_refname' => 'required|string|max:255',
            'specification_values' => 'nullable|string|max:255',
            'sub_category_ids_csv' => 'nullable|string',
            'vendor_ids' => 'nullable|array',
            'status' => 'nullable|string|max:255',
            'created_by' => 'nullable|string|max:255',
            'created_byid' => 'nullable|integer',
        ]);

        $selectedSubCategoryIds = [];
        if ($request->filled('sub_category_ids_csv')) {
            $selectedSubCategoryIds = explode(',', (string) $request->sub_category_ids_csv);
        }
        $selectedSubCategoryIds = array_values(array_unique(array_filter($selectedSubCategoryIds)));
        
        $data = [
            'specification_group_name' => $validated['specification_group_name'],
            'specification_group_refname' => $validated['specification_group_refname'],
            'specification_values' => "",
            'sub_category_ids' => !empty($selectedSubCategoryIds) ? implode(',', $selectedSubCategoryIds) : '',
            'vendor_ids' => $request->has('vendor_ids') ? implode(',', $request->vendor_ids) : '',
            'status' => $validated['status'] ?? 1,
            'created_by' => "Admin",
            'created_byid' => $login_id,
        ];

        SpecificationGroup::create($data);

        return redirect()->route('specification_groups.admin.index')->with('success', 'Specification Group created successfully.');
    }

    public function edit($id)
    {
        $group = SpecificationGroup::findOrFail($id);
        $CategoryMain = CategoryMain::where('status', 1)->select('id', 'category_main_name')->get();
        $Category = Category::where('status', 1)->select('id', 'main_category_id', 'category_name')->get();
        $CategorySub = DB::table('category_sub as t1')
            ->join('category as t2', 't1.category_id', '=', 't2.id')
            ->join('category_main as t3', 't1.category_main_id', '=', 't3.id')
            ->select('t1.id', 't1.category_main_id', 't1.category_id', 't1.category_sub_name', 't2.category_name', 't3.category_main_name')
            ->where('t1.status', 1)
            ->get();
        $Vendors = Vendor::select('id', 'shop_name')->get();
        return view('layout.admin.specification_groups.edit', compact('group', 'CategoryMain', 'Category', 'CategorySub', 'Vendors'));
    }

    public function update(Request $request, $id)
    {
        $login_id = session()->get('login_id');
        $validated = $request->validate([
            'specification_group_name' => 'required|string|max:255',
            'specification_group_refname' => 'required|string|max:255',
            'specification_values' => 'nullable|string|max:255',
            'sub_category_ids_csv' => 'nullable|string',
            'vendor_ids' => 'nullable|array',
            'status' => 'nullable|string|max:255',
            'created_by' => 'nullable|string|max:255',
            'created_byid' => 'nullable|integer',
        ]);

        $selectedSubCategoryIds = [];
        if ($request->filled('sub_category_ids_csv')) {
            $selectedSubCategoryIds = explode(',', (string) $request->sub_category_ids_csv);
        }
        $selectedSubCategoryIds = array_values(array_unique(array_filter($selectedSubCategoryIds)));

        $group = SpecificationGroup::findOrFail($id);
        $data = [
            'specification_group_name' => $validated['specification_group_name'],
            'specification_group_refname' => $validated['specification_group_refname'],
            'sub_category_ids' => !empty($selectedSubCategoryIds) ? implode(',', $selectedSubCategoryIds) : '',
            'vendor_ids' => $request->has('vendor_ids') ? implode(',', $request->vendor_ids) : '',
            'status' => $validated['status'] ?? 1,
            'created_by' => "Admin",
            'created_byid' => $login_id,
        ];
        $group->update($data);

        return redirect()->route('specification_groups.admin.index')->with('success', 'Specification Group updated successfully.');
    }
    public function update_specification(Request $request)
    {
        $id=  $request->id;
        $login_id = session()->get('login_id');
        $values = is_array($request->value) ? array_values(array_filter(array_map('trim', $request->value), function($val) {
            return $val !== '';
        })) : [];
        $validated['specification_values'] = json_encode($values);
        $validated['created_by'] = "Admin";
        $validated['created_byid'] = $login_id;
        $group = SpecificationGroup::findOrFail($id);
        $group->update( $validated);

        return redirect()->route('specification_groups.admin.index')->with('success', 'Specification updated successfully.');
    }
    public function destroy($id)
    {
        $group = SpecificationGroup::findOrFail($id);
        $group->delete();

        return redirect()->route('specification_groups.admin.index')->with('success', 'Specification Group deleted successfully.');
    }

    public function statusUpdate(Request $request)
    {
        $group = SpecificationGroup::find($request->id);
        if ($group) {
            $group->status = $request->status;
            $group->save();
            return response()->json(['success' => true, 'message' => 'Status updated successfully.']);
        }
        return response()->json(['success' => false, 'message' => 'Specification Group not found.'], 404);
    }
}
