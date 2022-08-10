<?php

namespace App\Http\Controllers\Api;

use App\Events\ResetPassword;
use App\Http\Controllers\Controller;
use App\Models\SessionUser;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use JWTAuth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $dataCheckLogin = [
            'email' => $request->email,
            'password' => $request->password,
        ];
        $token = '';
        if($token = JWTAuth::attempt($$request->only('email', 'password'))){
            return response()->json($token, 200);
        }
        //     return response()->json([
        //         'code' => 211,
        //         'messageError' => 'Email hoặc password sai'
        //     ], 211);
        // }
        // if(Auth::attempt($dataCheckLogin)){
        //     $user = Auth::user();
        //     $token = $user->createToken('Token Name')->accessToken;
        //     return response()->json([
        //         'email' => $request->email,
        //         'password' => $request->password,
        //         'token' => $token,
        //         'user' => $user,
        //         // 'test' => Auth::user()->token->hasExpired()
        //     ], 200);
        //     // return response()->json($token, 200);
        // }else{
        //     return response()->json([
        //         'code' => 211,
        //         'messageError' => 'Email hoặc password sai'
        //     ], 211);
        // }
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
         ], 304);
    }

    public function forgotPassword(Request $request) {
        if($request->email 
        && ($user = User::where('email', $request->email)->first())){
            $hashRandom = Str::random(250);
            $user->update([
                'hash' => $hashRandom
            ]);
            event(new ResetPassword($user));
            return response()->json('Success', 200);
        }
        return response()->json('Email không hợp lệ', 304);
    }


    public function updatePasswrord(Request $request){
        if(($hash = $request->input('hash'))
            && ($user = User::where('hash', $hash)->first())
            && ($password = $request->password)
            && ($passwordConfirm = $request->passwordConfirm)
            && $password == $passwordConfirm){
                $user->update([
                    'password' => bcrypt($password),
                    'hash' => null
                ]);
                return response()->json('Thay đổi mật khẩu thành công', 200);
        }
        return response()->json('Dữ liệu không hợp lệ', 304);
    }
}
