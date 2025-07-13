<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with('category')->get();
        return response()->json($products);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Untuk API, biasanya tidak perlu form create
        return response()->json(['message' => 'Form create produk']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:irfan_categories,id',
            'stock' => 'required|integer|min:0',
            'description' => 'nullable|string',
        ]);
        $product = Product::create($validated);
        return response()->json($product->load('category'), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::with('category')->findOrFail($id);
        return response()->json($product);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Untuk API, biasanya tidak perlu form edit
        return response()->json(['message' => 'Form edit produk', 'id' => $id]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:irfan_categories,id',
            'stock' => 'required|integer|min:0',
            'description' => 'nullable|string',
        ]);
        $product = Product::findOrFail($id);
        $product->update($validated);
        return response()->json($product->load('category'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return response()->json(['message' => 'Produk berhasil dihapus']);
    }
}
