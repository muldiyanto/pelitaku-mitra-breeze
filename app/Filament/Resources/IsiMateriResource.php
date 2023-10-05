<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Set;
use Filament\Forms\Form;
use App\Models\IsiMateri;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Filament\Resources\Resource;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\IsiMateriResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\IsiMateriResource\RelationManagers;

class IsiMateriResource extends Resource
{
    protected static ?string $model = IsiMateri::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                 Select::make('materi_id')
                        ->relationship('materi', 'id')->preload(),
                TextInput::make('name')
                                 ->afterStateUpdated(fn (Set $set, ?string $state)
                                 => $set('slug', Str::slug($state))),
                                 Hidden::make('slug'),
                                 TextInput::make('jamlat'),
                                 TextInput::make('bahanajar'),
                                //  FileUpload::make('bahanajar')
                                // //  ->storeFiles(false)
                                //  ->columns(1)->multiple()
                                //  ->preserveFilenames()
                                //  ->directory('tmp_materi')
                                //  ->enableReordering()
                                //  ->openable()
                                //  ->downloadable()
                                //  ->storeFileNamesIn('original_Filename'),
                                 RichEditor::make('video'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
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
            'index' => Pages\ListIsiMateris::route('/'),
            'create' => Pages\CreateIsiMateri::route('/create'),
            'edit' => Pages\EditIsiMateri::route('/{record}/edit'),
        ];
    }
}
