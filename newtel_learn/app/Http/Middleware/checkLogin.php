<?php

namespace App\Http\Middleware;

use App\Models\SessionUser;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class checkLogin
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
        // if(Auth::check()){
            // return $next($request);
        // }
        $token = $request->header('token');
        $userId = $request->header('userId');
        if(!empty($token) && !empty($userId) 
        && ($session = SessionUser::where('token', $request->header('token'))->first())
        && (intval($userId) == intval($session->user_id))
        ){
            return $next($request);
        }
        return response()->json([
            'message' => 'Error11',
            'token' => $request->header('token'),
            'userId' => $request->header('userId') ,
            'check1' => SessionUser::where('token', $request->header('token'))->first(),
        ], 401);
    }
}
