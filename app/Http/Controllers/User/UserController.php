<?php

namespace App\Http\Controllers\User;

use App\DTOs\UserAuthData;
use App\DTOs\UserData;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\AuthRequest;
use App\Http\Requests\User\StoreRequest;
use App\Http\Resources\User\AuthUserResource;
use App\Http\Resources\User\UserResource;
use App\Services\User\UserService;

class UserController extends Controller
{
    public function __construct(private UserService $userService)
    {
    }

    public function register(StoreRequest $request): UserResource
    {
        $dto = UserData::from($request);
        $user = $this->userService->create($dto);

        return new UserResource($user);
    }

    public function login(AuthRequest $request): AuthUserResource
    {
        $dto = UserAuthData::from($request);
        $user = $this->userService->getUserByData($dto);

        return (new AuthUserResource($user))->withToken($user->createToken('auth_token')->plainTextToken);
    }

    public function logout(AuthRequest $request)
    {
        $request->user()->tokens()->delete();

        return response()->noContent();
    }

    public function user(StoreRequest $request): UserResource
    {
        $dto = UserData::from($request);
        $user = $this->userService->getUserByData($dto);

        return new UserResource($user);
    }
}
