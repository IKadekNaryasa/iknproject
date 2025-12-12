<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Google2FAMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        if ($user && $user->google2fa_enabled && !session('google2fa_passed')) {
            return redirect()->route('2fa.verify');
        }

        return $next($request);
    }
}
