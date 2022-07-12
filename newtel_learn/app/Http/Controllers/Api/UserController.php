<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Pagination\Paginator;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $itemPerPage = 10;
    public function index(Request $request)
    {
        $pattern = "/.*limit=([0-9]+).*/i";
        preg_match($pattern, $request->fullUrl(), $result);
        dd($result);
        if(!empty($result) && isset($result[1])){
            $this->itemPerPage=intval($result[1]);
        }
        Paginator::useBootstrap();
        $users = User::paginate($this->itemPerPage);
        return response()->json([
            'code' => 200,
            'users' => $users,
            'itemPerPage' => $this->itemPerPage
        ], 200);
    }

    public function changeItemPerPage($itemPerPage){
        $this->itemPerPage = $itemPerPage;
        return response()->json([
            'code' =>  200,
            'message' => 'Success',
            'check' =>  $this->itemPerPage,
            'check1' => $itemPerPage
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ]);
        return response()->json([
            'message' => 'success'
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        if(empty($user)){
            return response()->json([
                'message' => 'User ko tồn tại'
            ], 405);
        }else{
            return response()->json([
                'user' => $user
            ], 200);
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
        //
        $user = User::find($id);
        $user_email = User::where('email',$request->email)->first();
        if(!empty($user_email) && $user!=$user_email && $request->email==$user_email->email){
            return response()->json([
                'message' => 'Error'
            ], 405);
        }else{
            User::find($id)->update($request->all());
            return response()->json([
                'message' => 'success'
            ], 200);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        if(!empty($user)){
            $user->delete();
            return response()->json([
                'code' => 200,
                'message' => 'Xóa thành công'
            ], 200);
        }
        return response()->json([
            'code' => 405,
            'message' => 'Người dùng không tồn tại'
        ], 405);
    }
}
