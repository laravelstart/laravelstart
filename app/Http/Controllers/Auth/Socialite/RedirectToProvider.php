<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth\Socialite;

use App\Http\Controllers\Controller;
use App\Http\Requests\Socialite\AuthProviderRequest;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Symfony\Component\HttpFoundation\RedirectResponse;

class RedirectToProvider extends Controller
{
    public function __invoke(Request $request): RedirectResponse|\Illuminate\Http\RedirectResponse
    {
        if (!in_array(
            $request->route('provider'),
            ['github'],
        )) {
            abort(404);
        }

        return Socialite::driver($request->provider)->scopes([
            'repo',
            'read:org',
            'workflow',
        ])->redirect();
    }
}
