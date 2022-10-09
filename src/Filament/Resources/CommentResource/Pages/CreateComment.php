<?php

namespace Despawn\Filament\Resources\CommentResource\Pages;

use Despawn\Filament\Resources\CommentResource;
use Despawn\Models\User;
use Filament\Resources\Pages\CreateRecord;

class CreateComment extends CreateRecord
{
    protected static string $resource = CommentResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['commenter_id'] = auth()->user()->id;
        $data['commentable_type'] = User::class;

        return $data;
    }
}
