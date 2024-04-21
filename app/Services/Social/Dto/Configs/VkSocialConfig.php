<?php

namespace App\Services\Social\Dto\Configs;

final class VkSocialConfig
{
    public function __construct(
        public readonly string $app_id,
        public readonly string $client_secret,
        public readonly string $client_services,
        public readonly string $baseIdUrl,
        public readonly string $baseApiUrl,
        public readonly string $redirectUrl,
    )
    {
    }

    public static function getConfig(string $app_id, string $client_secret, string $client_services): self
    {
        return new self(
            $app_id,
            $client_secret,
            $client_services,
            config('social.vk.baseIdUrl'),
            config('social.vk.baseApiUrl'),
'https://test-local-need.com/social/callback/vk'
//            route('social.callback.vk')
        );
    }
}
