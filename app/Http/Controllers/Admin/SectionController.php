<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SectionController extends Controller
{
    public function index()
    {
        $sections = Section::withCount(['subcategories', 'products'])->orderBy('display_order')->get();
        return view('admin.sections.index', compact('sections'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:100',
            'icon' => 'nullable|string|max:50',
            'display_order' => 'integer|min:0',
        ]);
        $data['slug'] = Str::slug($data['name']) . '-' . rand(10, 99);
        $data['is_active'] = $request->has('is_active');

        Section::create($data);
        return redirect()->route('admin.sections.index')->with('success', 'تم إنشاء القسم بنجاح');
    }

    public function update(Request $request, Section $section)
    {
        $data = $request->validate([
            'name' => 'required|string|max:100',
            'icon' => 'nullable|string|max:50',
            'display_order' => 'integer|min:0',
        ]);
        $data['is_active'] = $request->has('is_active');

        $section->update($data);
        return redirect()->route('admin.sections.index')->with('success', 'تم تحديث بيانات القسم بنجاح');
    }

    public function destroy(Section $section)
    {
        $section->delete();
        return redirect()->route('admin.sections.index')->with('success', 'تم حذف القسم بنجاح');
    }
}
