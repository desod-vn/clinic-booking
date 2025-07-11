<?php

namespace App\Responses\Auth;

use Spatie\LaravelData\Data;

class AuthResponse extends Data
{
    public function __construct(
        public string $access_token,
        public string $token_type,
        public int    $expires_in
    )
    {
    }
}
