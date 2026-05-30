<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleOwner
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // 1. Cek apakah user sudah login DAN apakah rolenya adalah 'owner'
        if (auth()->check() && auth()->user()->role === 'owner') {
            // Jika beneran owner, silakan masuk ke halaman yang dituju
            return $next($request);
        }

        // 2. Jika BUKAN owner, tendang balik ke dashboard umum/pencari dengan pesan error
        return redirect()->route('dashboard')->with('error', 'Akses ditolak! Halaman ini khusus untuk Owner Pemilik Kos.');
    }
}