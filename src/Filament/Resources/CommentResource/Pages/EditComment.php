<?php

namespace Despawn\Filament\Resources\CommentResource\Pages;

use Despawn\Filament\Resources\BoardResource;
use Despawn\Filament\Resources\CommentResource;
use Despawn\Filament\Resources\ThreadResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditComment extends EditRecord
{
    protected static string $resource = CommentResource::class;

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
