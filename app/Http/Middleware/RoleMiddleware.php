<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Spatie\Permission\Models\Role;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        if (Auth::guest()) {
            return redirect('/login');
        }

        $roleObj = Role::whereIn('name',explode('|',$role))->get();

        if (! $request->user()->hasAnyRole($roleObj)) {
            abort(403);
        }

        return $next($request);;
    }
}
