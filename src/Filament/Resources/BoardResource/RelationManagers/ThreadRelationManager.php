<?php

namespace Despawn\Filament\Resources\BoardResource\RelationManagers;

use Despawn\Filament\Resources\ThreadResource;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;

class ThreadRelationManager extends RelationManager
{
    protected static string $relationship = 'threads';

    protected static ?string $recordTitleAttribute = 'id';

    public static function form(Form $form): Form
    {
        return ThreadResource::form($form);
    }

    public static function table(Table $table): Table
    {
        return ThreadResource::table($table);
    }
}