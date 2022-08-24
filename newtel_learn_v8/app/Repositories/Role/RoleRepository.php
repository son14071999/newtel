<?php
namespace App\Repositories\Role;

use App\Models\Role;
use App\Repositories\BaseRepository;

class RoleRepository extends BaseRepository implements RoleRepositoryInterface {

    public function __construct(Role $role)
    {
        parent::__construct($role);
    }

}
