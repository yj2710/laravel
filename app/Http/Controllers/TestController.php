<?php
/**
 * Created by PhpStorm.
 * User: ABM
 * Date: 2019/10/29
 * Time: 14:39
 */

namespace App\Http\Controllers;

use App\Services\Interfaces\IUserService;
use App\Facades\Rabbitmq;

class TestController extends Controller
{
    protected $userService;

    public function __construct(IUserService $userService)
    {
        $this->userService = $userService;
    }

    public function test()
    {
        Rabbitmq::product('rabbit', 'Hello ttttt!', true);
        die;
        $user = $this->userService->getUser();

        dd($user->toArray());
    }
}