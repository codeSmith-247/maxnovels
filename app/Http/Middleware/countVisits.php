<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Visits;

class countVisits
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
        $visit_count = Visits::where('ip', $request->ip())->whereDate('created_at', Carbon::today())->count();
        if($visit_count <= 0) {
            Visits::create([
                'ip' => $request->ip(),
                'time' => now()
            ]);
        }
        return $next($request);
    }
}
