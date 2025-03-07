<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubCategory;
use App\Http\Requests\SubCategoryRequest as Request;

class SubCategoryController extends Controller
{
    public function index(Category $category)
    {
        $data = [
            'category' => $category->load('subcategory.books'),
        ];

        return view('admin.category.sub-category.sub-category-index', $data);
    }

    public function store(Request $request, Category $category)
    {
        $category->subcategory()->create([
            'sub_name' => $request->sub_name,
        ]);

        return redirect()->back()->with('success', 'Sub kategori berhasil ditambahkan.');
    }

    public function update(Request $request, SubCategory $subCategory)
    {
        $subCategory->update([
            'sub_name' => $request->sub_name,
        ]);

        return redirect()->back()->with('success', 'Sub kategori berhasil diperbarui.');
    }

    public function destroy(SubCategory $subCategory)
    {
        if ($subCategory->books->count() > 0) {
            return redirect()->back()->with('error', 'Sub kategori tidak bisa dihapus karena memiliki buku.');
        } else{
            $subCategory->delete();

            return redirect()->back()->with('success', 'Sub kategori berhasil dihapus.');
        }
    }
}
