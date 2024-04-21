<?php

namespace App\Services\Social\Providers;

use App\Services\Social\Adapters\Interfaces\SocialAdapter;
use App\Services\Social\Clients\Interfaces\SocialClient;
use App\Services\Social\Dto\Users\SocialUserDto;
use App\Services\Social\Providers\Interfaces\RedirectUrlCreator;
use Illuminate\Http\Request;

abstract class SocialProvider implements RedirectUrlCreator
{
    abstract public function createUrl(): string;
    abstract protected function getClient(Request $request): SocialClient;
    abstract protected function getAdapter(): SocialAdapter;

    public function getUserData(Request $request): SocialUserDto
    {
        $client = $this->getClient($request);
        $data = $client->getUserInfo();
        $adapter = $this->getAdapter();
        return $adapter->convertData($data);
    }
}
