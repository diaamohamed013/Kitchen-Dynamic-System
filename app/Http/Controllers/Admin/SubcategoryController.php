<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Section;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SubcategoryController extends Controller
{
    public function index()
    {
        $subcategories = Subcategory::with('section')->withCount('products')->orderBy('display_order')->get();
        $sections = Section::where('is_active', true)->get();
        return view('admin.subcategories.index', compact('subcategories', 'sections'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'section_id' => 'required|exists:sections,id',
            'name' => 'required|string|max:100',
            'display_order' => 'integer|min:0',
        ]);
        $data['slug'] = Str::slug($data['name']) . '-' . rand(10, 99);
        $data['is_active'] = $request->has('is_active');

        Subcategory::create($data);
        return redirect()->route('admin.subcategories.index')->with('success', 'تم إنشاء التصنيف الفرعي بنجاح');
    }

    public function update(Request $request, Subcategory $subcategory)
    {
        $data = $request->validate([
            'section_id' => 'required|exists:sections,id',
            'name' => 'required|string|max:100',
            'display_order' => 'integer|min:0',
        ]);
        $data['is_active'] = $request->has('is_active');

        $subcategory->update($data);
        return redirect()->route('admin.subcategories.index')->with('success', 'تم تحديث التصنيف الفرعي بنجاح');
    }

    public function destroy(Subcategory $subcategory)
    {
        $subcategory->delete();
        return redirect()->route('admin.subcategories.index')->with('success', 'تم حذف التصنيف الفرعي بنجاح');
    }
}
