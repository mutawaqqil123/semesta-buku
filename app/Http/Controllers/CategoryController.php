<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\CategoryRequest as Request;
use Illuminate\Support\Facades\File;

class CategoryController extends Controller
{
    public function index()
    {
        $data = [
            'categories' => Category::with('subcategory')->get()
        ];
        return view('admin.category.category-index', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'icon' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ],[
            'name.required' => 'Nama kategori harus diisi',
            'icon.required' => 'Ikon kategori harus diunggah',
            'icon.image' => 'File yang diunggah harus berupa gambar',
            'icon.mimes' => 'Gambar harus berformat jpeg, png, jpg, gif, atau svg',
            'icon.max' => 'Ukuran gambar maksimal 2MB'
        ]);

        $icon = $request->file('icon');
        $icon_name = time() . '.' . $icon->getClientOriginalExtension();
        $path = 'images/category';
        $icon->move($path, $icon_name);

        Category::create([
            'name' => $request->name,
            'icon' => $path . '/' . $icon_name
        ]);

        return redirect()->back()->with('success', 'Kategori berhasil ditambahkan');
    }

    public function show(Category $category)
    {
        //
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ],[
            'name.required' => 'Nama kategori harus diisi',
            'icon.image' => 'File yang diunggah harus berupa gambar',
            'icon.mimes' => 'Gambar harus berformat jpeg, png, jpg, gif, atau svg',
            'icon.max' => 'Ukuran gambar maksimal 2MB'
        ]);

        $path = 'images/category';
        if($request->hasFile('icon')){
            $icon = $request->file('icon');
            $icon_name = time() . '.' . $icon->getClientOriginalExtension();

            File::delete($category->icon);
            $icon->move($path, $icon_name);
        }else{
            $icon_name = $category->icon;
        }

        $category->update([
            'name' => $request->name,
            'icon' => $path . '/' . $icon_name
        ]);

        return redirect()->back()->with('success', 'Kategori berhasil diubah');
    }

    public function destroy(Category $category)
    {
        if ($category->subcategory()->count() > 0) {
            return redirect()->back()->with('error', 'Kategori tidak bisa dihapus karena memiliki subkategori');
        } else {
            File::delete($category->icon);
            $category->delete();
            return redirect()->back()->with('success', 'Kategori berhasil dihapus');
        }
    }
}
