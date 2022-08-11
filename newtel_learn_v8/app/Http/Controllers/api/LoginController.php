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
use Tymon\JWTAuth\Exceptions\JWTException;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $dataLogin = $request->only('email', 'password');
        $token = '';
        $time = \Carbon\Carbon::now('Asia/Ho_Chi_Minh')->addDays(3)->timestamp;
      try {
          if (! $token = JWTAuth::attempt($dataLogin , ['exp1' => $time] )
          ) {
              return response()->json(['messageError' => 'Email hoặc mật khẩu sai'], 400);
          }
      } catch (JWTException $e) {
          return response()->json(['messageError' => 'Không thể tạo token'], 500);
      }
      return response()->json([
        'token' => $token,
        'expire' => date('Y/m/d H:s:i', $time),
        'int' => $time
      ], 200);
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
