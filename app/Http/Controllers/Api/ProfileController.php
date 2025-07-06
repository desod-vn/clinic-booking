<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Spatie\RouteAttributes\Attributes\Get;
use Spatie\RouteAttributes\Attributes\Middleware;
use Spatie\RouteAttributes\Attributes\Prefix;

#[Middleware('auth:api')]
#[Prefix('api/profile')]
class ProfileController extends Controller
{
    #[Get('/', name: 'profile.show')]
    public function show()
    {
        return response()->json([
            'message' => 'Profile information retrieved successfully.',
            'data' => auth()->user(),
        ]);
    }
}
