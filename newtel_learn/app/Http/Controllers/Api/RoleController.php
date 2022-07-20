<?php

namespace App\Http\Controllers\Api;

use App\Models\Role;
use App\Models\Permit;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RoleController extends Controller
{
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
        $roles = Role::where('name','LIKE', '%'.$search.'%')
        ->orWhere('code','LIKE', '%'.$search.'%')->paginate($itemPerPage);
        
        return response()->json([
            'code' => 200,
            'roles' => $roles,
            
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
        Role::create([
            'code' => $request->code,
            'name' => $request->name
        ]);
        return response()->json([
            'message' => 'success'
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role = Role::find($id);
        $permits = Permit::get();
        if(empty($role)){
            return response()->json([
                'message' => 'Role ko tồn tại'
            ], 405);
        }else{
            return response()->json([
                'role' => $role,
                'permits' => $permits
            ], 200);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $role = Role::find($id);
        $role_code = Role::where('code',$request->code)->first();
        if(!empty($role_code) && $role!=$role_code && $request->code==$role_code->code){
            return response()->json([
                'message' => 'Error'
            ], 405);
        }else{
            Role::find($id)->update($request->all());
            return response()->json([
                'message' => 'success'
            ], 200);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = Role::find($id);
        if(!empty($role)){
            $role->delete();
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
