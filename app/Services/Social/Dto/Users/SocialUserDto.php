<?php

namespace App\Services\Social\Dto\Users;

use App\Models\users\Sex;
use Carbon\Carbon;

final class SocialUserDto
{
    public function __construct(
        public readonly string           $firstName,
        public readonly string           $lastName,
        public readonly SocialAccountDto $socialAccountDto,
        public readonly ?string          $email = null,
        public readonly ?string          $phone = null,
        public readonly ?Sex             $sex = null,
        public readonly ?Carbon          $beneficiaryBirthDate = null,
        public readonly ?string          $avatar_url = null,
        public readonly ?string          $middleName = null,
    )
    {
    }
}
