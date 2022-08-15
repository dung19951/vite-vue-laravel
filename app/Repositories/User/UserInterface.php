<?php

namespace App\Repositories\User;

use App\Repositories\BaseInterface;


interface UserInterface extends BaseInterface
{
    public function register($data);
    public function login($data);
    public function logout();
    public function refresh(); 
    public function createNewToken($token);
    public function changePassWord($data);
}
