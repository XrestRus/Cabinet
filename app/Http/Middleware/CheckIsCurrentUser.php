<?php

namespace App\Http\Middleware;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Closure;
use Illuminate\Http\Request;

class CheckIsCurrentUser
{
    public function handle(Request $request, Closure $next)
    {
        $serverUser = Auth::user();
        $user = $request->user->id ?? $request->id;

        if ($serverUser->id != $user && !$serverUser->isAdmin()) {
            return redirect()->back();
        }

        return $next($request);
    }
}
