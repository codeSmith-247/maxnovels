<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use Cache;

class UserActivity
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(Auth::check()) {
            $expires = now()->addMinutes(2);
            Cache::put('user-' . auth()->user()->id, true, $expires);
            User::where('id', auth()->user()->id)->update(['last_seen' =>now()]);
        }
        return $next($request);
    }
}
