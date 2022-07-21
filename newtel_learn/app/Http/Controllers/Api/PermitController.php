<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Permit;

class PermitController extends Controller
{
    public function getAllPermit(){
        $permitsParent = Permit::where('parent_id', null)->get();
        for($index=0; $index < count($permitsParent); $index++) {
            $permitsParent[$index]->childPermit;
        }
        return response()->json([
            'permits' => $permitsParent,
        ], 200);
    }
}
