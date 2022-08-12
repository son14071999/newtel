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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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
