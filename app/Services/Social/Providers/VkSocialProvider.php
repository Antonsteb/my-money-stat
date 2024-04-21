<?php

namespace App\Services\Social\Providers;

use App\Services\Social\Adapters\Interfaces\SocialAdapter;
use App\Services\Social\Adapters\VkAdapter;
use App\Services\Social\Clients\Interfaces\SocialClient;
use App\Services\Social\Clients\VkClient;
use App\Services\Social\Dto\Configs\VkSocialConfig;
use Illuminate\Http\Request;

final class VkSocialProvider extends SocialProvider
{

    private VkSocialConfig $config;

    public function __construct()
    {
        $this->config = VkSocialConfig::getConfig(
            config('social.vk.app_id'),
            config('social.vk.client_secret'),
            config('social.vk.client_services')
        );
    }

    public function createUrl(): string
    {
            $params = http_build_query([
                'response_type' => 'silent_token',
                'uuid' => 'geegyk',
                'v' => '1.0.3',
                'app_id' => $this->config->app_id,
                'redirect_uri' => $this->config->redirectUrl,
            ]);
        return $this->config->baseIdUrl . "/auth?$params";

    }

    protected function getClient(Request $request): SocialClient
    {
        return new VkClient($request, $this->config);
    }

    protected function getAdapter(): SocialAdapter
    {
        return new VkAdapter();
    }
}
