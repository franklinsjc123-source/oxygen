<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\State;
use Illuminate\Http\Request;

class CityController extends Controller {
    
    // Display the list of cities
    public function index() {
        $cities = City::with('state')->get(); // Load cities with state details
        $states = State::all(); // Get all states for dropdown
        return view('layout.admin.cities.index', compact('cities', 'states'));
    }

    // Store a new city
    public function store(Request $request) {
        $request->validate([
            'city_name' => 'required|string|max:255',
            'state_id' => 'required|exists:statelist,id',
            'status' => 'required|in:Active,Inactive',
        ]);

        $city = City::create([
            'city_name' => $request->city_name,
            'state_id' => $request->state_id,
            'status' => $request->status,
        ]);

        return response()->json(['message' => 'City added successfully!', 'city' => $city]);
    }

    // Edit City (AJAX loads data, so this is not used in the modal)
    public function edit(City $city) {
        return response()->json($city);
    }

    // Update an existing city
    public function update(Request $request, City $city) {
        $request->validate([
            'city_name' => 'required|string|max:255',
            'state_id' => 'required|exists:statelist,id',
            'status' => 'required|in:Active,Inactive',
        ]);
		$city = City::findOrFail($request->city_id);
        $city->update([
            'city_name' => $request->city_name,
            'state_id' => $request->state_id,
            'status' => $request->status,
        ]);

        return response()->json(['message' => 'City updated successfully!', 'city' => $city]);
    }

    // Delete a city
    public function destroy(City $city) {
        $city->delete();
        return redirect()->route('cities.index')->with('success', 'City Deleted  successfully');
		//return response()->json(['message' => 'City deleted successfully!']);
    }
}
