<?php

namespace App\Filament\Resources\MateriResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Set;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\RelationManagers\RelationManager;

class IsineMateriRelationManager extends RelationManager
{
    protected static string $relationship = 'isimateris';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                                 ->afterStateUpdated(fn (Set $set, ?string $state)
                                 => $set('slug', Str::slug($state))),
                                 Hidden::make('slug'),
                                 TextInput::make('jamlat'),
                                 FileUpload::make('bahanajar')
                                //  ->storeFiles(false)
                                 ->columns(1)->multiple()
                                 ->preserveFilenames()
                                 ->directory('tmp_materi')
                                 ->enableReordering()
                                 ->openable()
                                 ->downloadable()
                                 ->storeFileNamesIn('original_Filename'),
                                 RichEditor::make('video'),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                Tables\Columns\TextColumn::make('name'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
}
