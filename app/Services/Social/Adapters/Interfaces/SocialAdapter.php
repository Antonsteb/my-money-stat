<?php

namespace App\Services\Social\Adapters\Interfaces;
use App\Services\Social\Dto\Users\SocialUserDto;

interface SocialAdapter
{
    public function convertData(object $data): SocialUserDto;
}
