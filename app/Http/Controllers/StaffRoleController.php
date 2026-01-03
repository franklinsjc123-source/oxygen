<?php

namespace App\Http\Controllers;

namespace App\Http\Controllers;

use App\Models\Departments;
use App\Models\designation\designation;
use App\Models\Mainmenus;
use App\Models\Submenus;
use App\Models\StaffRole;
use Illuminate\Http\Request;
use DB;

class StaffRoleController extends Controller
{
    public function index()
    {
        $role = DB::table('staff_roles')
              ->join('departments', 'staff_roles.department', '=', 'departments.id')
              ->join('designation', 'staff_roles.designation', '=', 'designation.id')
              ->select('staff_roles.*', 'departments.name as department_name', 'designation.designation as designation_name')
              ->get();
        
        return view('layout.admin.staffrole.index', compact('role'));
    }
    public function create()
    {
        $departments = Departments::all();
        $designations = Designation::all();
        $mainmenus = Mainmenus::where('id', '!=', 1)->get();
        
        $submenus = Submenus::all(); // Get all submenus
        return view('layout.admin.staffrole.create', compact('departments', 'designations', 'mainmenus', 'submenus'));
    }
    
    public function store(Request $request)
{
    // Validate the form input
    $request->validate([
        'department' => 'required',
        'designation' => 'required',
        'mainmenus' => 'required|array',
        'submenus' => 'required|array',
    ]);

    // Insert into the staff_roles table
    StaffRole::create([
        'department' => $request->department,
        'designation' => $request->designation,
        'mainmenus' => implode(',', $request->mainmenus), // Convert array to comma-separated string
        'submenus' => implode(',', $request->submenus),  // Convert array to comma-separated string
        'status' => 'active', // Set default or provide this in the form
    ]);

    return redirect()->route('staffrole.index')->with('success', 'Staff role created successfully!');
}
public function edit($id)
    {
        $role = StaffRole::find($id);
        $departments = Departments::all();
        $designations = Designation::where('department', '=', $role->department)->get();
        $mainmenus = Mainmenus::where('id', '!=', 1)->get();
        $submenus = Submenus::all(); // Get all submenus
        
        return view('layout.admin.staffrole.create', compact('role', 'departments', 'designations', 'mainmenus', 'submenus'));
    }

public function update(Request $request, $id)
{
    // Validate the form input
    $request->validate([
        'department' => 'required',
        'designation' => 'required',
        'mainmenus' => 'required|array',
        'submenus' => 'required|array',
    ]);

    // Update staff role
    $role = StaffRole::find($id);
    $role->update([
        'department' => $request->department,
        'designation' => $request->designation,
        'mainmenus' => implode(',', $request->mainmenus), // Convert array to comma-separated string
        'submenus' => implode(',', $request->submenus),  // Convert array to comma-separated string
    ]);

    return redirect()->route('staffrole.index')->with('success', 'Staff role updated successfully!');
}
public function destroy($id)
    {
        $role = StaffRole::find($id);
        $role->delete();
        return redirect()->route('staffrole.index')->with('success', 'Staff role Deleted successfully!');
}

}