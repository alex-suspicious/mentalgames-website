<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

class locales
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (session()->has('locale')) {
            App::setLocale(session()->get('locale'));
        }else{
            $locale = $request->server('HTTP_ACCEPT_LANGUAGE');
            $locale = explode("-",explode(",",$locale)[0])[0];

            if (! in_array($locale, ['en', 'ru','kz','jp','cn']))
                $locale = "en";

            session()->put('locale',$locale);
            App::setLocale($locale);
        }

        App::setLocale("ru");


        return $next($request);
    }
}
