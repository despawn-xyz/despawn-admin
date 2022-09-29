<?php

namespace Despawn\Filament\Resources\CategoryResource\Pages;

use Despawn\Filament\Resources\CategoryResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCategory extends EditRecord
{
    protected static string $resource = CategoryResource::class;

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
