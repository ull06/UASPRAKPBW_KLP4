<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RolePencari
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // 1. Cek apakah user sudah login DAN apakah rolenya adalah 'pencari'
        if (auth()->check() && auth()->user()->role === 'pencari') {
            // Jika beneran pencari kos, silakan lolos
            return $next($request);
        }

        // 2. Jika seorang Owner iseng masuk ke halaman pencari, tendang ke dashboard owner
        return redirect()->route('owner.dashboard')->with('error', 'Akses ditolak! Halaman ini khusus untuk Pencari Kos.');
    }
}