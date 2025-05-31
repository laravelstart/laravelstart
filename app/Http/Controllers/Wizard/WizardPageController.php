<?php

declare(strict_types=1);

namespace App\Http\Controllers\Wizard;

use App\Http\Controllers\Controller;
use Inertia\Inertia;

/*
 * Wizard page is under development
 */
class WizardPageController extends Controller
{
    public function __invoke()
    {
        return Inertia::render('Wizard/WizardPage', []);
    }
}
