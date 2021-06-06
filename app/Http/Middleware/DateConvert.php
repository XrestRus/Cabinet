<?php


namespace App\Http\Middleware;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Closure;
use Illuminate\Http\Request;

class DateConvert
{
    public function handle(Request $request, Closure $next)
    {
        if (!$request->date) {
             $request->date =  date('Y-m');
        }

        if (is_string($request->date)) {
            $date = explode('-', $request->date);
            $request->date = $date;
        }
        return $next($request);
    }
}
