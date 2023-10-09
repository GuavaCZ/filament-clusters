<?php

namespace Guava\FilamentClusters;

use Filament\Contracts\Plugin;
use Filament\Panel;

class FilamentClustersPlugin implements Plugin
{
    public function getId(): string
    {
        return 'filament-clusters';
    }

    public function register(Panel $panel): void
    {
        // TODO: Implement register() method.
    }

    public function boot(Panel $panel): void
    {
        // TODO: Implement boot() method.
    }
}
