<?php

namespace App\Http\Middleware;

use Closure;
use Spatie\Permission\Traits\HasRoles;
class Admin
{
    use HasRoles;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if($request->user() && $request->user()->hasRole('Admin')){
            return $next($request);
        }
        else {
            return redirect('/unauthorized');
        }

    }
}
