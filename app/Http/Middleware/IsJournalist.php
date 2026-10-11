<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsJournalist
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check()) {
            return redirect('/login')->with('error', 'Необходима авторизация');
        }

        if (auth()->user()->role->name !== 'journalist' && auth()->user()->role->name !== 'admin') {
            return redirect('/')->with('error', 'Доступ запрещён');
        }

        return $next($request);
    }
}
