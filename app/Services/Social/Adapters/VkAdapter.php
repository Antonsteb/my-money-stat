<?php

namespace App\Services\Social\Adapters;

use App\Models\users\Sex;
use App\Services\Social\AccountCreateType;
use App\Services\Social\Adapters\Interfaces\SocialAdapter;
use App\Services\Social\Dto\Users\SocialAccountDto;
use App\Services\Social\Dto\Users\SocialUserDto;
use Carbon\Carbon;
use Exception;

final class VkAdapter implements SocialAdapter
{

    /**
     * @throws Exception
     */
    public function convertData(object $data): SocialUserDto
    {
        $socialAccountDto = new SocialAccountDto(
            $data->user_id,
            $data->access_token,
            $data->expires_in,
            null,
            AccountCreateType::Vk->value
        );

        return new SocialUserDto(
            $data->user_info->first_name,
            $data->user_info->last_name,
            $socialAccountDto,
            $data->email,
            null,
            $data->user_info->sex === 2 ? Sex::Male : Sex::Female,
            Carbon::parse($data->user_info->bdate),
            $data->user_info->photo_200,
        );
    }
}
