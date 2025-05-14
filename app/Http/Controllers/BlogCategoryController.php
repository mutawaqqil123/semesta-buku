<?php

namespace App\Http\Controllers;

use App\Models\BlogCategory;
use Illuminate\Http\Request;

class BlogCategoryController extends Controller
{
    public function index()
    {
        $categories = BlogCategory::with('blogs')->get();
        return view('admin.blog.category.index', compact('categories'));
    }

    public function store(Request $request)
    {
        BlogCategory::create([
            'name' => $request->name,
        ]);

        return redirect()->back()->with('success', 'Kategori berhasil ditambahkan');
    }

    public function update(Request $request, BlogCategory $blogCategory)
    {
        $blogCategory->update([
            'name' => $request->name,
        ]);

        return redirect()->back()->with('success', 'Kategori berhasil diubah');
    }

    public function destroy(BlogCategory $blogCategory)
    {
        if ($blogCategory->blogs()->count() > 0) {
            return redirect()->back()->with('error', 'Kategori tidak dapat dihapus karena memiliki blog yang terkait');
        }

        $blogCategory->delete();

        return redirect()->back()->with('success', 'Kategori berhasil dihapus');
    }
}
