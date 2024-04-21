<?php

return [
    'yandex' => [
        'client_id' => env('YANDEDX_CLIENT_ID'),
        'client_secret' => env('YANDEDX_CLIENT_SECRET'),
        'baseOauthUrl' => 'https://oauth.yandex.ru',
        'baseLoginUrl' => 'https://login.yandex.ru',
    ],
    'vk' => [
        'app_id' => env('VK_APP_ID'),
        'client_secret' => env('VK_CLIENT_SECRET'),
        'client_services' => env('VK_CLIENT_SERVICES'),
        'baseIdUrl' => 'https://id.vk.com',
        'baseApiUrl' => 'https://api.vk.com',
    ],
];
