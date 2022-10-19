<?php

namespace Despawn\Filament\Resources;

use Despawn\Filament\Components\PermissionToggle;
use Despawn\Filament\Resources\RoleResource\Pages\CreateRole;
use Despawn\Filament\Resources\RoleResource\Pages\EditRole;
use Despawn\Filament\Resources\RoleResource\Pages\ListRoles;
use Despawn\Filament\Resources\RoleResource\RelationManagers\UsersRelationManager;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class RoleResource extends Resource
{
    protected static ?string $model = \Despawn\Models\Role::class;

    protected static ?string $navigationIcon = 'heroicon-o-view-boards';

    protected static ?string $navigationGroup = 'Roles';

    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Tabs::make('Heading')
                    ->tabs([
                        Forms\Components\Tabs\Tab::make('Overview')
                            ->schema([
                                Forms\Components\TextInput::make('name')
                                    ->required()
                                    ->maxLength(255)
                                    ->afterStateUpdated(fn ($state, callable $set) => $set('slug', \Str::slug($state)))
                                    ->reactive()
                                    ->helperText('Max value is 255.'),
                                Forms\Components\TextInput::make('title')
                                    ->required()
                                    ->maxLength(255)
                                    ->unique('roles', 'title', ignoreRecord: true)
                                    ->reactive()
                                    ->helperText('Max value is 255'),
                                Forms\Components\TextInput::make('level')
                                    ->maxValue(999)
                                    ->numeric()
                                    ->helperText('Max value is 999.'),
                            ]),
                        Forms\Components\Tabs\Tab::make('Permissions')
                            ->schema(static::permissions())
                            ->visibleOn('edit'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id'),
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('title'),
                Tables\Columns\TextColumn::make('level'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            UsersRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListRoles::route('/'),
            'create' => CreateRole::route('/create'),
            'edit' => EditRole::route('/{record}/edit'),
        ];
    }

    public static function permissions(): array
    {
        return [
            PermissionToggle::make('View Categories')
                ->permissionToggle('view', \Despawn\Models\Category::class)
                ->helperText('Allows members to view categories by default.'),
            PermissionToggle::make('Manage Categories')
                ->permissionToggle('manage', \Despawn\Models\Category::class)
                ->helperText('Allows members to create, edit, delete categories.'),
            PermissionToggle::make('Manage Roles')
                ->permissionToggle('manage', \Despawn\Models\Role::class)
                ->helperText('Allows members to create, edit, and delete roles.'),
            PermissionToggle::make('View Boards')
                ->permissionToggle('view', \Despawn\Models\Board::class)
                ->helperText('Allows members to view boards by default.'),
            PermissionToggle::make('Manage Boards')
                ->permissionToggle('manage', \Despawn\Models\Board::class)
                ->helperText('Allows members to create, edit, and delete boards by default.'),
            PermissionToggle::make('View Threads')
                ->permissionToggle('view', \Despawn\Models\Thread::class)
                ->helperText('Allows members to view threads by default.'),
            PermissionToggle::make('Manage Threads')
                ->permissionToggle('manage', \Despawn\Models\Thread::class)
                ->helperText('Allows members to delete threads by default.'),
            PermissionToggle::make('View Audit log')
                ->permissionToggle('view-audit-log')
                ->helperText('Allows members to view a record of who made which changes in the server'),
            PermissionToggle::make('Administrator')
                ->permissionToggle('administrator')
                ->helperText('Members with this permission will have every permission and will also bypass any specific permissions.
                 **This is a dangerous permission to grant.**'),
        ];
    }
}
