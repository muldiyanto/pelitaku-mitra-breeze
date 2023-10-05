<?php

namespace App\Filament\Resources;

use delete;
use stdClass;
use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Set;
use App\Models\Kategori;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Illuminate\Contracts\Cache\Store;
use Filament\Tables\Columns\TextColumn;
// use Filament\Forms\Components\FileUpload;
use Filament\Tables\Contracts\HasTable;
use Illuminate\Support\Facades\Storage;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use Yaza\LaravelGoogleDriveStorage\Gdrive;
use Google\Service\Storage as ServiceStorage;
use Symfony\Component\HttpFoundation\File\File;
use App\Filament\Resources\KategoriResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\KategoriResource\RelationManagers;
use Filament\Forms\Components\Hidden;

class KategoriResource extends Resource
{
    protected static ?string $model = Kategori::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Referensi';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
                    ->schema([
                        TextInput::make('name')
                        ->label('Nama Rumpun Manajemen Pelatihan')
                        ->maxLength(250)
                        ->required()
                        ->unique(ignoreRecord:true)
                        // ->live(debounce:800)
                        ->afterStateUpdated(fn (Set $set, ?string $state)
                           => $set('slug', Str::slug($state))),
                        Hidden::make('slug'),
                        // FileUpload::make('foto')->preserveFilenames(),
                        // FileUpload::make('foto')->disk('google')->preserveFilenames(),
                        // ->live(debounce:1000)

                    ])
                    ->columns(1),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('No')->state(
                    static function (HasTable $livewire, stdClass $rowLoop): string {
                        return (string) (
                            $rowLoop->iteration +
                            ($livewire->getTableRecordsPerPage() * (
                                $livewire->getTablePage() - 1
                            ))
                        );
                    }
                ),
                TextColumn::make('name')->label('Nama Rumpun Manajemen Pelatihan')
                ->searchable()
                ->sortable(),
                TextColumn::make('slug')
                //  ImageColumn::make('foto')
                // ->circular()
                // ->getImageUrl(
                //     function (Kategori $record) {
                //     // delete single

                //         Storage::disk('google')->get($record->foto)
                //     }
                // )
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
                ->after(function (Kategori $record) {
                    // delete single
                    if ($record->foto) {
                        Storage::disk('public')->delete($record->foto);
                    }
                    // ->before(function (Kategori $record) {
                    //     Storage::delete($record->foto);
                }),
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
            'index' => Pages\ListKategoris::route('/'),
            'create' => Pages\CreateKategori::route('/create'),
            'edit' => Pages\EditKategori::route('/{record}/edit'),
        ];
    }
}
