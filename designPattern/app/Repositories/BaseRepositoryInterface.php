<?php
    namespace App\Repositories;

    interface BaseRepositoryInterface {
        public function getAllList();
        public function getListById($id);
    }
 ?>