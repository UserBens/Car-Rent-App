<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserAkses
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        $userRole = auth()->user()->role;

        // Jika peran pengguna tidak sesuai dengan peran yang diizinkan pada middleware
        if ($userRole != $role) {
            
            // Jika pengguna adalah admin tetapi mencoba mengakses bagian client
            if ($userRole === 'admin' && $request->path() === 'dashboard/client') {
                return redirect('/dashboard/admin');
            }

            // Jika pengguna adalah client tetapi mencoba mengakses bagian admin
            if ($userRole === 'client' && $request->path() !== 'dashboard/client') {
                return redirect('/dashboard/client');
            }
        }
        
        // Jika peran pengguna sesuai dengan peran yang diizinkan pada middleware
        return $next($request);
    }
}
