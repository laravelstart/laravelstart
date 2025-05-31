<?php

namespace App\Filament\Pages;

use Filament\Actions\Action;
use Filament\Forms\Form;

class Login extends \Filament\Pages\Auth\Login
{
    public function form(Form $form): Form
    {
        return $form
            ->schema([]);
    }

    protected function getFormActions(): array
    {
        return [
            Action::make('github_login')->view('filament.auth.github'),
        ];
    }

    public function getHeading(): string
    {
        return 'Sign in into Admin Panel';
    }
}
