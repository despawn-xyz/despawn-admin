<?php

namespace Despawn\Filament\Resources\BoardResource\Pages;

use Despawn\Filament\Resources\BoardResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBoards extends ListRecords
{
    protected static string $resource = BoardResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
