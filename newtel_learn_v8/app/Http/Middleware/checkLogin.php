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
        if(JWTAuth::parseToken()->authenticate()){
            $exp = '';
            if(($exp = intval(JWTAuth::decode($token)['exp']))
            && $exp >= intval(\Carbon\Carbon::now('Asia/Ho_Chi_Minh')->timestamp)){
                return response()->json([
                    'token' => $token,
                    'decode' => JWTAuth::decode($token), 
                    'refresh' => JWTAuth::refresh($token),
                ]);
            }else{
                return response()->json([
                    'messageError' => 'Token hết hạn',
                    'exp' => $exp,
                ], 211);
            }
        }
        if($token) {
            try{
                if(JWTAuth::parseToken()->authenticate()){
                    $exp = '';
                    if(($exp = intval(JWTAuth::decode($token)['exp']))
                    && $exp >= intval(\Carbon\Carbon::now('Asia/Ho_Chi_Minh')->timestamp)){
                        return response()->json([
                            'decode' => JWTAuth::decode($token), 
                            // 'refresh' => JWTAuth::refresh($token)
                        ]);
                    }else{
                        return response()->json([
                            'messageError' => 'Token hết hạn',
                            'exp' => $exp,
                        ], 211);
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
