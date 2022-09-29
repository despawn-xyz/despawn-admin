<?php

namespace Despawn\Filament\Resources\ThreadResource\Pages;


use Despawn\Filament\Resources\BoardResource;
use Despawn\Filament\Resources\CategoryResource;
use Despawn\Filament\Resources\ThreadResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListThreads extends ListRecords
{
    protected static string $resource = ThreadResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
