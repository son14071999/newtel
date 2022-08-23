<?php
    namespace Repositories\User;
    use Illuminate\Database\Eloquent\Model;
    use App\Models\User;

    interface UserRepositoryInterface {
        public function getAllList();
        public function getListById($id);
    }
 ?>