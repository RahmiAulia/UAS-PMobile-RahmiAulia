<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;


class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Periksa apakah pengguna adalah admin
        // if (Auth::check()) {
        //     $user = Auth::user();
        //     if ($user->isAdmin === 1) {
        //         // Pengguna adalah admin, lanjutkan dengan middleware berikutnya
        //         return $next($request);
        //     }
        // }

        // // Daftar rute yang tidak boleh diakses oleh pengguna biasa
        // $restrictedRoutes = ['kategori-produk.store', 'kategori-produk.create', 'produk.store', 'produk.create', 'kategori-pembayaran.store'];

        // // Periksa apakah rute saat ini termasuk dalam daftar rute yang tidak diinginkan
        // if (in_array($request->route()->getName(), $restrictedRoutes)) {
        //     // Tampilkan halaman 404 (Page Not Found)
        //     return response()->view('errors.404', [], 404);
        // }

        // // Jika rute bukan termasuk dalam rute yang tidak diinginkan, lanjutkan dengan middleware berikutnya
        // return $next($request);

        if (Auth()->user()->isAdmin !== true) {
            abort(403, 'Unauthorized action.');
        }
        return $next($request);
    }
}
