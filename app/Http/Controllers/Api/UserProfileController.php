<?php

namespace App\Http\Controllers\Api;

use App\Data\User\UserProfileData;
use App\Http\Controllers\Controller;
use App\Services\User\UserProfileService;
use Throwable;
use Spatie\RouteAttributes\Attributes\Get;
use Spatie\RouteAttributes\Attributes\Middleware;
use Spatie\RouteAttributes\Attributes\Post;
use Spatie\RouteAttributes\Attributes\Prefix;

#[Middleware('auth:api')]
#[Prefix('api/profile')]
class UserProfileController extends Controller
{
    public function __construct(private readonly UserProfileService $userProfileService)
    {

    }

    #[Get('/', name: 'profile.show')]
    public function show()
    {
        return response()->json([
            'message' => 'Profile information retrieved successfully.',
            'data' => auth()->user(),
        ]);
    }

    #[Post('/update', name: 'profile.update')]
    public function update(UserProfileData $request)
    {
        try {
            $this->userProfileService->createOrUpdateProfile($request);
            return $this->apiSuccess(
                message: 'Profile updated successfully.',
            );
        } catch (Throwable $e) {
            return $this->apiError(
                message: $e->getMessage(),
                exception: $e,
            );
        }
    }
}
