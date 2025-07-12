<?php

namespace App\Data\User;

use Illuminate\Http\UploadedFile;
use Spatie\LaravelData\Data;

class UserProfileData extends Data
{
    public function __construct(
        public ?int $id,
        public int $user_id,
        public string $first_name,
        public string $last_name,
        public string $date_of_birth,
        public string $gender,
        public ?UploadedFile $avatar,
        public ?string $email,
        public ?string $academic_level,
        public ?string $nationality,
        public ?string $ethnicity,
        public ?string $national_id_number,
        public string $province,
        public string $ward,
        public string $address,
    ) {}

    public static function rules(): array
    {
        return [
            'user_id' => ['required', 'exists:users,id'],
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'date_of_birth' => ['required', 'date'],
            'gender' => ['required', 'in:male,female,other'],
            'avatar' => ['nullable', 'file', 'image', 'max:5120'],
            'email' => ['nullable', 'email'],
            'academic_level' => ['nullable', 'string', 'max:255'],
            'nationality' => ['nullable', 'string', 'max:255'],
            'ethnicity' => ['nullable', 'string', 'max:255'],
            'national_id_number' => ['nullable', 'string', 'max:20'],
            'province' => ['required', 'string', 'max:255'],
            'ward' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:500'],
        ];
    }
}
