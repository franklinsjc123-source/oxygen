<?php

namespace App\Http\Controllers\vendor\ProductsController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helper\ImageUploadHelper\ImageUploadHelper;
use App\Models\Category\CategorySub;
use App\Models\Category\Category;
use App\Models\Category\CategoryMain;
use App\Models\Master\Attribute\Attribute;
use Illuminate\Support\Facades\DB;
use Flasher\Prime\FlasherInterface;


class AttributeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $category_main_data = CategoryMain::get();
        // $subcategory = CategorySub::get();
        // // $attribute_data = Attribute::get();
        // $attribute = CategorySub::join(
        //     'master_attribute',
        //     'category_sub.id',
        //     '=',
        //     'master_attribute.category_sub_id'
        // )
        //     ->get();

        // return view('layout.vendor.products.attribute-listing')
        //     ->with([
        //         'category_main_data' => $category_main_data,
        //         'subcategory' => $subcategory,
        //         'attribute' => $attribute
        //     ]);
         $login_id = session()->get('login_id');
         
         $groups = \App\Models\Master\Attribute\AttributeGroup::whereIn('created_byid', [$login_id, 1])->get();

        return view('layout.vendor.products.attribute-listing')
            ->with([
                'groups' => $groups
            ]);
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
        return view('layout.vendor.products.attribute_groups_create', compact('CategoryMain', 'Category', 'CategorySub'));
    }

    public function store(Request $request, FlasherInterface $flasher)
    {
        $login_id = session()->get('login_id');
        $validated = $request->validate([
            'attribute_group_name' => 'required|string|max:255',
            'attribute_group_refname' => 'required|string|max:255',
            'attribute_values' => 'nullable|string|max:255',
            'sub_category_ids_csv' => 'nullable|string',
            'status' => 'nullable|string|max:255',
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
            'created_by' => "vendor",
            'created_byid' => $login_id,
        ];

        \App\Models\Master\Attribute\AttributeGroup::create($data);

        $flasher->addSuccess('Attribute Group created successfully.');
        return redirect()->route('vendorattribute.master.index');
    }

    public function edit($id, FlasherInterface $flasher)
    {
        $login_id = session()->get('login_id');
        $group = \App\Models\Master\Attribute\AttributeGroup::findOrFail($id);
        
        $CategoryMain = CategoryMain::where('status', 1)->select('id', 'category_main_name')->get();
        $Category = Category::where('status', 1)->select('id', 'main_category_id', 'category_name')->get();
        $CategorySub = DB::table('category_sub as t1')
            ->join('category as t2', 't1.category_id', '=', 't2.id')
            ->join('category_main as t3', 't1.category_main_id', '=', 't3.id')
            ->select('t1.id', 't1.category_main_id', 't1.category_id', 't1.category_sub_name', 't2.category_name', 't3.category_main_name')
            ->where('t1.status', 1)
            ->get();
            
        $vendorSelectedSubIds = [];
        if ($group->created_byid != $login_id) {
            foreach ($CategorySub as $sub) {
                $subId = $sub->id;
                $mapping = DB::table('sub_category_mapping')->where('sub_category_id', $subId)->where('vendor_id', $login_id)->first();
                if ($mapping) {
                    $attrs = json_decode($mapping->category_sub_attribute_ids, true) ?: [];
                    if (in_array($id, $attrs)) {
                        $vendorSelectedSubIds[] = $subId;
                    }
                } else {
                    $adminMapping = DB::table('sub_category_mapping')->where('sub_category_id', $subId)->whereNull('vendor_id')->first();
                    $adminAttrs = $adminMapping ? (json_decode($adminMapping->category_sub_attribute_ids, true) ?: []) : [];
                    $globalAttrIds = \App\Models\Master\Attribute\AttributeGroup::whereRaw("FIND_IN_SET(?, sub_category_ids)", [$subId])->pluck('id')->toArray();
                    
                    // Since $sub is from raw join, the default attributes could be in category_sub_attributes column
                    $defaultAttributeIds = (!empty($sub->category_sub_attributes))
                        ? array_values(array_filter(array_map('intval', explode(',', $sub->category_sub_attributes))))
                        : [];

                    $mergedAttrs = array_map('intval', array_unique(array_merge($adminAttrs, $globalAttrIds, $defaultAttributeIds)));
                    if (in_array((int)$id, $mergedAttrs)) {
                        $vendorSelectedSubIds[] = $subId;
                    }
                }
            }
        } else {
            $vendorSelectedSubIds = array_filter(explode(',', $group->sub_category_ids ?? ''));
        }
        
        return view('layout.vendor.products.attribute_groups_edit', compact('group', 'CategoryMain', 'Category', 'CategorySub', 'vendorSelectedSubIds'));
    }

    public function update(Request $request, $id, FlasherInterface $flasher)
    {
        $login_id = session()->get('login_id');
        $validated = $request->validate([
            'attribute_group_name' => 'required|string|max:255',
            'attribute_group_refname' => 'required|string|max:255',
            'attribute_values' => 'nullable|string|max:255',
            'sub_category_ids_csv' => 'nullable|string',
            'status' => 'nullable|string|max:255',
        ]);

        $selectedSubCategoryIds = [];
        if ($request->filled('sub_category_ids_csv')) {
            $selectedSubCategoryIds = explode(',', (string) $request->sub_category_ids_csv);
        }
        $selectedSubCategoryIds = array_values(array_unique(array_filter($selectedSubCategoryIds)));

        $group = \App\Models\Master\Attribute\AttributeGroup::findOrFail($id);

        if ($group->created_byid != $login_id) {
            $adminSubCategoryIds = array_filter(explode(',', (string) ($group->sub_category_ids ?? '')));
            
            foreach ($adminSubCategoryIds as $subId) {
                $mapping = DB::table('sub_category_mapping')->where('sub_category_id', $subId)->where('vendor_id', $login_id)->first();
                if (!$mapping) {
                    $adminMapping = DB::table('sub_category_mapping')->where('sub_category_id', $subId)->whereNull('vendor_id')->first();
                    $attrs = $adminMapping ? json_decode($adminMapping->category_sub_attribute_ids, true) : [];
                    $specs = $adminMapping ? json_decode($adminMapping->category_sub_specification_ids, true) : [];
                    if (!is_array($attrs)) $attrs = [];
                    if (!is_array($specs)) $specs = [];
                    
                    $globalAttrs = \App\Models\Master\Attribute\AttributeGroup::whereRaw("FIND_IN_SET(?, sub_category_ids)", [$subId])->pluck('id')->toArray();
                    $attrs = array_unique(array_merge($attrs, $globalAttrs));
                } else {
                    $attrs = json_decode($mapping->category_sub_attribute_ids, true);
                    if (!is_array($attrs)) $attrs = [];
                    $specs = json_decode($mapping->category_sub_specification_ids, true);
                    if (!is_array($specs)) $specs = [];
                }
                
                $attrs = array_map('intval', $attrs);
                
                if (in_array($subId, $selectedSubCategoryIds)) {
                    if (!in_array($id, $attrs)) {
                        $attrs[] = $id;
                    }
                } else {
                    $attrs = array_values(array_diff($attrs, [$id]));
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

            $flasher->addSuccess('Attribute Category mapping updated specifically for your profile.');
            return redirect()->route('vendorattribute.master.index');
        }

        $data = [
            'attribute_group_name' => $validated['attribute_group_name'],
            'attribute_group_refname' => $validated['attribute_group_refname'],
            'sub_category_ids' => !empty($selectedSubCategoryIds) ? implode(',', $selectedSubCategoryIds) : '',
            'status' => $validated['status'] ?? 1,
        ];
        $group->update($data);

        $flasher->addSuccess('Attribute Group updated successfully.');
        return redirect()->route('vendorattribute.master.index');
    }

    public function destroy($id, FlasherInterface $flasher)
    {
        $login_id = session()->get('login_id');
        try {
            $group = \App\Models\Master\Attribute\AttributeGroup::find($id);
            if (!$group) {
                $flasher->addError('Group not found!');
                return redirect()->route('vendorattribute.master.index');
            }
            $group->delete();
            $flasher->addSuccess('Attribute Group Removed!');
            return redirect()->route('vendorattribute.master.index');
        } catch (\Throwable $th) {
            $flasher->addError('Something Error!!');
            return redirect()->route('vendorattribute.master.index');
        }
    }



    public function getAttributes(Request $request)
    {
         $login_id = session()->get('login_id');
       
        $attribute_data = Attribute::where('category_sub_id', $request->sub_category_id)
        ->whereIn('created_byid', [$login_id, 1])
        ->get();
       
        return response()->json($attribute_data);
    }

    public function getSubCategory(Request $request)
    {
         $login_id = session()->get('login_id');
        $attribute_data = Attribute::where('category_sub_id', $request->sub_category_id)
        ->whereIn('created_byid', [$login_id, 1])
        ->get();
        return response()->json($attribute_data);
    }
    
    public function searchdetails(Request $request)
    {
     
        $scate = $request->category_sub;
        $login_id = session()->get('login_id');
        // exit;
        $category_main_data = CategoryMain::get();
        $Category  = Category::get();
        $subcategory = CategorySub::get();
        
         $attribute = DB::table('master_attribute')->leftJoin(
            'category_sub',
            'category_sub.id',
            '=',
            'master_attribute.category_sub_id'
        )
        ->where('category_sub_id', $scate)
        ->whereIn('master_attribute.created_byid', [$login_id, 1])
            ->get();
     
        return view('layout.vendor.products.attribute-listing')
        ->with([
            'category_main_data' => $category_main_data,
            'category'=> $Category,
            'subcategory' => $subcategory,
            'subcategory1' => $subcategory,
            'attribute' => $attribute
        ]);
    }

    public function update_attributevalues(Request $request)
    {
        $id = $request->id;
        $login_id = session()->get('login_id');
        $group = \App\Models\Master\Attribute\AttributeGroup::findOrFail($id);
        
        // Only allow editing if the vendor owns this group
        if ($group->created_byid != $login_id && $group->created_byid != 1) {
            return redirect()->route('vendorattribute.master.index')->with('error', 'Unauthorized access');
        }

        $values = is_array($request->value) ? array_values(array_filter(array_map('trim', $request->value), function($val) {
            return $val !== '';
        })) : [];

        $group->attribute_values = json_encode($values);
        $group->update();

        return redirect()->route('vendorattribute.master.index')->with('success', 'Attributes updated successfully.');
    }
}
