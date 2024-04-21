<?php

namespace App\Services\Social\Clients\Interfaces;
interface SocialClient
{
    public function getUserInfo(): object;
}
