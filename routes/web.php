<?php

use Illuminate\Support\Facades\Route;

Route::get('/', \App\Http\Controllers\LandingPageController::class)->middleware('guest');
Route::get('/privacy-policy', \App\Http\Controllers\Legal\PrivacyPolicyPageController::class);
Route::get('/terms', \App\Http\Controllers\Legal\TermsPageController::class);

Route::get('/browse/{type?}', \App\Http\Controllers\Browse\PageController::class);
Route::get('/kits/{kit:slug}', \App\Http\Controllers\Kits\Show\PageController::class);

Route::middleware('auth')->group(function () {
   Route::get('/dashboard', \App\Http\Controllers\Dashboard\PageController::class);

   Route::get('/projects', \App\Http\Controllers\Projects\PageController::class);
   Route::get('/projects/{project}', \App\Http\Controllers\Projects\Show\PageController::class);
   Route::post('/kits/{kit}/projects', \App\Http\Controllers\Projects\StoreController::class);

   Route::post('/kits/{kit}/pin', \App\Http\Controllers\PinnedKits\StoreController::class);
   Route::delete('/kits/{kit}/pin', \App\Http\Controllers\PinnedKits\DestroyController::class);

   Route::post('/kits', \App\Http\Controllers\Kits\StoreController::class);
   Route::get('/manage-github', \App\Http\Controllers\ManageGithub\RedirectController::class);
});

when(app()->isLocal(), function () {
    /*
     * Preview emails
     */

    Route::get('/email/welcome', function () {
        return new \App\Mail\WelcomeMail(auth()->user());
    })->middleware('auth');

    Route::get('/email/new-kit', function () {
        return new \App\Mail\NewStarterKitMail(\App\Models\StarterKit::query()->orderByDesc('id')->first(), auth()->user());
    })->middleware('auth');

    Route::get('kits/{kit}/preview', function (\App\Models\StarterKit $kit) {
        return view('kit-preview', [
            'kit' => $kit,
        ]);
    });

    /*
     * Wizard page under development
     */
    Route::get('/wizard', \App\Http\Controllers\Wizard\WizardPageController::class);
});

require __DIR__.'/auth.php';
