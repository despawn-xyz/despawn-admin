<?php

namespace Despawn\Filament\Resources;

use Despawn\Filament\Resources\BoardResource\Pages\CreateBoard;
use Despawn\Filament\Resources\BoardResource\Pages\EditBoard;
use Despawn\Filament\Resources\BoardResource\Pages\ListBoards;
use Despawn\Filament\Resources\BoardResource\RelationManagers\ThreadRelationManager;
use Despawn\Models\Board;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class BoardResource extends Resource
{
    protected static ?string $model = Board::class;

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
                Forms\Components\MarkdownEditor::make('description')
                    ->maxLength(10_000)
                    ->disableAllToolbarButtons()
                    ->enableToolbarButtons([
                        'bold',
                        'bulletList',
                        'edit',
                        'italic',
                        'preview',
                        'strike',
                    ]),
                Forms\Components\Select::make('category_id')
                    ->relationship('category', 'title')
                    ->label('Category')
                    ->searchable()
                    ->required(),
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
            ThreadRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListBoards::route('/'),
            'create' => CreateBoard::route('/create'),
            'edit' => EditBoard::route('/{record}/edit'),
        ];
    }
}
