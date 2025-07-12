<?php

namespace App\Services\User;

use App\Data\User\UserProfileData;
use App\Models\UserProfile;

class UserProfileService
{
    public function createOrUpdateProfile(UserProfileData $dto) : void
    {
        $attributes = [
            'first_name' => $dto->first_name,
            'last_name' => $dto->last_name,
            'email' => $dto->email,
            'date_of_birth' => $dto->date_of_birth,
            'gender' => $dto->gender,
            'academic_level' => $dto->academic_level,
            'nationality' => $dto->nationality,
            'ethnicity' => $dto->ethnicity,
            'national_id_number' => $dto->national_id_number,
            'province' => $dto->province,
            'ward' => $dto->ward,
            'address' => $dto->address,
        ];

        if (filled($dto->avatar)) {
            $attributes['avatar'] = $dto->avatar->store('avatars', 'public');
        }

        UserProfile::query()->updateOrCreate([
            'user_id' => auth()->id(),
        ], $attributes);
    }
}
