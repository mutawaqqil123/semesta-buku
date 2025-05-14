<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use Illuminate\Http\Request;

class RateController extends Controller
{
    public function index()
    {
        $rates= Rating::with('user')->get();

        return view('admin.rate.index', compact('rates'));
    }

    public function destroy(Rating $rating)
    {
        // dd($rating);
        $rating->delete();

        return redirect()->back()->with('success', 'Rating telah dihapus');
    }
}
