<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GiaSuMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->vai_tro === 'gia_su') {
            return $next($request);
        }

        return redirect()->route('trang_chu')->withErrors(['loi' => 'Ban khong co quyen truy cap!']);
    }
}
