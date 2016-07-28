<?php

namespace App\Http\Middleware;

use Closure;
use Carbon\Carbon;
class LocaleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        /**
         * Locale is enabled and allowed to be changed
         */
        if(config('locale.status')){
            if(session()->has('locale') && in_array(session()->get('locale'), array_keys(config('locale.languages')))){
                /**
                 *Set the Laravel locale
                 */
                app()->setLocale(session()->get('locale'));

                /**
                 *Set locale for PHP
                 */
                setlocale(LC_TIME, config('locale.languages')[session()->get('locale')][1]);

                /**
                 *setLocale to use Carbon source locales
                 */
                Carbon::setLocale(config('locale.languages')[session()->get('locale')][0]);
            }
        }
        return $next($request);
    }
}
