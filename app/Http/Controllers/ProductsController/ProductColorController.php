<?php

namespace App\Http\Controllers\ProductsController;

use App\Models\Master\Colors\ProductColor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class ProductColorController extends Controller
{
    public function index()
    {
        $colors = ProductColor::all();
        return view('layout.admin.product_colors.index', compact('colors'));
    }

    public function create()
    {
        return view('layout.admin.product_colors.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'color_name' => 'required|max:50',
            'color_code' => 'required|max:20',
            'status' => 'required|in:1,0',
        ]);

        ProductColor::create($request->all());
        return redirect()->route('product_colors.index')->with('success', 'Color added successfully.');
    }

    public function edit(ProductColor $productColor)
    {
        return view('layout.admin.product_colors.edit', compact('productColor'));
    }

    public function update(Request $request, ProductColor $productColor)
    {
        $request->validate([
            'color_name' => 'required|max:50',
            'color_code' => 'required|max:20',
            'status' => 'required|in:1,0',
        ]);

        $productColor->update($request->all());
        return redirect()->route('product_colors.index')->with('success', 'Color updated successfully.');
    }

    public function destroy(ProductColor $productColor)
    {
        $productColor->delete();
        return redirect()->route('product_colors.index')->with('success', 'Color deleted successfully.');
    }

}
