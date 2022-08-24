<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\User\UserRepositoryInterface;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function __construct(UserRepositoryInterface $userReppository)
    {
        $this->userReppository = $userReppository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $itemPerPage = isset($_GET['limit']) ? intval($_GET['limit']) : 5;
        $search = isset($_GET['search']) ? $_GET['search'] : '';
        $itemPerPage = intval($itemPerPage);
        $users = $this->userReppository->where('name','LIKE', '%'.$search.'%')
        ->orWhere('email','LIKE', '%'.$search.'%')->paginate($itemPerPage);
        return response()->json([
            'code' => 200,
            'users' => $users,
            'message' => 'Success',
        ], 200);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $roleIds = $request->role_ids;
        DB::beginTransaction();
        try{
            $user = $this->userReppository->create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'email_verified_at' => now(),
                'remember_token' => Str::random(10),
                'department_id' => intval($request->department_id)
            ]);
            $user->roles()->sync($roleIds);
            DB::commit();
        }catch(Exception $err) {
            DB::rollBack();
            return response()->json($err, 405);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = $this->userReppository->find($id);
        if(empty($user)){
            return response()->json([
                'message' => 'User ko tồn tại'
            ], 405);
        }else{
            $roles = $user->roles->toArray();
            return response()->json([
                'user' => $user,
                'roleIds' => array_map(function($o) {return $o['id'];}, $roles),
                'roles' => $roles
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
        $request->validate($this->validation($id)['validation'], $this->validation($id)['messageError']);
        DB::beginTransaction();
        try{
            $roleIds = $request->role_ids;
            $user = $this->userReppository->find($id);
            $user->update($request->except('role_ids'));
            $user->roles()->sync($roleIds);
            DB::commit();
            return response()->json([
                'message' => 'success',
                'roles' => $roleIds,
                'request' => $request->except('role_ids')
            ], 200);
        }catch(Exception $err){
            DB::rollBack();
            return response()->json([
                'error' => $err
            ], 405);
        }
    }

    private function validation($id){
        return [
            'validation' => [
                'email' => 'required|unique:users,email,'.$id.'|email',
                'name' => 'required|max:50'
            ],
            'messageError' => [
                'email.required' => 'Email không được để trống',
                'email.unique' => 'Email đã được sử dụng',
                'email.email' => 'Email không đúng định dạng',
                'name.required' => 'Tên không được để trống',
                'name.max' => 'Tên không vượt quá 50 kí tự'
            ]
        ];
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = $this->userReppository->find($id);
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

    public function getPermitsUser(Request $request) {
        if(Auth::attempt([
            'email' => $request->email,
            'password' => $request->password
        ])) {
            return response()->json((Auth::user())->getPermits(Auth::user()), 200);
        }else{
            return response()->json('Email hoặc mật khẩu sai', 405);
        }
    }

    public function getAllUser() {
        return response()->json($this->userReppository->all());
    }
}
