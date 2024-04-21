<?php

namespace App\Services\Social\Providers\Interfaces;
interface RedirectUrlCreator
{
    public function createUrl(): string;
}
