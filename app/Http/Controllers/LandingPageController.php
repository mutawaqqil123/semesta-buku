<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function index()
    {
        $data = [
            'this_month' => Book::where('status', 'available')->withCount('subcategory')
                ->orderBy('subcategory_count', 'desc')
                ->get(),
            'release' => Book::where('status', 'available')->latest()->get()
        ];
        return view('landing.home', $data);
    }

    public function produk(Request $request)
    {
        $search = $request->input('s');
        $query = Book::query();

        if ($search) {
            $query->whereHas('subcategory', function ($q) use ($search) {
                $q->where('sub_name', 'like', '%' . $search . '%');
            });
        }

        $data = [
            'books' => $query->paginate(12)->withQueryString()
        ];

        return view('landing.produk.produk-index', $data);
    }

    public function produkDetail(Book $book)
    {
        $data = [
            'book' => $book->load(['subcategory.category']),
            'this_month' => Book::where('status', 'available')->latest()
                ->take(4)
                ->get()
        ];
        return view('landing.produk.produk-single', $data);
    }

    public function bookView(Book $book)
    {
        return view('landing.produk.produk-view', compact('book'));
    }

    public function faq()
    {
        return view('landing.other.faq');
    }

    public function kontak()
    {
        return view('landing.other.kontak');
    }
}
