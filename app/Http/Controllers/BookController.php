<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Http\Requests\BookRequest as Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class BookController extends Controller
{
    public function index()
    {
        $data = [
            'books' => Book::latest()->get(),
        ];
        return view('admin.book.book-index', $data);
    }

    public function create()
    {
        $data = [
            'categories' => Category::with('subcategory')->get(),
        ];

        return view('admin.book.book-create', $data);
    }

    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'publisher' => 'required|string|max:255',
            'year' => 'required|integer|min:1900|max:' . date('Y'),
            'status' => 'required|in:available,unavailable',
            'description' => 'nullable|string',
            'cover' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'category' => 'required|array',
        ], [
            'title.required' => 'Judul buku harus diisi',
            'author.required' => 'Penulis buku harus diisi',
            'publisher.required' => 'Penerbit buku harus diisi',
            'year.required' => 'Tahun terbit buku harus diisi',
            'status.required' => 'Status buku harus dipilih',
            'cover.required' => 'Cover buku harus diunggah',
            'cover.image' => 'File cover harus berupa gambar',
            'cover.mimes' => 'Cover harus berformat jpeg, png, jpg, gif, atau svg',
            'cover.max' => 'Ukuran cover maksimal 2MB',
            'file.required' => 'File buku harus diunggah',
            'category.required' => 'Kategori buku harus dipilih',
        ]);

        // dd($request->all());
        if ($request->hasFile('cover')) {
            $cover = $request->file('cover');
            $cover_path = 'images/book/';
            $cover_name = time() . 'cover.' . $cover->getClientOriginalExtension();
            $cover->move($cover_path, $cover_name);
        }

        $file = $request->file('file');
        $file_path = 'files/book/';
        $file_name = time() . 'file.' . $file->getClientOriginalExtension();
        $file->storeAs($file_path, $file_name, 'local');

        $premium = $request->input('premium', false);
        if ($premium) {
            $access_type = 'premium';
        } else {
            $access_type = 'free';
        }

        $book = Book::create([
            'title' => $request->title,
            'author' => $request->author,
            'publisher' => $request->publisher,
            'year' => $request->year,
            'status' => $request->status,
            'description' => $request->description,
            'thumbnail' => $cover_path . $cover_name,
            'file_url' => $file_path . $file_name,
            'access_type' => $access_type,
        ]);

        // $book->subcategory()->sync($request->input('category', []));
        foreach ($request->input('category', []) as $get) {
            DB::table('book_category')->insert([
                'book_id' => $book->token_book,
                'sub_category_id' => $get,
            ]);
        }

        return redirect()->route('book.index')->with('success', 'Buku berhasil ditambahkan');
    }

    public function publish(Book $book)
    {
        if (isset($_GET['publisher'])) {
            $book->update([
                'status' => 'available',
            ]);
            return redirect()->route('book.index')->with('success', 'Buku berhasil dipublikasikan');
        } else {
            $book->update([
                'status' => 'unavailable',
            ]);
            return redirect()->route('book.index')->with('success', 'Buku berhasil diunpublikasikan');
        }
    }
    public function premium(Book $book)
    {
        if (isset($_GET['premiumer'])) {
            $book->update([
                'access_type' => 'premium',
            ]);
            return redirect()->route('book.index')->with('success', 'Buku berhasil di gratiskan');
        } else {
            $book->update([
                'access_type' => 'free',
            ]);
            return redirect()->route('book.index')->with('success', 'Buku berhasil di premiumkan');
        }
    }

    public function show(Book $book)
    {
        //
    }

    public function edit(Book $book)
    {
        $data = [
            'book' => $book->load('subcategory'),
            'categories' => Category::with('subcategory')->get(),
        ];

        return view('admin.book.book-edit', $data);
    }

    public function update(Request $request, Book $book)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'publisher' => 'required|string|max:255',
            'year' => 'required|integer|min:1900|max:' . date('Y'),
            'status' => 'required|in:available,unavailable',
            'description' => 'nullable|string',
            'cover' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'file' => 'nullable|file|mimes:pdf|max:20480', // 20MB
            'category' => 'required|array',
        ], [
            'title.required' => 'Judul buku harus diisi',
            'author.required' => 'Penulis buku harus diisi',
            'publisher.required' => 'Penerbit buku harus diisi',
            'year.required' => 'Tahun terbit buku harus diisi',
            'status.required' => 'Status buku harus dipilih',
            'cover.image' => 'File cover harus berupa gambar',
            'cover.mimes' => 'Cover harus berformat jpeg, png, jpg, gif, atau svg',
            'cover.max' => 'Ukuran cover maksimal 2MB',
            'file.mimes' => 'File buku harus berformat PDF',
            'file.max' => 'Ukuran file buku maksimal 20MB',
            'category.required' => 'Kategori buku harus dipilih',
        ]);

        $data = $request->only(['title', 'author', 'publisher', 'year', 'status', 'description']);

        if ($request->hasFile('cover')) {
            File::delete($book->thumbnail);
            $cover = $request->file('cover');
            $cover_path = 'images/book/';
            $cover_name = time() . 'cover.' . $cover->getClientOriginalExtension();
            $cover->move($cover_path, $cover_name);
            $data['thumbnail'] = $cover_path . $cover_name;
        }

        if ($request->hasFile('file')) {
            File::delete(storage_path('app/public/' . $book->file_url));
            $file = $request->file('file');
            $file_path = 'files/book/';
            $file_name = time() . 'file.' . $file->getClientOriginalExtension();
            $file->storeAs($file_path, $file_name, 'local');
            $data['file_url'] = $file_path . $file_name;
        }

        $premium = $request->input('premium', false);
        if ($premium) {
            $data['access_type'] = 'premium';
        } else {
            $data['access_type'] = 'free';
        }

        $book->update($data);
        $book->subcategory()->sync($request->input('category', []));

        return redirect()->route('book.index')->with('success', 'Buku berhasil diperbarui');
    }

    public function destroy(Book $book)
    {
        File::delete($book->thumbnail);
        File::delete(storage_path('app/private/' . $book->file_url));
        $book->delete();
        return redirect()->route('book.index')->with('success', 'Buku berhasil dihapus');
    }

    public function viewBook($filename): Response
    {
        $path = storage_path('app/private/files/book/' . $filename);

        if (!file_exists($path)) {
            abort(404);
        }

        return response()->file($path, [
            'Content-Type' => 'application/pdf',
            'Cache-Control' => 'no-store, no-cache, must-revalidate, max-age=0',
            'Pragma' => 'no-cache',
            'Expires' => '0',
        ]);
    }
}
