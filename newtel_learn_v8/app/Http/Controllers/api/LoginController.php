<?php

namespace App\Http\Controllers\Api;

use App\Events\ResetPassword;
use App\Http\Controllers\Controller;
use App\Models\Oauth_client;
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
use Illuminate\Support\Facades\Artisan;
use Laravel\Passport\Client as OClient;
use GuzzleHttp\Client;
use Laravel\Passport\ClientRepository;

class LoginController extends Controller
{
    public function login(Request $request, Auth $auth)
    {
        if (!Auth::attempt($request->only(['email', 'password']))) {
            return response()->json('Lỗi đăng nhập', 401);
        } else {
            $user = $request->user();
            $scopoes = [];
            if ($user['role_id']) {
                $scopoes = Role::getCodePermits($user['role_id']);
            }
            $token = $user->createToken('demo Oauth', $scopoes)->accessToken;
            return response()->json($token, 200);
        }
    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json([
            'status' => 'Success',
            'message' => 'Xoá thành công'
        ], 200);
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





    public function loginApplication(Request $request)
    {
    }


    public function createClient(Request $request, ClientRepository $clients)
    {
            $userId = Auth::user()->id;
            $client = Oauth_client::where('user_id', $userId)->first();
            if($client) {
                return response()->json([
                    'clientId' => $client->id,
                    'clientSecret' => $client->secret
                ], 200);
            }
            $redirect = $request->redirect ? $request->redirect : 'http://localhost:4200';
            $client = $clients->create(intval($userId), 'test', $redirect);

            return response()->json([
                'clientId' => $client->id,
                'clientSecret' => $client->plainSecret,
                // 'client' =>  $client,
                // 'clientId' => $request->user()->token()->client->id,
                // 'client1' => $request->user()->token(),
                // 'clientSecret ' => $request->user()->token()->client->secret ,
                // 'status' => 200
            ], 200);
       
    }

    // public function testArtisanCommand()
    // {
    //     $http = new Client();
    // $result = Artisan::call('passport:client', [2, 'test', 'http://localhost:4200']);
    // $result = $http->post('http://your-app.com/oauth/clients', [
    //     'form_params' => [
    //         'grant_type' => 'refresh_token',
    //         'refresh_token' => 'the-refresh-token',
    //         'client_id' => 'client-id',
    //         'client_secret' => 'client-secret',
    //         'scope' => '',
    //     ],
    // ]);


    //     shell_exec('dir', $result);
    //     return response()->json([
    //         'result' => $result
    //     ], 200);
    // }
}
