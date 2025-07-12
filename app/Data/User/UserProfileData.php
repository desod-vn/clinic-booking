<?php

namespace App\Data\User;

use App\Enums\UserGenderEnum;
use App\Enums\UserRoleEnum;
use Illuminate\Http\UploadedFile;
use Illuminate\Validation\Rules\Enum;
use Spatie\LaravelData\Data;

class UserProfileData extends Data
{
    public function __construct(
        public string $first_name,
        public string $last_name,
        public string $date_of_birth,
        public UserGenderEnum $gender,
        public ?UploadedFile $avatar,
        public ?string $email,
        public ?string $academic_level,
        public ?string $nationality,
        public ?string $ethnicity,
        public ?string $national_id_number,
        public ?string $province,
        public ?string $ward,
        public ?string $address,
    ) {}

    public static function rules(): array
    {
        $role = UserRoleEnum::from(auth()->user()?->role);

        $requiredOrNullable = $role === UserRoleEnum::DOCTOR ? 'required' : 'nullable';
        return [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'date_of_birth' => ['required', 'date', 'date_format:Y-m-d'],
            'gender' => ['required', new Enum(UserGenderEnum::class)],
            'avatar' => ['nullable', 'file', 'image', 'max:5120'],
            'email' => [$requiredOrNullable, 'email'],
            'academic_level' => [$requiredOrNullable, 'string', 'max:255'],
            'nationality' => [$requiredOrNullable, 'string', 'max:255'],
            'ethnicity' => [$requiredOrNullable, 'string', 'max:255'],
            'national_id_number' => [$requiredOrNullable, 'string', 'max:20'],
            'province' => [$requiredOrNullable, 'string', 'max:255'],
            'ward' => [$requiredOrNullable, 'string', 'max:255'],
            'address' => [$requiredOrNullable, 'string', 'max:255'],
        ];
    }
}
