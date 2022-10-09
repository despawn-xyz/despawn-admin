<?php

namespace Despawn\Filament\Resources\ThreadResource\Pages;

use Despawn\Filament\Resources\ThreadResource;
use Filament\Resources\Pages\CreateRecord;

class CreateThread extends CreateRecord
{
    protected static string $resource = ThreadResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = auth()->user()->id;

        return $data;
    }
}
