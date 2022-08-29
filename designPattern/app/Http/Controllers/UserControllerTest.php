<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\User\UserRepositoryInterface as UserTest;

class UserControllerTest extends Controller
{

    public function __construct(UserTest $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    public function index() {
        $users = $this->userRepository->getAllList();
        return view('user', compact('users'));
    }
}
