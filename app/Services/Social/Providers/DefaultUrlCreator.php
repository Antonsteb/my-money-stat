<?php

namespace App\Services\Social\Providers;

use App\Services\Social\Providers\Interfaces\RedirectUrlCreator;

class DefaultUrlCreator implements RedirectUrlCreator
{

    public function createUrl(): string
    {
        return route('login');
    }
}
