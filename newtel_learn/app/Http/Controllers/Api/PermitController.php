<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\PermitTrait;
use Illuminate\Http\Request;
use App\Models\Permit;
use Exception;

class PermitController extends Controller
{
    use PermitTrait;
    public function getAllPermit()
    {
        try {
            $search = isset($_GET['search']) ? $_GET['search'] : '';
            $permitsParent = Permit::where('parent_id', null)->get()->load('childPermit');
            return response()->json([
                'permits' =>  $permitsParent,
                'search' => $search

            ], 200);
        } catch (Exception $err) {
            return response()->json([
                'err' =>  $$err
            ], 405);
        }
    }
}
