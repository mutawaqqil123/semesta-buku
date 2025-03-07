<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'jumlahBuku' => Book::count(),
            'bukuTerbaru' => Book::latest()->take(5)->get(),
            'jumlahUser' => User::whereHas('roles', function($query) {
                $query->where('name', 'user');
            })->count(),
            'subs' => Subscription::get(),
        ];
        return view('admin.dashboard', $data);
    }
}
