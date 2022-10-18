<?php

namespace Despawn\Filament\Resources;

use Despawn\Filament\Resources\CategoryResource\Pages\CreateCategory;
use Despawn\Filament\Resources\CategoryResource\Pages\EditCategory;
use Despawn\Filament\Resources\CategoryResource\Pages\ListCategories;
use Despawn\Models\Category;
use Despawn\Models\User;
use Despawn\Models\Role;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class CategoryResource extends Resource
{
    protected static ?string $model = Category::class;

    protected static ?string $navigationIcon = 'heroicon-o-view-boards';

    protected static ?string $navigationGroup = 'Forums';

    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255)
                    ->afterStateUpdated(fn ($state, callable $set) => $set('slug', \Str::slug($state)))
                    ->reactive(),
                Forms\Components\TextInput::make('slug')
                    ->required()
                    ->alphaDash()
                    ->maxLength(255)
                    ->unique('categories', 'title')
                    ->reactive(),
                Forms\Components\Textarea::make('description')
                    ->maxLength(500),
                Forms\Components\Toggle::make('private')
                    ->helperText('By making a category private, only select members and roles will be
                    able to view this category.'),
                Forms\Components\Select::make('allowed_roles')
                    ->searchable()
                    ->multiple()
                    ->getSearchResultsUsing(fn (string $search) => Role::where('title', 'like', "%{$search}%")->limit(50)->pluck('title', 'id'))
                    ->getOptionLabelUsing(fn ($value): ?string => Role::find($value)?->title)
                    ->nullable(),
                Forms\Components\Select::make('allowed_users')
                    ->searchable()
                    ->multiple()
                    ->getSearchResultsUsing(fn (string $search) => User::where('name', 'like', "%{$search}%")->limit(50)->pluck('name', 'id'))
                    ->getOptionLabelUsing(fn ($value): ?string => User::find($value)?->name)
                    ->nullable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id'),
                Tables\Columns\TextColumn::make('slug'),
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListCategories::route('/'),
            'create' => CreateCategory::route('/create'),
            'edit' => EditCategory::route('/{record}/edit'),
        ];
    }
}
