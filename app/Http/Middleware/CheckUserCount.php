<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckUserCount
{
    public function handle($request, Closure $next)
    {
        $userCount = User::count();
        if ($userCount > 0) {
            return redirect('/error');
        }
        return $next($request);
    }
}
