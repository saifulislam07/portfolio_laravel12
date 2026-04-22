<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Setting;
use Illuminate\Support\Facades\Auth;

class CheckMaintenance
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Skip maintenance check for admin routes or logged in users
        if ($request->is('admin*') || $request->is('backdoor*') || Auth::check()) {
            return $next($request);
        }

        $is_maintenance = Setting::where('key', 'is_maintenance')->first()?->value ?? '0';

        if ($is_maintenance == '1') {
            abort(503);
        }

        return $next($request);
    }
}
