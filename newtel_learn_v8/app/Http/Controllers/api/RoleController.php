<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Repositories\Role\RoleRepositoryInterface;
use Exception;
use Illuminate\Http\Request;

class RoleController extends Controller
{

    
    public function __construct(RoleRepositoryInterface $roleRepository)
    {
        $this->roleRepository = $roleRepository;
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
        $roles = $this->roleRepository->where('name', 'LIKE', '%' . $search . '%')
            ->orWhere('code', 'LIKE', '%' . $search . '%')->paginate($itemPerPage);

        return response()->json([
            'code' => 200,
            'roles' => $roles,
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
        $request->validate($this->validation(0)['validation'], $this->validation(0)['messageError']);
        DB::beginTransaction();
        try{
            $role = $this->roleRepository->create([
                'code' => $request->code,
                'name' => $request->name
            ]);
            $permitIds = $request->permits;
            $role->permissions()->sync($permitIds);
            DB::commit();
            return response()->json([
                'message' => 'success'
            ], 200);

        }
        catch (Exception $e){
            DB::rollBack();
            return response()->json([
                'error' => $e
            ], 405);
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role = $this->roleRepository->find($id)->load('permissions');
        $permitCodes = $role->permissions->pluck('code');
        if (empty($role)) {
            return response()->json([
                'message' => 'Role ko tồn tại'
            ], 405);
        } else {
            return response()->json([
                'role' => $role,
                'permitCodes' => $permitCodes
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
        $request->validate($this->validation($id)['validation'], $this->validation($id)['messageError']);
        DB::beginTransaction();
        try {
            $role = $this->roleRepository->find($id);
            $permitCodes = $request->permits;
            // $permitCodes = array_column($permits, 'code');
            $role_code = $this->roleRepository->where('code', $request->code)->first();
            if (!empty($role_code) && $role != $role_code && $request->code == $role_code->code) {
                return response()->json([
                    'message' => 'Error'
                ], 405);
            } else {
                $this->roleRepository->find($id)->update($request->all());
                $role->permissions()->sync($permitCodes);
                DB::commit();
                return response()->json([
                    'message' => 'success',
                    'permitIds' => $permitCodes
                ], 200);
            }
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'error' => $e
            ], 405);
        }
    }



    public function validation($id){
        return [
            'validation' => [
                'code' => 'required|unique:roles,code,'.$id.'|regex:/^\S+$/i'.'|max:30',
                'name' => 'required|unique:roles,name,'.$id
            ],
            'messageError' => [
                'code.required' => 'Code không được để trống',
                'code.unique' => 'Code đã được sử dụng',
                'code.regex' => 'Code không được có khoảng trắng',
                'code.max' => 'Độ dài tối đa của code là 30',
                'name.required' => 'Tên role không được để trống',
                'name.unique' => 'Tên role đã được sử dụng'
            ]
        ];
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = $this->roleRepository->find($id);
        if (!empty($role)) {
            $role->permissions()->detach();
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
