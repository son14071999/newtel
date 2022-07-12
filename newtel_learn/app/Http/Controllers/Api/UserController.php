<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Pagination\Paginator;
use Illuminate\Http\Request;

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

    public function changeItemPerPage(){

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
        ]);
        return redirect()->route('listUser');
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
            return back()->withInput();
        }else{
            return view('listUser.editUser', ['user' => $user]);
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
            return redirect()->back()->with(['error' => 'email da ton tai']);
        }else{
            User::find($id)->update($request->all());
            return redirect()->route('listUser');
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
