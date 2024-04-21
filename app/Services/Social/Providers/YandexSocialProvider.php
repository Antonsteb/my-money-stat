<?php

namespace App\Services\Social\Providers;

use App\Services\Social\Adapters\Interfaces\SocialAdapter;
use App\Services\Social\Adapters\YandexAdapter;
use App\Services\Social\Clients\Interfaces\SocialClient;
use App\Services\Social\Clients\YandexClient;
use App\Services\Social\Dto\Configs\YandexSocialConfig;
use Illuminate\Http\Request;

final class YandexSocialProvider extends SocialProvider
{

    private YandexSocialConfig $config;

    public function __construct()
    {
        $this->config = YandexSocialConfig::getConfig(
            config('social.yandex.client_id'),
            config('social.yandex.client_secret')
        );
    }

    public function createUrl(): string
    {
        $params = http_build_query([
            'response_type' => 'code',
            'client_id' => $this->config->client_id,
            'redirect_uri' => $this->config->redirectUrl
        ]);
        return $this->config->baseOauthUrl . "/authorize?$params";
    }

    protected function getClient(Request $request): SocialClient
    {
        return new YandexClient($request, $this->config);
    }

    protected function getAdapter(): SocialAdapter
    {
        return new YandexAdapter();
    }
}
