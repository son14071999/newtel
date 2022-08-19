<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Oauth_client;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Passport\ClientRepository;
use GuzzleHttp\Client;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userId = Auth::user()->id;
        $clients = Oauth_client::where('user_id', $userId)->get();
        return response()->json([
            'clients' => $clients,
            'user_id' => $userId
        ], 200);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, ClientRepository $clients)
    {
        $userId = Auth::user()->id;
        $redirect = $request->redirect ? $request->redirect : 'http://localhost:4200';
        $name = $request->name ? $request->name : Auth::user()->name;
        $clients->create(intval($userId), $name, $redirect, null, false, 1);
        return response()->json('Success', 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            return response()->json(Oauth_client::find($id), 200);
        } catch (Exception $err) {
            return response()->json($err, 405);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $request->validate($this->getValidate()['validation'], $this->getValidate()['message']);
        $client = Oauth_client::find($id);
        if ($client) {
            $client->update($request->only(['name', 'redirect']));
            return response()->json('Success', 200);
        }
        return response()->json('Client không tồn tại', 405);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $client = Oauth_client::find($id);
        if ($client) {
            $client->delete();
            return response()->json('Success', 200);
        }
        return response()->json('Client không tồn tại', 405);
    }

    public function getValidate()
    {
        return [
            'validation' => [
                'name' => 'required',
                'redirect' => 'required|regex:/^\S+$/i'
            ],
            'message' => [
                'name.required' => 'Tên không được để trống',
                'redirect.required' => 'Redirect không được để trống',
                'redirect.regex' => 'Redirect không hợp lệ'
            ]
        ];
    }


    public function createAccessToken(Request $request)
    {
        $http = new Client;


        $response = $http->post('http://your-app.com/oauth/token', [
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


    public function refreshToken(Request $request)
    {
        $http = new Client;
        return response()->json(123);
        $response = $http->post('http://localhost:8000/oauth/token', [
            'form_params' => [
                'grant_type' => 'refresh_token',
                'refresh_token' => $request->refreshToken,
                'client_id' => $request->clientId,
                'client_secret' => $request->clientSecret,
                'scope' => '',
            ],
        ]);
        return response()->json(['response' => $response]);
    }
}
