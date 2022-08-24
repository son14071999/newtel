<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\Department\DepartmentRepositoryInterface;
use Exception;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{

    public function __construct(DepartmentRepositoryInterface $departmentRepository) {
        $this->departmentRepository = $departmentRepository;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(
            $this->departmentRepository->orderBy('path', 'asc')->get()
        );
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $parentId = $request->parentId;
        if($parentId == 'root'){
            $departmnet = $this->departmentRepository->create([
                'name' => $request->name,
            ]);
            $departmnet->update([
                'parent_id' => strval($departmnet->id),
                'path' => strval($departmnet->id)
            ]);
        }else{
            $parent = $this->departmentRepository->find($parentId);
            $newDepartment = $this->departmentRepository->create([
                'name' => $request->name,
                'parent_id' => $parent->id,
            ]);
            $newDepartment->update([
                'path' => strval($parent->path ?? '').'/'.strval($newDepartment->id)
            ]);
        }
        return response()->json($request->all(),200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try{
            return response()->json($this->departmentRepository->find($id), 200);
        }catch(Exception $err){
            return response()->json($err,304);
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
        $departmnetChilds = $this->departmentRepository->where('path', 'like', $id)
        ->orWhere('path', 'like', $id.'/%')
        ->orWhere('path', 'like', '%/'.$id)
        ->orWhere('path', 'like', '%/'.$id.'/%')
        ->get();
        $departmentParent = $this->departmentRepository->find($request->parentId);
        $department = $this->departmentRepository->find($id);
        foreach($departmnetChilds as $item){
            $item->update([
                'path' => str_replace($department['path'], $departmentParent['path'].'/'.$id, $item['path'])
            ]);
        }
        $department->update([
            'name' => $request->name,
            'parent_id' => $request->parentId,
        ]);
        return response()->json([
            'departmnetChilds' => $departmnetChilds,
            'departmentParent' => $departmentParent,
            'department' => $department
        ], 200);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $this->departmentRepository->where('path', 'like', $id)
            ->orWhere('path', 'like', $id.'/%')
            ->orWhere('path', 'like', '%/'.$id)
            ->orWhere('path', 'like', '%/'.$id.'/%')
            ->delete();
            return response()->json('Xoá thành công',200);
        }catch(Exception $err){
            return response()->json($err, 304);
        }
    }
}
