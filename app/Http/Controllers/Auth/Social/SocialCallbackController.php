<?php

namespace App\Http\Controllers\Auth\Social;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Services\Social\Providers\SocialProvider;
use App\Services\Social\Providers\VkSocialProvider;
use App\Services\Social\Providers\YandexSocialProvider;
use App\Services\Social\SocialServices;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SocialCallbackController extends Controller
{
    public function __construct(protected SocialServices $socialServices)
    {
    }

    public function vk(Request $request, VkSocialProvider $socialProvider): RedirectResponse
    {
        $this->storeUser($request, $socialProvider);
        return redirect()->intended(RouteServiceProvider::HOME);
    }

    public function yandex(Request $request, YandexSocialProvider $socialProvider): RedirectResponse
    {
        $this->storeUser($request, $socialProvider);
        return redirect()->intended(RouteServiceProvider::HOME);
    }

    protected function storeUser(Request $request, SocialProvider $socialProvider)
    {
        $userData = $socialProvider->getUserData($request);
        $user = $this->socialServices->storeUser($userData);
        Auth::login($user);
    }
}
