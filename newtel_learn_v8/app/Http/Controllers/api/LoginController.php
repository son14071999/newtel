<?php

namespace App\Http\Controllers\Api;

use App\Events\ResetPassword;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\ClientTrait;
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
use Laravel\Passport\Http\Controllers\ClientController;

class LoginController extends Controller
{
    use ClientTrait;


    /**
     * @lrd:start
     * # Hàm Login
     * #  for /login route
     * @lrd:end
     * @QAparam email required email string nullable example=son1999@gmail.com
     * @QAparam password string required
     */
    public function login(Request $request)
    {
        if (!Auth::attempt($request->only(['email', 'password']))) {
            return response()->json('Lỗi đăng nhập', 401);
        } else {
           $user = $request->user();
           $scopes = $user->getPermits($user);
            $token = $user->createToken('demo Oauth', $scopes)->accessToken;
            return response()->json($token, 200);
        }
    }


     /**
     * @lrd:start
     * # Hàm Logout
     * #  for /logout route
     * - Phải đăng nhập ms đc logout
     * @lrd:end
     * @QAparam email required email string nullable example=son1999@gmail.com
     * @QAparam password string required
     */
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







    public function createClient(Request $request, ClientRepository $clients)
    {
        $userId = Auth::user()->id;
        // $client = Oauth_client::where('user_id', $userId)->first();
        // if($client) {
        //     return response()->json([
        //         'clientId' => $client->id,
        //         'clientSecret' => $client->secret
        //     ], 200);
        // }

        $redirect = $request->redirect ? $request->redirect : 'http://localhost:4200';
        $name = $request->name ? $request->name : Auth::user()->name;
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
}
