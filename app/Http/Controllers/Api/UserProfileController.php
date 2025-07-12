<?php

namespace App\Http\Controllers\Api;

use App\Data\User\UserProfileData;
use App\Http\Controllers\Controller;
use App\Services\User\UserProfileService;
use App\Services\User\UserService;
use Throwable;
use Spatie\RouteAttributes\Attributes\Get;
use Spatie\RouteAttributes\Attributes\Middleware;
use Spatie\RouteAttributes\Attributes\Post;
use Spatie\RouteAttributes\Attributes\Prefix;

#[Middleware('auth:api')]
#[Prefix('api/user-profile')]
class UserProfileController extends Controller
{
    public function __construct(
        private readonly UserService $userService,
        private readonly UserProfileService $userProfileService
    )
    {
    }

    #[Get('/me', name: 'user-profile.me')]
    public function me()
    {
        try {
            $user = $this->userService->getCurrentUser();
            return $this->apiSuccess(
                message: 'Profile updated successfully.',
            );
        } catch (Throwable $e) {
            return $this->apiError(
                exception: $e,
            );
        }
    }

    #[Post('/update', name: 'user-profile.update')]
    public function update(UserProfileData $request)
    {
        try {
            $this->userProfileService->createOrUpdateProfile($request);
            return $this->apiSuccess(
                message: 'Profile updated successfully.',
            );
        } catch (Throwable $e) {
            return $this->apiError(
                exception: $e,
            );
        }
    }
}
