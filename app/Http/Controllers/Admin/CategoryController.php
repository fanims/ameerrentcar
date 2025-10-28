<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::latest()->get();
        return view('admin.category.index', compact('categories'));
    }

    public function create()
    {
        $users = User::all();
        return view('admin.category.create', compact('users'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name_en' => 'required|string',
            'name_ar' => 'required|string',
            // other fields...
        ]);

        Category::create([
            'name' => [
                'en' => $validated['name_en'],
                'ar' => $validated['name_ar'],
            ],
            'created_by' => $request->created_by,
            'is_active' => $request->is_active,
        ]);

        return redirect()->route('category.index')->with('success', 'Category created successfully.');
    }

    public function edit(Category $category)
    {
        $users = User::all();
        return view('admin.category.edit', compact('category', 'users'));
    }

    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name_en' => 'required|string',
            'name_ar' => 'required|string',
            'created_by' => 'required|exists:users,id',
            'is_active' => 'required|boolean',
        ]);

        $category->update([
            'name' => [
                'en' => $validated['name_en'],
                'ar' => $validated['name_ar'],
            ],
            'created_by' => $request->created_by,
            'is_active' => $request->is_active,
        ]);

        return redirect()->route('category.index')->with('success', 'Category updated successfully.');
    }


    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('category.index')->with('success', 'History deleted successfully.');
    }
}
