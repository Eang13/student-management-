<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminOnly
{
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->user()?->role !== 'admin') {
            return redirect()->route('students.index')
                ->with('error', 'You do not have permission to do that. View only.');
        }

        return $next($request);
    }
}
