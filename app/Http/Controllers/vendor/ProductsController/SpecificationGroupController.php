<?php

namespace App\Http\Controllers\vendor\ProductsController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Master\Specification\SpecificationGroup;
use SESSION;
class SpecificationGroupController extends Controller
{
    public function index()
    {
        $login_id = session()->get('login_id');
        $groups = SpecificationGroup::where('created_byid',$login_id)->where('created_by','Vendor')->get();
       // dd($groups);
        return view('layout.vendor.specification_groups.index', compact('groups'));
    }

    public function create()
    {
        return view('layout.vendor.specification_groups.create');
    }

    public function store(Request $request)
    {
        $login_id = session()->get('login_id');
        $validated=$request->validate([
            'specification_group_name' => 'required|string|max:255',
            'specification_group_refname' => 'required|string|max:255',
            'specification_values' => 'nullable|string|max:255',
            'status' => 'nullable|string|max:255',
            'created_by' => 'nullable|string|max:255',
            'created_byid' => 'nullable|integer',
        ]);
        $validated['specification_values'] = "";
        $validated['created_by'] = "Vendor";
        $validated['created_byid'] = $login_id;
        SpecificationGroup::create($validated);;

        return redirect()->route('specification_groups.index')->with('success', 'Specification Group created successfully.');
    }

    public function edit($id)
    {
        $group = SpecificationGroup::findOrFail($id);
        return view('layout.vendor.specification_groups.edit', compact('group'));
    }

    public function update(Request $request, $id)
    {
        $login_id = session()->get('login_id');
        $validated=$request->validate([
            'specification_group_name' => 'required|string|max:255',
            'specification_group_refname' => 'required|string|max:255',
            'specification_values' => 'nullable|string|max:255',
            'status' => 'nullable|string|max:255',
            'created_by' => 'nullable|string|max:255',
            'created_byid' => 'nullable|integer',
        ]);
        $validated['created_by'] = "Vendor";
        $validated['created_byid'] = $login_id;
        $group = SpecificationGroup::findOrFail($id);
        $group->update( $validated);

        return redirect()->route('specification_groups.index')->with('success', 'Specification Group updated successfully.');
    }
    public function update_specification(Request $request)
    {
        $id=  $request->id;
        $login_id = session()->get('login_id');
        $validated['specification_values'] = json_encode($request->value);
        $validated['created_by'] = "Vendor";
        $validated['created_byid'] = $login_id;
        $group = SpecificationGroup::findOrFail($id);
        $group->update( $validated);

        return redirect()->route('specification_groups.index')->with('success', 'Specification updated successfully.');
    }
    public function destroy($id)
    {
        $group = SpecificationGroup::findOrFail($id);
        $group->delete();

        return redirect()->route('specification_groups.index')->with('success', 'Specification Group deleted successfully.');
    }
}
