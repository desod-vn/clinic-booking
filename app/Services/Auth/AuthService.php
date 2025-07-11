<?php

namespace App\Services\Auth;

use App\Data\Auth\LoginData;
use App\Responses\Auth\AuthResponse;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Arr;
use Throwable;
use Tymon\JWTAuth\Facades\JWTAuth;

readonly class AuthService
{
    public function __construct()
    {

    }

    /**
     * @throws Throwable
     */
    public function getAccessToken(LoginData $dto): AuthResponse
    {
        $credentials = Arr::only($dto->toArray(), ['phone', 'password']);
        $token = JWTAuth::attempt($credentials);

        throw_if(! $token, AuthenticationException::class);

        return new AuthResponse(
            access_token: $token,
            token_type: 'bearer',
            expires_in: auth('api')->factory()->getTTL() * 60
        );
    }

    public function invalidateAccessToken(LoginData $dto): void
    {
        auth('api')->logout();
    }
}
