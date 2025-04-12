<?php

namespace App\Http\Middleware;

// use Closure;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;

// class CheckSubscription
// {
//     public function handle(Request $request, Closure $next)
//     {
//         $user = Auth::user();

//         if (!$user || !$user->subscription()->where('status', 'active')->exists()) {
//             return redirect()->route('subscribe.index');
//         }

//         return $next($request);
//     }
// }

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Book;

class CheckSubscription
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        // Coba ambil dari route parameter 'book' (route model binding)
        $book = $request->route('book');

        // Kalau ga dapet, coba cari dari 'filename'
        if (!$book && $request->route('filename')) {
            $book = Book::where('filename', $request->route('filename'))->first();
        }

        // Kalau buku ada dan access_type-nya 'premium', wajib punya subscription aktif
        if ($book && $book->access_type === 'premium') {
            if (!$user || !$user->subscription()->where('status', 'active')->exists()) {
                // Kalau request dari JS (expect JSON), balikin 403
                // if ($request->expectsJson()) {
                //     return response()->json(['message' => 'Akses khusus pengguna premium.'], 403);
                // }

                // Kalau dari browser biasa, redirect
                return redirect()->route('subscribe.index');
            }
        }

        return $next($request);
    }
}
