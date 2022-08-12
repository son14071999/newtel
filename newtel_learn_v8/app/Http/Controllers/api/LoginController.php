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
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Token;
use App\Models\Permit;
use App\Models\Role;
use Laravel\Passport\Client as OClient;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $oClient = OClient::where('password_client', 1)->first();
        if (!Auth::attempt($request->only(['email', 'password']))) {
            return response()->json('Lỗi đăng nhập', 401);
        } else {
            $user = $request->user();
            $scopoes = [];
            if($user['role_id']){
                $scopoes = Role::getCodePermits($user['role_id']);
            }
            $token = $user->createToken('demo Oauth', $scopoes)->accessToken;
            return response()->json($token, 200);
        }
    }

    public function logout(Request $request)
    {
        if ($sesstion = SessionUser::where('token', $request->header('token'))) {
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

    public function forgotPassword(Request $request)
    {
        if (
            $request->email
            && ($user = User::where('email', $request->email)->first())
        ) {
            $hashRandom = Str::random(250);
            $user->update([
                'hash' => $hashRandom
            ]);
            event(new ResetPassword($user));
            return response()->json('Success', 200);
        }
        return response()->json('Email không hợp lệ', 304);
    }


    public function updatePasswrord(Request $request)
    {
        if (($hash = $request->input('hash'))
            && ($user = User::where('hash', $hash)->first())
            && ($password = $request->password)
            && ($passwordConfirm = $request->passwordConfirm)
            && $password == $passwordConfirm
        ) {
            $user->update([
                'password' => bcrypt($password),
                'hash' => null
            ]);
            return response()->json('Thay đổi mật khẩu thành công', 200);
        }
        return response()->json('Dữ liệu không hợp lệ', 304);
    }
}
