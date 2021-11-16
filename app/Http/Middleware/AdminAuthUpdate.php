<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;

class AdminAuthUpdate
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
        $user = User::where('idx', $request->session()->get('idx'))->where('access_db','like','%update%')->first();

        if($request->session()->get('is_admin') === true && $user)
        {

            return $next($request);
        }
        else
        {
            return response()->json([
                'msg' => '권한이없습니다.',
                'status' => 200,
            ], 200);
        }
    }
}
