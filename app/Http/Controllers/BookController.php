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

        $book = Book::create([
            'title' => $request->title,
            'author' => $request->author,
            'publisher' => $request->publisher,
            'year' => $request->year,
            'status' => $request->status,
            'description' => $request->description,
            'thumbnail' => $cover_path . $cover_name,
            'file_url' => $file_path . $file_name,
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

        $book->update($data);
        $book->subcategory()->sync($request->input('category', []));

        return redirect()->route('book.index')->with('success', 'Buku berhasil diperbarui');
    }

    public function destroy(Book $book)
    {
        if ($book->loans()->where('status', '!=', 'expired')->exists()) {
            return redirect()->route('book.index')->with('error', 'Buku sedang dipinjam');
        } else {
            File::delete($book->thumbnail);
            File::delete(storage_path('app/private/' . $book->file_url));
            $book->delete();
            return redirect()->route('book.index')->with('success', 'Buku berhasil dihapus');
        }
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
