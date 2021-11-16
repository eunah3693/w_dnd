<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class BeforeMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        /*$test_ip = array(
            '1.209.147.154' //dev
            ,'118.131.148.14'   //guwifi
            ,'127.0.0.1'
            ,'::1'
        );
        if(!in_array($request->ip(),$test_ip)){
            abort(403);
	}*/
    //print_r($_SERVER['HTTP_HOST']);die();
    $host = array(
	'dev.dndlifecare.com',
	'www.dndlifecare.com',
	'dndlifecare.com',
	'localhost',
	'localhost:81',
	'localhost:8000'
    );
    if(isset($_SERVER['HTTP_HOST']) && !in_array($_SERVER['HTTP_HOST'] ,$host))
    {
        abort(403);
    }
        return $next($request);
    }
}
