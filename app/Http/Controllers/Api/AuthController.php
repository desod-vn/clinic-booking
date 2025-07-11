<?php

namespace App\Http\Controllers\Api;

use App\Data\Auth\LoginData;
use App\Data\Auth\RegisterData;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\Auth\AuthService;
use App\Services\User\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Spatie\RouteAttributes\Attributes\Post;
use Spatie\RouteAttributes\Attributes\Prefix;
use Throwable;
use Tymon\JWTAuth\Facades\JWTAuth;

#[Prefix('api/auth')]
class AuthController extends Controller
{

    public function __construct(
        private readonly AuthService $authService,
        private readonly UserService $userService
    )
    {
    }

    #[Post('/login', name: 'auth.login')]
    public function login(LoginData $request)
    {
        try {
            $data = $this->authService->getAccessToken($request);
            return $this->apiSuccess(
                data: $data
            );
        } catch (Throwable $e) {
            return $this->apiError(
                message: $e->getMessage(),
                exception: $e,
            );
        }
    }

    #[Post('/register', name: 'auth.register')]
    public function register(RegisterData $request)
    {
        try {
            $data = $this->userService->createAndLoginUser($request);
            return $this->apiSuccess(
                data: $data
            );
        } catch (Throwable $e) {
            return $this->apiError(
                message: $e->getMessage(),
                exception: $e,
            );
        }
    }

    #[Post('/logout', name: 'auth.logout')]
    public function logout(RegisterData $request)
    {
        try {
            $data = $this->userService->createAndLoginUser($request);
            return $this->apiSuccess(
                data: $data
            );
        } catch (Throwable $e) {
            return $this->apiError(
                message: $e->getMessage(),
                exception: $e,
            );
        }
    }
}
