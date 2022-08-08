<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Status;
use NunoMaduro\Collision\Adapters\Phpunit\State;

class StatusController extends Controller
{
    public function getListStatus($parentId) {
        if($parentId) {
            return response()->json(Status::where('use', $parentId)->get(), 200);
        }else{
            return response() -> json(Status::get(), 200);
        }
    }
}
