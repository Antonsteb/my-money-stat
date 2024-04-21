<?php

namespace App\Services\Social\Dto\Configs;

final class YandexSocialConfig
{
    public function __construct(
        public readonly string $client_id,
        public readonly string $client_secret,
        public readonly string $baseOauthUrl,
        public readonly string $baseLoginUrl,
        public readonly string $redirectUrl,
    )
    {
    }

    public static function getConfig(string $client_id, string $client_secret): self
    {
        return new self(
            $client_id,
            $client_secret,
            config('social.yandex.baseOauthUrl'),
            config('social.yandex.baseLoginUrl'),
            route('social.callback.yandex')
        );
    }
}
