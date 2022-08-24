<?php
namespace App\Repositories\Department;

use App\Models\Department;
use App\Repositories\BaseRepository;

class DepartmentRepository extends BaseRepository implements DepartmentRepositoryInterface {

    public function __construct(Department $department)
    {
        parent::__construct($department);
    }


}


?>