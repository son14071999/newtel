<?php
namespace App\Http\Controllers\Traits;
use App\Models\Permit;

trait PermitTrait{
    public function getAllPermit(){
        $permitsParent = Permit::where('parent_id', null)->get();
        for($index=0; $index < count($permitsParent); $index++) {
            $permitsParent[$index]->childPermit;
        }
        return $permitsParent;
    }
}

?>
