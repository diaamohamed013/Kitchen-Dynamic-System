<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('subcategory.section')->latest()->get();
        $subcategories = Subcategory::where('is_active', true)->get();
        return view('admin.products.index', compact('products', 'subcategories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'subcategory_id' => 'required|exists:subcategories,id',
            'name' => 'required|string|max:150',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|url',
        ]);
        $data['slug'] = Str::slug($data['name']) . '-' . rand(10, 99);
        $data['is_available'] = $request->has('is_available');
        $data['is_best_seller'] = $request->has('is_best_seller');
        if (empty($data['image'])) {
            $data['image'] = 'https://images.unsplash.com/photo-1546069901-ba9599a7e63c?w=600&auto=format&fit=crop&q=80';
        }

        Product::create($data);
        return redirect()->route('admin.products.index')->with('success', 'تمت إضافة المنتج بنجاح');
    }

    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'subcategory_id' => 'required|exists:subcategories,id',
            'name' => 'required|string|max:150',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|url',
        ]);
        $data['is_available'] = $request->has('is_available');
        $data['is_best_seller'] = $request->has('is_best_seller');

        $product->update($data);
        return redirect()->route('admin.products.index')->with('success', 'تم تعديل المنتج بنجاح');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'تم حذف المنتج بنجاح');
    }
}
