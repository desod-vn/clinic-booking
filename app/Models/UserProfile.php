<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserProfile extends Model
{
    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'email',
        'avatar',
        'gender',
        'date_of_birth',
        'academic_level',
        'nationality',
        'ethnicity',
        'national_id_number',
        'province',
        'ward',
        'address'
    ];


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
