<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'name' => 'required',
            'description' => 'required',
            // Add other validation rules for product fields
        ]);

        // Create a new product using the validated data
        $product = Product::create($validatedData);

        // Redirect to the index page or show a success message
        return redirect()->route('products.index')->with('success', 'Product created successfully');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'name' => 'required',
            'description' => 'required',
            // Add other validation rules for product fields
        ]);

        $product = Product::findOrFail($id);

        // Update the product using the validated data
        $product->update($validatedData);

        // Redirect to the index page or show a success message
        return redirect()->route('products.index')->with('success', 'Product updated successfully');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        // Redirect to the index page or show a success message
        return redirect()->route('products.index')->with('success', 'Product deleted successfully');
    }
}
