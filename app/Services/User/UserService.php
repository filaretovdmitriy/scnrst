<?php

namespace App\Services\User;

use App\DTOs\UserAuthData;
use App\DTOs\UserData;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserService
{
    public function create(UserData $data): User
    {
        return User::create($data->toArray());
    }

    public function getUserByData(UserAuthData $data): User
    {
        $user = User::where('email', $data->email)->first();
        if (! $user || ! Hash::check($data->password, $user->password)) {
            throw ValidationException::withMessages(['email' => 'User not found.']);
        }

        //        $token = $user->createToken('auth_token')->plainTextToken;
        return $user;
    }
}
