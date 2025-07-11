<?php

namespace App\Data\Auth;

use Spatie\LaravelData\Data;

class LoginData extends Data
{
    public function __construct(
        public string $phone,
        public string $password
    ) {}

    public static function rules(): array
    {
        return [
            'phone' => ['required', 'phone:VN'],
            'password' => ['required', 'string', 'min:6'],
        ];
    }
}
