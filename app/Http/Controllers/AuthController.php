<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRegisterRequest;
use App\Http\Requests\UserLoginRequest;
use App\Repositories\User\UserInterface;
use Illuminate\Http\Request;


class AuthController extends Controller
{
    public $user;

    public function __construct(UserInterface $user)
    {
        $this->user = $user;
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $client = $this->user->create($input);
        if ($request->hasFile('avatar') && $request->file('avatar')->isValid()) {
            $client->addMediaFromRequest('avatar')->toMediaCollection('avatar');
        }
        return redirect()->route('client');
    }

    public function register(UserRegisterRequest $request)
    {
        $user = $this->user->register($request->all());
        try {
            if ($user) {
                return $this->resolve($user);
            }
        } catch (\Exception$e) {}
    }
    public function login(UserLoginRequest $request)
    {
        $data = $this->user->login($request->only('email', 'password'));
        try {
            if ($data) {
                return $this->resolve($data);
            }
        } catch (\Exception$e) {}

    }

    public function logout()
    {
        $this->user->logout();
        return $this->resolve([]);
    }

}
