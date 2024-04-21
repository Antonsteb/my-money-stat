<?php

namespace App\Http\Controllers\Auth\Social;

use App\Http\Controllers\Controller;
use App\Http\Requests\auth\SocialAccountRequest;
use App\Services\Social\AccountCreateType;
use Illuminate\Http\JsonResponse;

class SocialRedirectController extends Controller
{


    public function socialURL(SocialAccountRequest $request): JsonResponse
    {
        $redirectUrlCreator = AccountCreateType::from($request->social)->getRedirectUrlCreator();
        return response()->json([
            'url' => $redirectUrlCreator->createUrl()
        ]);
    }

}
