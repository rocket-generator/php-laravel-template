<?php

namespace App\Http\Middleware;

use App\Http\Resources\Api\Status;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$permissions): Response
    {
        $user = auth()->user();
        if ($user && empty(array_diff($permissions, $user->permissions))) {
            return $next($request);
        }
        return Status::error('You do not have permission to access this page.', 403)->toResponse($request);
    }
}
