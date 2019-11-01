<?php
/**
 * Created by PhpStorm.
 * UserQO: ABM
 * Date: 2019/10/29
 * Time: 14:39
 */

namespace App\Http\Controllers;

use App\Entities\QueryObject\User\UserQO;
use App\Services\Interfaces\IUserService;

class TestController extends Controller
{
    protected $userService;

    public function __construct(IUserService $userService)
    {
        $this->userService = $userService;
    }

    public function test()
    {
//        Rabbitmq::product('rabbit', 'Hello ttttt!', true);
//        die;
        $users = $this->userService->getUser();

        foreach ($users as  $user){
            /** @var UserQO $user */
//            dump($user->username);
            dump($user->idCode);
        }
//        return $user;
//        dd($user->toArray());
    }
}