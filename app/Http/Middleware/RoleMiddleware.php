<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        $user = Auth::user();

        // Jika role user tidak termasuk dalam role yang diizinkan
        if (!in_array($user->role, $roles)) {
            session()->flash('error', 'Anda tidak memiliki izin untuk mengakses halaman ini.');
            return redirect()->route('dashboard');
        }
        // dd('middleware jalan', Auth::check(), session()->all());
        return $next($request);
    }
    
}