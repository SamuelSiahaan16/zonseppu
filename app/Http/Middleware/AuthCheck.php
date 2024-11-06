<?php

namespace App\Http\Middleware;

use Closure;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        // Cek apakah pengguna sudah login
        if (Auth::check()) {
            $user = Auth::user();

            // Cek apakah waktu login terakhir (updated_at) kurang dari 10 jam
            $lastUpdate = Carbon::parse($user->last_update);
            $currentTime = Carbon::now();

            if ($currentTime->diffInHours($lastUpdate) <= 10) {
                // Waktu sesi kurang dari 10 jam, lanjutkan ke permintaan berikutnya
                return $next($request);
            } else {
                // Waktu sesi lebih dari 10 jam, paksa logout dan arahkan ke halaman login
                Auth::logout();
                return redirect()->route('login')->with('error', 'Sesi Anda telah berakhir. Silakan login kembali.');
            }
        }

        // Jika pengguna tidak login, arahkan ke halaman login dengan pesan error
        return redirect()->route('login')->with('error', 'Anda Belum Login. Silakan login');
    }
}