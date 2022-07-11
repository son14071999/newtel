<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SessionUser;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $dataCheckLogin = [
            'email' => $request->email,
            'password' => $request->password,
        ];
        if(auth()->attempt($dataCheckLogin)){
            $checkToken = SessionUser::where('user_id', auth()->id())->first();
            if(empty($checkToken)){
                $userSession = SessionUser::create([
                    'token' => Str::random(40),
                    'refresh_token' => Str::random(40),
                    'refresh_token_expried' => date('Y-m-d H:i:s', strtotime('+20 day', time())),
                    'user_id' => auth()->id()
                ]);
            }else{
                $userSession = $checkToken;
            }
            return view ('auth.login', compact([
                'code' => 200,
                'data' => $userSession
            ]));
            // return response()->json([
            //     'code' => 200,
            //     'data' => $userSession
            // ], 200);
        }else{
            return view ('auth.login', [
                'code' => 200,
                'message' => 'Lỗi r'
            ]);
            // return response()->json([
            //     'code' => 304,
            //     'messageError' => 'Email hoặc password sai'
            // ], 200);
        }
    }
}
