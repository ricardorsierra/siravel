<?php

namespace Sitec\Siravel\Middleware;

use Closure;
use Sitec\Siravel\Services\AnalyticsService;

class SiravelAnalytics
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!$request->ajax()) {
            app(AnalyticsService::class)->log($request);
        }

        return $next($request);
    }
}
