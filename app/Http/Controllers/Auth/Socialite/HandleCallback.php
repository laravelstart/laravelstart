<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth\Socialite;

use App\Http\Controllers\Controller;
use App\Models\User;
use Github\AuthMethod;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Stevebauman\Location\Facades\Location;

class HandleCallback extends Controller
{
    public function __invoke(Request $request): RedirectResponse
    {
        $socialUser = Socialite::driver($request->provider)->user();

        $client = new \Github\Client();
        $client
            ->authenticate($socialUser->token, authMethod: AuthMethod::ACCESS_TOKEN);
        $emails = $client->currentUser()->emails()->all();

        $primaryEmail = Arr::first(
            $emails,
            fn ($email) => $email['primary'] === true,
        ) ?? Arr::first($emails);

        $location = Location::get();

        $user = User::query()->updateOrCreate([
            'email' => $primaryEmail['email'],
        ], [
            'name' => $socialUser->getNickname(),
            'image' => $socialUser->getAvatar(),
            'provider' => $request->provider,
            'provider_id' => $socialUser->getId(),
            'token' => $socialUser->token,
            'password' => '',
            'country_code' => $location?->countryCode,
            'signed_up_device' => $request->userAgent(),
            'latest_device' => $request->userAgent(),
        ]);

        Auth::login($user);

        return redirect()->intended();
    }
}
