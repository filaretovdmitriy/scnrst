<?php

namespace App\Services\User;

use App\DTOs\UserData;
use App\Models\User;

class UserService
{
    public function create(UserData $data): User
    {
        return User::create($data->toArray());
    }
}
