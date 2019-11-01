<?php

namespace App\Services;


use App\Models\User;
use App\Services\Interfaces\IUserService;

class UserService implements IUserService
{

    public function getUser()
    {
        return User::query()->get();
    }
}