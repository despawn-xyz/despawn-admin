<?php

namespace Despawn\Filament\Resources\BoardResource\Pages;

use Despawn\Filament\Resources\BoardResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBoard extends EditRecord
{
    protected static string $resource = BoardResource::class;

    /**
     * @throws \Exception
     */
    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
