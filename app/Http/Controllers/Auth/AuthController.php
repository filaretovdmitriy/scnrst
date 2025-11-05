<?php

namespace App\Http\Controllers\Auth;

use App\DTOs\UserData;
use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use App\Http\Resources\UserResource;
use App\Services\User\UserService;

class AuthController extends Controller
{
    public function __construct(private UserService $userService)
    {
    }

    public function register(AuthRequest $request): UserResource
    {
        $dto = UserData::from($request);
        $user = $this->userService->create($dto);
        return new UserResource($user);
    }

    public function login()
    {
    }

    public function logout()
    {
    }

    public function user()
    {
    }
}
