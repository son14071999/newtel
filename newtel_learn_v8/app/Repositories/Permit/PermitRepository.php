<?php
namespace App\Repositories\Permit;

use App\Models\Permit;
use App\Repositories\BaseRepository;

class PermitRepository extends BaseRepository implements PermitRepositoryInterface {

    public function __construct(Permit $permit)
    {
        parent::__construct($permit);
    }


}


?>