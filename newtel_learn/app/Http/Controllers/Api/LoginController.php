<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SessionUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $dataCheckLogin = [
            'email' => $request->email,
            'password' => $request->password,
        ];
        if(Auth::attempt($dataCheckLogin)){
            $checkToken = SessionUser::where('user_id', Auth::id())->first();
            if(empty($checkToken)){
                $userSession = SessionUser::create([
                    'token' => Str::random(40),
                    'refresh_token' => Str::random(40),
                    'refresh_token_expried' => date('Y-m-d H:i:s', strtotime('+20 day', time())),
                    'user_id' => Auth::id()
                ]);
            }else{
                $userSession = $checkToken;
            }
            return response()->json([
                'code' => 200,
                'userSession' => $userSession,
                'userId' => Auth::id()
            ], 200);
        }else{
            return response()->json([
                'code' => 405,
                'messageError' => 'Email hoặc password sai'
            ], 405);
        }
    }

    public function logout(Request $request){
         if($sesstion=SessionUser::where('token', $request->header('token'))){
            $sesstion->delete();
            return response()->json([
                'status' => 'Success',
                'message' => 'Xoá thành công'
            ], 200);
         }
         return response()->json([
            'status' => 'Fail',
            'message' => 'Session không hợp lệ',
            ''
         ], 304);
    }
}
