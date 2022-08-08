<?php

namespace App\Http\Controllers\Api;

use App\Events\ResetPassword;
use App\Http\Controllers\Controller;
use App\Models\SessionUser;
use App\Models\User;
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
            $user = Auth::user();
            $token = $user->createToken('Test')->accessToken;
            return response()->json($token, 200);

            // $checkToken = SessionUser::where('user_id', Auth::id())->first();
            // if(empty($checkToken)){
            //     $userSession = SessionUser::create([
            //         'token' => Str::random(40),
            //         'refresh_token' => Str::random(40),
            //         'refresh_token_expried' => date('Y-m-d H:i:s', strtotime('+20 day', time())),
            //         'user_id' => Auth::id()
            //     ]);
            // }else{
            //     $userSession = $checkToken;
            // }
            // return response()->json([
            //     'code' => 200,
            //     'userSession' => $userSession,
            //     'userId' => Auth::id()
            // ], 200);
        }else{
            return response()->json([
                'code' => 211,
                'messageError' => 'Email hoặc password sai'
            ], 211);
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
