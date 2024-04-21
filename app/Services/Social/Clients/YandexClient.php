<?php

namespace App\Services\Social\Clients;

use App\Services\Social\Clients\Interfaces\SocialClient;
use App\Services\Social\Dto\Configs\YandexSocialConfig;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use MiladRahimi\Jwt\Cryptography\Algorithms\Hmac\HS256;
use MiladRahimi\Jwt\Cryptography\Keys\HmacKey;
use MiladRahimi\Jwt\Generator;

final class YandexClient implements SocialClient
{



    public function __construct(
        private readonly Request $request,
        private readonly YandexSocialConfig $config,
    )
    {
    }

    public function getUserInfo(): object
    {
        $data = $this->getToken();
        if ($data && property_exists($data,'access_token')) {
            $requestParams = ['format' => 'json'];
            $requestParams['jwt_secret'] = $this->getSingJWT($requestParams);

            $response = Http::withHeaders([
                'Authorization' => "OAuth " . $data->access_token
            ])->get($this->config->baseLoginUrl . '/info', $requestParams);

            $data->user_info = $response->object();
            return $data;
        }
        dd($data);
        throw new \Exception('Err get access_token');
    }

    private function getToken(): ?object
    {
        $response = Http::withBasicAuth($this->config->client_id, $this->config->client_secret)->withHeaders([
            'Content-type' => 'application/x-www-form-urlencoded',
        ])->asForm()->post($this->config->baseOauthUrl . '/token', [
            'grant_type' => 'authorization_code',
            'code' => $this->request->code,
        ]);
        return $response->object();
    }

    private function getSingJWT(array $data):string
    {
        // Use HS256 to generate and parse JWTs
        $key = new HmacKey($this->config->client_secret);
        $signer = new HS256($key);

        // Generate a JWT
        $generator = new Generator($signer);
        return $generator->generate($data);
    }
}
