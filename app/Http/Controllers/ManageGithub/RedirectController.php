<?php

namespace App\Http\Controllers\ManageGithub;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class RedirectController extends Controller
{
    public function __invoke(Request $request)
    {
        $githubAppId = config('services.github.client_id');

        $url = "https://github.com/settings/connections/applications/{$githubAppId}";

        return Inertia::location($url);
    }
}
