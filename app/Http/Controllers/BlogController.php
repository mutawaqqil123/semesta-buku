<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::with('category')->latest()->get();
        return view('admin.blog.blog-index', compact('blogs'));
    }

    public function create()
    {
        $categories = BlogCategory::all();
        return view('admin.blog.blog-create', compact('categories'));
    }

    private function generateSlug($title)
    {
        // Ubah ke huruf kecil semua
        $slug = strtolower($title);

        // Hapus semua karakter selain huruf, angka, spasi, dan tanda minus
        $slug = preg_replace('/[^a-z0-9\s-]/', '', $slug);

        // Ganti spasi atau banyak minus jadi satu minus
        $slug = preg_replace('/[\s-]+/', '-', $slug);

        // Hilangkan minus di awal/akhir (kalau ada)
        $slug = trim($slug, '-');

        return $slug;
    }

    public function store(Request $request)
    {
        $token = Str::random(16);

        $file = $request->file('thumbnail');
        $file_name = now()->format('Y-m-d')."-thumbnail.".$file->getClientOriginalExtension();
        $path = 'blog/thumbnail/';
        $file->move($path, $file_name);

        $data = [
            'token_blog' => $token,
            'title' => $request->title,
            'slug' => $this->generateSlug($request->title),
            'thumbnail' => $path . $file_name,
            'content' => $request->content,
            // 'blog_category_id' => $request->blog_category_id,
            'user_id' => Auth::user()->id
        ];

        Blog::create($data);

        return redirect()->route('blogs.index')->with('success', 'Bog Berhasil Ditambahkan');
    }

    public function show(Blog $blog)
    {
        //
    }

    public function edit(Blog $blog)
    {
        $categories = BlogCategory::all();
        return view('admin.blog.blog-edit', compact('categories', 'blog'));
    }

    public function update(Request $request, Blog $blog)
    {
        $token = Str::random(16);

        if($request->hasFile('thumbnail')){
            if ($blog->thumbnail && file_exists(public_path($blog->thumbnail))) {
            unlink($blog->thumbnail);
            }

            $file = $request->file('thumbnail');
            $file_name = now()->format('Y-m-d')."-thumbnail.".$file->getClientOriginalExtension();
            $path = 'blog/thumbnail/';
            $file->move($path, $file_name);


            $thumbnail = $path . $file_name;
        } else {
            $thumbnail = $blog->thumbnail;
        }

        $data = [
            'token_blog' => $token,
            'title' => $request->title,
            'slug' => $this->generateSlug($request->title),
            'thumbnail' => $thumbnail,
            'content' => $request->content,
            // 'blog_category_id' => $request->blog_category_id,
            'user_id' => Auth::user()->id
        ];

        $blog->update($data);

        return redirect()->route('blogs.index')->with('success', 'Bog Berhasil Diedit');
    }

    public function destroy(Blog $blog)
    {
        if ($blog->thumbnail && file_exists(public_path($blog->thumbnail))) {
            unlink($blog->thumbnail);
        }

        $blog->delete();
        return redirect()->back()->with('success', 'Blog Berhasil Dihapus');
    }

    public function upload(Request $request)
    {
        if ($request->hasFile('upload')) {

            $token = Str::random(12);

            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $token . '.' . $extension;

            $request->file('upload')->move(public_path('media'), $fileName);

            $url = asset('media/' . $fileName);
            return response()->json(['fileName' => $fileName, 'uploaded' => 1, 'url' => $url]);
        }
    }
}
