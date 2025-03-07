<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckSubscription
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        if (!$user || !$user->subscription()->where('status', 'active')->exists()) {
            return redirect()->route('subscribe.index');
        }

        return $next($request);
    }
}
