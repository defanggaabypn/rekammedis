<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Olah_rekmed
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            $role = Auth::user()->role;
            if ($role == 'dokter' or $role == 'perawat' or $role == 'superadmin') {
                return $next($request);
            } else {
                return abort(403);
            }
        } else {
            return redirect('login');
        }
    }
}
