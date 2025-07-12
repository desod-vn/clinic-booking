<?php

namespace App\Services\User;

use App\Data\Auth\RegisterData;
use App\Models\User;
use App\Responses\Auth\AuthResponse;
use Illuminate\Support\Facades\Hash;
use Throwable;
use Tymon\JWTAuth\Facades\JWTAuth;

readonly class UserService
{
    public function __construct()
    {

    }

    /**
     * @throws Throwable
     */
    public function createAndLoginUser(RegisterData $dto): AuthResponse
    {
        $user = User::query()->create([
            'phone' => $dto->phone,
            'password' => Hash::make($dto->password),
        ]);

        $token = JWTAuth::fromUser($user);

        return new AuthResponse(
            access_token: $token,
            token_type: 'bearer',
            expires_in: auth('api')->factory()->getTTL() * 60
        );
    }

    public function getCurrentUser()
    {
        $user = User::query()
            ->with('profile')
            ->find(auth('api')->id());

        dd($user);
    }
}
