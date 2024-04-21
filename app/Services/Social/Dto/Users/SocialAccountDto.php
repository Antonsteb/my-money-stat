<?php

namespace App\Services\Social\Dto\Users;

class SocialAccountDto
{
    public function __construct(
        public readonly string $account_id,
        public readonly string $access_token,
        public readonly string $expires_in,
        public readonly ?string $refresh_token,
        public readonly string $name,
    )
    {
    }
}
