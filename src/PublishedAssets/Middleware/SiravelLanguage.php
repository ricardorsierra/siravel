<?php

namespace App\Http\Middleware;

use Closure;
use Config;

class SiravelLanguage
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
        if (session('language')!==null) {
            Config::set('app.locale', session('language'));
        }
        /**
         * if(!Session::has('locale'))
        {
        Session::put('locale', $request->getPreferredLanguage($this->languages));
        }

        app()->setLocale(Session::get('locale'));

        if(!Session::has('statut'))
        {
        Session::put('statut', Auth::check() ?  Auth::user()->role->slug : 'visitor');
        }

         */

        return $next($request);
    }
}
