<?php

namespace App\Repositories\User;

use App\Models\User;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserRepository extends BaseRepository implements UserInterface
{
    public function getModel()
    {
        return \App\Models\User::class;
    }
    public function register($data)
    {
        try {
            $user = $this->model->create([
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
            ]);
            if ($user) {
                return $user;
            }
            return false;
        } catch (\Exception$e) {}

    }
    public function login($data)
    {
        $token = null;
        try {
            if (!$token = auth()->attempt($data)) {
                return false;
            }
        } catch (\Exception$e) {
            return response()->json(['failed_to_create_token'], 500);
        }
        return $this->createNewToken($token);
    }

    public function logout() {
        auth()->logout();

        return true;
    }

    public function refresh() {
        return $this->createNewToken(auth()->refresh());
    }

    public function createNewToken($token){
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'user' => auth()->user()
        ]);
    }

    public function changePassWord($data) {
        $validator = Validator::make($data, [
            'old_password' => 'required|string|min:6',
            'new_password' => 'required|string|confirmed|min:6',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }
        $userId = auth()->user()->id;
        $user = $this->model->where('id', $userId)->update(
                    ['password' => Hash::make($data['new_password'])],
                );
        return $user;
    }

}
