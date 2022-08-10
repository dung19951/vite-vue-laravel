<?php

namespace App\Repositories\User;

use App\Repositories\BaseRepository;

class UserRepository extends BaseRepository implements UserInterface
{
    public function getModel()
    {
        return \App\Models\User::class;
    }

}
