<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Enums\Role;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next,...$roles): Response
   
    {
         if (!Auth::check()) {
             return redirect('/login');
         }

        $user = Auth::user();
        $userRole = is_object($user->role) ? $user->role->value : $user->role;
        \Log::info('User Role: ' . $userRole . ' | Path: ' . $request->path());
  


        if (!in_array($userRole, $roles)) {
            abort(403, 'Unauthorized');
        }

        return $next($request);
    }
}
