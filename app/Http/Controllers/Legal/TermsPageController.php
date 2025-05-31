<?php

declare(strict_types=1);

namespace App\Http\Controllers\Legal;

use App\Http\Controllers\Controller;
use App\Support\PageMeta;
use Illuminate\Support\Carbon;

class TermsPageController extends Controller
{
    public function __invoke()
    {
        PageMeta::setTitle('Terms & Conditions');

        $supportEmail = 'webpnk.dev@gmail.com';
        $effectiveDate = Carbon::parse('10.03.2025');

        return view('terms', [
            'supportEmail' => $supportEmail,
            'effectiveDate' => $effectiveDate,
        ]);
    }
}
