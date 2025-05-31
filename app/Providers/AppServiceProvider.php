<?php

namespace App\Providers;

use App\Auth\CachedUserProvider;
use App\Services\CloneRepository\CloneRepositoryContract;
use App\Services\CreateRepository\CreateRepositoryContract;
use App\Services\ParseComposerDependencies\ParseComposerDependenciesContract;
use App\Services\ParseComposerDependencies\ParseWithPackage;
use App\Services\ParseNodeDependencies\ParseNodeDependenciesContract;
use App\Services\ParseNodeDependencies\ParseWithJsonDecode;
use App\Services\PushRepository\PushRepositoryContract;
use Illuminate\Contracts\Hashing\Hasher;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Application;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;
use TomatoPHP\FilamentUsers\Resources\UserResource\Infolist\UserInfoList;
use TomatoPHP\FilamentUsers\Resources\UserResource\Table\UserTable;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->registerStrategies();
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Vite::prefetch(concurrency: 3);
        JsonResource::withoutWrapping();
        Model::preventLazyLoading();
        Model::preventAccessingMissingAttributes();

        Auth::provider('cached', function (Application $app, array $config) {
            return new CachedUserProvider(
                $app->make(Hasher::class),
                $config['model'],
            );
        });

        CachedUserProvider::registerMacro();

        UserTable::register([
            \Filament\Tables\Columns\ImageColumn::make('image'),
            \Filament\Tables\Columns\TextColumn::make('country_code')->badge(),
            \Filament\Tables\Columns\TextColumn::make('signed_up_device')->limit(15)->badge(),
            \Filament\Tables\Columns\TextColumn::make('latest_device')->limit(15)->badge(),
            \Filament\Tables\Columns\TextColumn::make('projects_count')
                ->label('Projects')
                ->counts('projects')
                ->badge()->color('gray'),
            \Filament\Tables\Columns\TextColumn::make('kits_count')
                ->label('Created kits')
                ->counts('kits')
                ->badge()->color('gray'),
        ]);

        UserInfolist::register([
            \Filament\Infolists\Components\TextEntry::make('signed_up_device'),
            \Filament\Infolists\Components\TextEntry::make('latest_device'),
        ]);
    }

    private function registerStrategies(): void
    {
        when(
            $this->app->environment('local'),
            // Bind local fake strategies
            function () {
                $this->app->bind(CloneRepositoryContract::class, \App\Services\CloneRepository\Fake::class);
                $this->app->bind(CreateRepositoryContract::class, \App\Services\CreateRepository\Fake::class);
                $this->app->bind(PushRepositoryContract::class, \App\Services\PushRepository\Fake::class);
            },
            // Bind production strategies
            function () {
                $this->app->bind(CloneRepositoryContract::class, \App\Services\CloneRepository\WithGithubApi::class);
                $this->app->bind(CreateRepositoryContract::class, \App\Services\CreateRepository\WithGithubApi::class);
                $this->app->bind(PushRepositoryContract::class, \App\Services\PushRepository\WithGitCli::class);
            }
        );

        $this->app->bind(ParseComposerDependenciesContract::class, ParseWithPackage::class);
        $this->app->bind(ParseNodeDependenciesContract::class, ParseWithJsonDecode::class);
    }
}
