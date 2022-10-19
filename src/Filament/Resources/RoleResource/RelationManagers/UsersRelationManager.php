<?php

namespace Despawn\Filament\Resources\RoleResource\RelationManagers;

use Couchbase\Role;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables\Actions\AttachAction;
use Filament\Tables\Actions\DetachAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Resources\Form;

class UsersRelationManager extends RelationManager
{
    protected static string $relationship = 'users';

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('avatar')->rounded(),
                TextColumn::make('id'),
                TextColumn::make('name'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                AttachAction::make(),
            ])
            ->actions([
                DetachAction::make()
            ]);
    }

    protected function canAttach(): bool
    {
        if (! \Despawn\Policies\RolePolicy::denyIfRoleIsLowerLevel(auth()->user(), $this->getOwnerRecord())) {
            return false;
        }

        return auth()->user()->can('manage', \Despawn\Models\Role::class);
    }
}