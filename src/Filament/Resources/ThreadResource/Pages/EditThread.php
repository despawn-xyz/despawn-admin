<?php

namespace Despawn\Filament\Resources\ThreadResource\Pages;

use Despawn\Filament\Resources\BoardResource;
use Despawn\Filament\Resources\ThreadResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditThread extends EditRecord
{
    protected static string $resource = ThreadResource::class;

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
