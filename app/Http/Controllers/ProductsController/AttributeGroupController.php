<?php

namespace App\Http\Controllers\ProductsController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Master\Attribute\AttributeGroup;
use App\Models\Category\CategorySub;
use App\Models\Category\Category;
use App\Models\Category\CategoryMain;
use DB;
use Session;

class AttributeGroupController extends Controller
{
    public function index()
    {
        $groups = AttributeGroup::all();
        return view('layout.admin.attribute_groups.index', compact('groups'));
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
        return view('layout.admin.attribute_groups.create', compact('CategoryMain', 'Category', 'CategorySub'));
    }

    public function store(Request $request)
    {
        $login_id = session()->get('login_id');
        $validated = $request->validate([
            'attribute_group_name' => 'required|string|max:255',
            'attribute_group_refname' => 'required|string|max:255',
            'attribute_values' => 'nullable|string|max:255',
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
        
        $data = [
            'attribute_group_name' => $validated['attribute_group_name'],
            'attribute_group_refname' => $validated['attribute_group_refname'],
            'attribute_values' => "",
            'sub_category_ids' => !empty($selectedSubCategoryIds) ? implode(',', $selectedSubCategoryIds) : '',
            'status' => $validated['status'] ?? 1,
            'created_by' => "Admin",
            'created_byid' => $login_id,
        ];

        AttributeGroup::create($data);

        return redirect()->route('attribute_groups.index')->with('success', 'Attribute Group created successfully.');
    }

    public function edit($id)
    {
        $group = AttributeGroup::findOrFail($id);
        $CategoryMain = CategoryMain::where('status', 1)->select('id', 'category_main_name')->get();
        $Category = Category::where('status', 1)->select('id', 'main_category_id', 'category_name')->get();
        $CategorySub = DB::table('category_sub as t1')
            ->join('category as t2', 't1.category_id', '=', 't2.id')
            ->join('category_main as t3', 't1.category_main_id', '=', 't3.id')
            ->select('t1.id', 't1.category_main_id', 't1.category_id', 't1.category_sub_name', 't2.category_name', 't3.category_main_name')
            ->where('t1.status', 1)
            ->get();
        return view('layout.admin.attribute_groups.edit', compact('group', 'CategoryMain', 'Category', 'CategorySub'));
    }

    public function update(Request $request, $id)
    {
        $login_id = session()->get('login_id');
        $validated = $request->validate([
            'attribute_group_name' => 'required|string|max:255',
            'attribute_group_refname' => 'required|string|max:255',
            'attribute_values' => 'nullable|string|max:255',
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

        $group = AttributeGroup::findOrFail($id);
        $data = [
            'attribute_group_name' => $validated['attribute_group_name'],
            'attribute_group_refname' => $validated['attribute_group_refname'],
            'sub_category_ids' => !empty($selectedSubCategoryIds) ? implode(',', $selectedSubCategoryIds) : '',
            'status' => $validated['status'] ?? 1,
            'created_by' => "Admin",
            'created_byid' => $login_id,
        ];
        $group->update($data);

        return redirect()->route('attribute_groups.index')->with('success', 'Attribute Group updated successfully.');
    }
    public function update_attributes(Request $request)
    {
        $id=  $request->id;
        $login_id = session()->get('login_id');
        $validated['attribute_values'] = json_encode($request->value);
        $validated['created_by'] = "Admin";
        $validated['created_byid'] = $login_id;
        $group = AttributeGroup::findOrFail($id);
        $group->update( $validated);

        return redirect()->route('attribute_groups.index')->with('success', 'Attributes updated successfully.');
    }
    public function destroy($id)
    {
        $group = AttributeGroup::findOrFail($id);
        $group->delete();

        return redirect()->route('attribute_groups.index')->with('success', 'Attribute Group deleted successfully.');
    }
}
