<?php

declare(strict_types=1);

namespace App\Http\Controllers\Legal;

use App\Http\Controllers\Controller;
use App\Support\PageMeta;
use Illuminate\Support\Carbon;

class PrivacyPolicyPageController extends Controller
{
    public function __invoke()
    {
        PageMeta::setTitle('Privacy Policy');

        $supportEmail = 'support@laravelstart.app';
        $effectiveDate = Carbon::parse('10.03.2025');

        return view('privacy-policy', [
            'supportEmail' => $supportEmail,
            'effectiveDate' => $effectiveDate,
        ]);
    }
}
