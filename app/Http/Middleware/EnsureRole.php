<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureRole
{
    public function handle(Request $request, Closure $next, string $roles): mixed
    {
        if (! Auth::check()) {
            abort(403, 'Unauthorized');
        }

        $allowed = explode('|', $roles);

        if (! in_array(Auth::user()->role, $allowed, true)) {
            abort(403, 'Role tidak diperbolehkan mengakses halaman ini');
        }

        return $next($request);
    }
}
