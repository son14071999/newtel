<?php

namespace App\Http\Controllers\Api;

use App\Models\Permit;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PermitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $itemPerPage = isset($_GET['limit']) ? intval($_GET['limit']) : 5;
        $search = isset($_GET['search']) ? $_GET['search'] : '';
        $itemPerPage = intval($itemPerPage);
        $permits = Permit::where('display_name','LIKE', '%'.$search.'%')
        ->orWhere('code','LIKE', '%'.$search.'%')->paginate($itemPerPage);
        return response()->json([
            'code' => 200,
            'permits' => $permits,
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
        Permit::create([
            'code' => $request->code,
            'display_name' => $request->display_name
        ]);
        return response()->json([
            'message' => 'success'
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\permit  $permit
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $permit = Permit::find($id);
        if(empty($permit)){
            return response()->json([
                'message' => 'Permit ko tồn tại'
            ], 405);
        }else{
            return response()->json([
                'permit' => $permit
            ], 200);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\permit  $permit
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $permit = Permit::find($id);
        $permit_code = Permit::where('code',$request->code)->first();
        if(!empty($permit_code) && $permit!=$permit_code && $request->code==$permit_code->code){
            return response()->json([
                'message' => 'Error'
            ], 405);
        }else{
            Permit::find($id)->update($request->all());
            return response()->json([
                'message' => 'success'
            ], 200);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\permit  $permit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, permit $permit)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\permit  $permit
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $permit = Permit::find($id);
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
