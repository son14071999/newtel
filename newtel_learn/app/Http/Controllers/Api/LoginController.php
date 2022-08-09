<?php

namespace App\Http\Controllers\Api;

use App\Events\ResetPassword;
use App\Http\Controllers\Controller;
use App\Models\SessionUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use Laravel\Passport\Client as OClient;
use GuzzleHttp\Client;

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
            // $token = $user->createToken('API Token')->accessToken;
            $oClient = OClient::where('password_client', 1)->first();
            $http = new Client;
            $response = $http->request('POST', 'http://localhost:8000/oauth/token', [
                'form_params' => [
                    'grant_type' => 'password',
                    'client_id' => '96fa9e82-f203-43c6-a270-c160f40290aa',
                    'client_secret' => '0VVRdShCRXYdjGuzA6d3xtKGb0CXDuM9uLIfVjQT',
                    'username' => $request->email,
                    'password' => $request->password,
                    'scope' => '*',
                ],
            ]);
            return response()->json([
                'email' => $request->email,
                'password' => $request->password,
                'token' => $oClient
            ], 200);
            // return response()->json($token, 200);
        }else{
            return response()->json([
                'code' => 211,
                'messageError' => 'Email hoặc password sai'
            ], 211);
        }
    }

    public function getTokenAndRefreshToken(OClient $oClient, $email, $password) { 
        $oClient = OClient::where('password_client', 1)->first();
        
        $response = $http->request('POST', 'http://mylemp-nginx/oauth/token', [
            'form_params' => [
                'grant_type' => 'password',
                'client_id' => $oClient->id,
                'client_secret' => $oClient->secret,
                'username' => $email,
                'password' => $password,
                'scope' => '*',
            ],
        ]);
        $result = json_decode((string) $response->getBody(), true);
        return response()->json($result, $this->successStatus);
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
