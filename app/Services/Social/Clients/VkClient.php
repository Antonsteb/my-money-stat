<?php

namespace App\Services\Social\Clients;

use App\Services\Social\Clients\Interfaces\SocialClient;
use App\Services\Social\Dto\Configs\VkSocialConfig;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use MiladRahimi\Jwt\Cryptography\Algorithms\Hmac\HS256;
use MiladRahimi\Jwt\Cryptography\Keys\HmacKey;
use MiladRahimi\Jwt\Generator;
use VK\Client\VKApiClient;
use VK\Exceptions\VKClientException;
use VK\Exceptions\VKOAuthException;
use VK\OAuth\VKOAuth;

final class VkClient implements SocialClient
{

    public function __construct(
        private readonly Request $request,
        private readonly VkSocialConfig $config,
    )
    {
    }


    public function getUserInfo(): object
    {
        $payloadData = json_decode($this->request->payload);
        $data = $this->getToken($payloadData);
        if (property_exists($data,'error')){
            throw new \Exception('Err get access_token: ' . $data->error->error_msg);
        }
        $data = $data->response;

        $response = Http::get($this->config->baseApiUrl . '/method/users.get', [
            'access_token' => $data->access_token,
            'v' => '5.199',
            'fields' => implode(',', ['sex', 'bdate', 'photo_200']),
        ]);

        if (!($response->successful())){
            throw new \Exception('Err get user info');
        }

        $data->user_info = $response->object()->response[0];
        return $data;
    }

    private function getToken($payloadData): object
    {
        $response = Http::get($this->config->baseApiUrl . '/method/auth.exchangeSilentAuthToken', [
            'v' => '5.199',
            'token' => $payloadData->token,
            'access_token' => $this->config->client_services,
            'uuid' => $payloadData->uuid,
        ]);
        if (!$response->successful()){
            throw new \Exception('Err get access_token');
        }
        return $response->object();
    }

}
