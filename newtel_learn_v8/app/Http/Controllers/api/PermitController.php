<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\Permit\PermitRepositoryInterface;
use Exception;

class PermitController extends Controller
{

    public function __construct(PermitRepositoryInterface $permitRepository)
    {
            $this->permitRepository = $permitRepository;
    }
    // use PermitTrait;
    public function getAllPermit()
    {
        try {
            $search = isset($_GET['search']) ? $_GET['search'] : '';
            $permitsParent = $this->permitRepository->where('parent_id', null)->where('code', 'like', '%'.$search.'%')->get()->map(function($permit, $key){
                $permit->checked = false;
                $permit->childPermit->map(function($childPermit, $key1){
                    $childPermit->checked = false;
                    return $childPermit;
                });
                return $permit;
            });
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
