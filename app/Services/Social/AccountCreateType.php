<?php

namespace App\Services\Social;

use App\Services\Social\Providers\DefaultUrlCreator;
use App\Services\Social\Providers\Interfaces\RedirectUrlCreator;
use App\Services\Social\Providers\SocialProvider;
use App\Services\Social\Providers\VkSocialProvider;
use App\Services\Social\Providers\YandexSocialProvider;

enum AccountCreateType: string
{
    const Pass = 'pass';
    case Vk = 'vk';
    case Yandex = 'yandex';

    function getRedirectUrlCreator():RedirectUrlCreator
    {
        return match ($this){
            AccountCreateType::Vk => new VkSocialProvider(),
            AccountCreateType::Yandex => new YandexSocialProvider(),
            AccountCreateType::Pass => new DefaultUrlCreator(),
        };
    }
}
