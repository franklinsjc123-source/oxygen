<?php

namespace App\Http\Controllers\ProductsController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Master\Attribute\AttributeGroup;
use SESSION;
class AttributeGroupController extends Controller
{
    public function index()
    {
        $groups = AttributeGroup::all();
        return view('layout.admin.attribute_groups.index', compact('groups'));
    }

    public function create()
    {
        return view('layout.admin.attribute_groups.create');
    }

    public function store(Request $request)
    {
        $login_id = session()->get('login_id');
        $validated=$request->validate([
            'attribute_group_name' => 'required|string|max:255',
            'attribute_group_refname' => 'required|string|max:255',
            'attribute_values' => 'nullable|string|max:255',
            'status' => 'nullable|string|max:255',
            'created_by' => 'nullable|string|max:255',
            'created_byid' => 'nullable|integer',
        ]);
        $validated['attribute_values'] = "";
        $validated['created_by'] = "Admin";
        $validated['created_byid'] = $login_id;
        AttributeGroup::create($validated);;

        return redirect()->route('attribute_groups.index')->with('success', 'Attribute Group created successfully.');
    }

    public function edit($id)
    {
        $group = AttributeGroup::findOrFail($id);
        return view('layout.admin.attribute_groups.edit', compact('group'));
    }

    public function update(Request $request, $id)
    {
        $login_id = session()->get('login_id');
        $validated=$request->validate([
            'attribute_group_name' => 'required|string|max:255',
            'attribute_group_refname' => 'required|string|max:255',
            'attribute_values' => 'nullable|string|max:255',
            'status' => 'nullable|string|max:255',
            'created_by' => 'nullable|string|max:255',
            'created_byid' => 'nullable|integer',
        ]);
        $validated['created_by'] = "Admin";
        $validated['created_byid'] = $login_id;
        $group = AttributeGroup::findOrFail($id);
        $group->update( $validated);

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
