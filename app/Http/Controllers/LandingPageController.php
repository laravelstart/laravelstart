<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Support\PageMeta;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function __invoke(Request $request)
    {
        PageMeta::setTitle('Laravel Starter Kits');
        PageMeta::setDescription('Start a fresh Laravel project with a starter kid in a blink of an eye!');

        PageMeta::setProps([
            'og:title' => "Laravel Starter Kits",
            'og:description' => "Create Projects from Laravel Starter Kits on " . config('app.name'),
            'og:image' => url('/images/og-preview.png'),
            'og:url' => url("/"),
            'og:type' => 'website',
            'og:site_name' => config('app.name'),
        ]);

        PageMeta::setMeta([
            'twitter:card' => 'summary_large_image',
            'twitter:title' => "Laravel Starter Kits",
            'twitter:description' => "Create Projects from Laravel Starter Kits on " . config('app.name'),
            'twitter:image' => url('/images/og-preview.png'),
            'twitter:site' => "@webpnkdotdev",
            'twitter:creator' => "@webpnkdotdev",
        ]);

        return view('landing');
    }
}
