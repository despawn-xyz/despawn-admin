<?php

namespace Despawn;

use Despawn\Filament\Pages\Login;
use Despawn\Filament\Resources\BoardResource;
use Despawn\Filament\Resources\CategoryResource;
use Despawn\Filament\Resources\CommentResource;
use Despawn\Filament\Resources\RoleResource;
use Despawn\Filament\Resources\ThreadResource;
use Filament\PluginServiceProvider;
use Livewire\Livewire;

class DespawnAdminServiceProvider extends PluginServiceProvider
{
    protected array $resources = [
        CategoryResource::class,
        BoardResource::class,
        ThreadResource::class,
        CommentResource::class,
        RoleResource::class
    ];

    public function configurePackage(\Spatie\LaravelPackageTools\Package $package): void
    {
        $package
            ->name('despawn-admin')
            ->hasConfigFile('despawn-admin');
    }
}