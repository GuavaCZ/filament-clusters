<?php

namespace Guava\FilamentClusters;

use Filament\Support\Assets\Css;
use Filament\Support\Facades\FilamentAsset;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class FilamentClustersServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('filament-clusters')
            ->hasViews()
        ;
    }

    public function packageBooted(): void
    {
        FilamentAsset::register([
            Css::make('stylesheet', __DIR__.'/../resources/dist/plugin.css'),
        ], 'guava/filament-clusters');
    }
}
