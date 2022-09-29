<?php

namespace Despawn;

use Despawn\Filament\Resources\BoardResource;
use Despawn\Filament\Resources\CategoryResource;
use Despawn\Filament\Resources\ThreadResource;
use Filament\PluginServiceProvider;

class DespawnAdminServiceProvider extends PluginServiceProvider
{
    protected array $resources = [
        CategoryResource::class,
        BoardResource::class,
        ThreadResource::class
    ];

    public function configurePackage(\Spatie\LaravelPackageTools\Package $package): void
    {
        $package
            ->name('despawn-admin')
            ->hasConfigFile('despawn-admin');
    }
}