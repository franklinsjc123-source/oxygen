<?php

namespace App\Http\Controllers;

use App\Models\State;
use Illuminate\Http\Request;

class StateController extends Controller
{
    // Display all states
    public function index()
    {
        $states = State::all(); // Fetch all states
        return view('layout.admin.states.index', compact('states'));
    }

    // Show the form to create a new state
    public function create()
    {
        return view('layout.admin.states.create');
    }

    // Store a newly created state in the database
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'state_name' => 'required|string|max:255',
            'status' => 'required|in:Active,Inactive',
        ]);

        // Create the state record
        $state = State::create([
            'state_name' => $request->state_name,
            'status' => $request->status,
        ]);

        return response()->json(['message' => 'State added successfully!', 'state' => $state]);
    }

    // Show the form to edit an existing state
    public function edit(State $state)
    {
        return view('layout.admin.states.create', compact('state'));
    }

    // Update an existing state
    public function update(Request $request, State $state)
    {
        // Validate the request data
        $request->validate([
            'state_name' => 'required|string|max:255',
            'status' => 'required|in:Active,Inactive',
        ]);

        // Update the state record
		$state = State::findOrFail($request->state_id);
        $state->update([
            'state_name' => $request->state_name,
            'status' => $request->status,
        ]);

        return response()->json(['message' => 'State updated successfully!', 'state' => $state]);
    }

    // Delete a state
    public function destroy(State $state)
    {
        $state->delete();
        
		 return redirect()->route('states.index')->with('success', 'State Deleted  successfully');
    }
}
