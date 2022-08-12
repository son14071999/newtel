<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Issue;
use App\Models\Status;
use Exception;
use Tymon\JWTAuth\Claims\Expiration;

class IssueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $userId = Auth::user()->id;
            $issues = Issue::Where('executor_id', $userId)
            ->orWhere('jobAssignor_id', $userId)->get();
            return response()->json($issues, 200);
        }catch(Exception $err) {
            return response()->json($err, 500);
        }

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            $request->validate($this->validation()['validation'], $this->validation()['messageError']);
            $data = [
                'name' => $request->name ?? '',
                'descripttion' => $request->descripttion ?? '',
                'deadline' => date('Y-m-d',intval($request->deadline)/1000),
                'executor_id' => intval($request->executor_id),
                'status_success_id' => NULL,
                'jobAssignor_id' => Auth::user()->id,
                'status_id' => Status::Where('code', 'CHUALAM')->first()->id
            ];
            Issue::create($data);
        }catch(Expiration $err){
            return response()->json($err, 500);
        }
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
        return response()->json([
            'userId' => Auth::user()->id,
            'info' => Issue::find($id)
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $executor = ['status_id'];
        $jobAssignor = ['name', 'descripttion', 'executor_id'];
        $finishDay = null;

        
        $userId = Auth::user()->id;
        if(!empty($request->executor_id) && ($request->executor_id == $userId)){
            if(Status::find($request->status_id)->code=='XONG'){
                $finishDay = date('Y-m-d');
            }
            Issue::find($id)->update(array_merge(
                ['finishDay' => $finishDay], $request->only($executor)
            ));
        }
        if(!empty($request->jobAssignor_id) && ($request->jobAssignor_id == $userId)){
            Issue::find($id)->update(array_merge($request->only($jobAssignor), [
                'deadline' => date('Y-m-d',intval($request->deadline)/1000)
            ]));
        }
        return response()->json('Success', 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $issue = Issue::find($id);
        $user = Auth::user();
        if($user->id == $issue->jobAssignor_id){
            $issue->delete();
            return response()->json('Success', 200);
        }else{
            return response()->json('Bạn không có quyền xoá', 500);
        }
    }



    public function validation() {
        return [
            'validation' => [
                'name' => 'required',
                'deadline' => 'required',
                'executor_id' => 'required'
            ],
            'messageError' => [
                'name.required' => 'Tên không được để trống',
                'deadline.required' => 'Deadline không được để trống',
                'executor_id.required' => 'Người giao việc không được để trống',
            ]
        ];
    }
}
