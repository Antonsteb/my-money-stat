<?php

namespace App\Services\Social\Adapters;

use App\Models\users\Sex;
use App\Services\Social\AccountCreateType;
use App\Services\Social\Adapters\Interfaces\SocialAdapter;
use App\Services\Social\Dto\Users\SocialAccountDto;
use App\Services\Social\Dto\Users\SocialUserDto;
use Carbon\Carbon;
use Exception;

final class YandexAdapter implements SocialAdapter
{

    /**
     * @throws Exception
     */
    public function convertData(object $data): SocialUserDto
    {

        $socialAccountDto = new SocialAccountDto(
            $data->user_info->id,
            $data->access_token,
            $data->expires_in,
            $data->refresh_token,
            AccountCreateType::Yandex->value
        );

        return new SocialUserDto(
            $data->user_info->first_name,
            $data->user_info->last_name,
            $socialAccountDto,
            $data->user_info->emails[0],
            $data->user_info->default_phone?->number,
            Sex::tryFrom($data->user_info->sex),
            Carbon::parse($data->user_info->birthday),
            null,
        );
    }
}
