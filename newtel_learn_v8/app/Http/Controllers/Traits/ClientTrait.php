<?php
namespace App\Http\Controllers\Traits;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

trait ClientTrait{
    public function createAccessToken(Request $request){
        if(Auth::attempt($request->only(['email', 'password']))){
            return response()->json([
                'request' => $request->only(['email', 'password']),
                
            ]);
            $http = new Client;
            $res = $http->post('http://your-app.com/oauth/token', [
                'form_params' => [
                    'grant_type' => 'password',
                    'client_id' => 'client-id',
                    'client_secret' => 'client-secret',
                    'username' => 'taylor@laravel.com',
                    'password' => 'my-password',
                    'scope' => '',
                ],
            ]);
        }
        return ;
    }
}

?>
