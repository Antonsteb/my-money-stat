<?php

namespace App\Services\Social;


use App\ExtendsLaravelClasses\UrlUploadedFile;
use App\Models\users\SocialAccount;
use App\Models\users\User;
use App\Services\Social\Dto\Users\SocialAccountDto;
use App\Services\Social\Dto\Users\SocialUserDto;
use Exception;
use Illuminate\Support\Facades\DB;

final class SocialServices
{

    public function storeUser(SocialUserDto $socialUserDto): User
    {
        $user = $this->checkUser($socialUserDto);
        if ($user) {
            return $user;
        }

        DB::transaction(function () use ($socialUserDto, &$user) {

            $avatar = null;
            if ($socialUserDto->avatar_url){
              $avatar = UrlUploadedFile::createFromUrl($socialUserDto->avatar_url)->store('avatars');
            }


            /** @var User $user */
            $user = User::query()->create([
                'name' => $socialUserDto->firstName,
                'email' => $socialUserDto->email,
                'avatar' => $avatar,
            ]);

            $this->addSocialAccount($user, $socialUserDto->socialAccountDto);
        });

        if ($user instanceof User) {
            return $user;
        }

        throw new Exception("User can not be created");
    }

    private function checkUser(SocialUserDto $socialUserDto): ?User
    {
        /** @var SocialAccount $socialAccount */
        $socialAccount = SocialAccount::query()->where([
            'social_name' => $socialUserDto->socialAccountDto->name,
            'account_id' => $socialUserDto->socialAccountDto->account_id,
        ])->first();
        if ($socialAccount){
            return $socialAccount->user;
        }

        if ($socialUserDto->email || $socialUserDto->phone) {
            $userQuery = User::query();
            if ($socialUserDto->email) $userQuery->where('email', $socialUserDto->email);
            if ($socialUserDto->phone) $userQuery->orWhere('phone', $socialUserDto->phone);
            $user = $userQuery->first();
            if ($user instanceof User){
                $this->addSocialAccount($user, $socialUserDto->socialAccountDto);
                return $user;
            }
        }
        return null;
    }

    private function addSocialAccount(User $user, SocialAccountDto $socialAccountDto ):void
    {
        $user->socialAccounts()->create([
            'social_name' => $socialAccountDto->name,
            'account_id' => $socialAccountDto->account_id,
            'access_token' => $socialAccountDto->access_token,
            'expires_in' => $socialAccountDto->expires_in,
            'refresh_token' => $socialAccountDto->refresh_token,
        ]);
    }

}
