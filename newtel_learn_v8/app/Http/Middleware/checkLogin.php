<?php

namespace App\Http\Middleware;

use App\Models\SessionUser;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;


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
        $token = JWTAuth::getToken();
        if($token) {
            try{
                if(JWTAuth::parseToken()->authenticate()){
                    $exp = '';
                    if(($exp = intval(JWTAuth::decode($token)['exp']))
                        && $exp >= intval(\Carbon\Carbon::now('Asia/Ho_Chi_Minh')->timestamp)){
                            return response()->json([
                                'user1' => JWTAuth::toUser($token),
                                'exp' => $exp,
                                'decode' => JWTAuth::decode($token), 
                                'now' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh')->timestamp,
                                'date1' => date('Y/m/d H:s:i', 1660153537),
                                'date2' => date('Y/m/d H:s:i', \Carbon\Carbon::now('Asia/Ho_Chi_Minh')->timestamp)
                            ]);
                    }else{
                        return response()->json([
                            'messageError' => 'Token hết hạn',
                            'exp' => $exp,
                            'now' => \Carbon\Carbon::now('Asia/Ho_Chi_Minh')->timestamp
                        ], 401);
                    }
                }
            }catch(JWTException $err){
                return response()->json(['messageError' => 'Token ko hợp lệ'], 401);
            }
        }else{
            return response()->json(['messageError' => 'Token rỗng'], 401);
        }
    }
}
