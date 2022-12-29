<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RemoveArabicAndNoneEnglishNumbers
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next)
    {
        $temp = [] ;
        if ( isset($request->request) ){

            foreach ($request->request as $key => $value){
                $temp[$key] = arabicToPersian( remove_arabic_persian_numbers($value) );
            }
            $request->merge($temp);
        }
        return $next($request);
    }
}
