<?php

namespace App\Filament\Resources;

use stdClass;
use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Set;
use Filament\Forms\Form;
use App\Models\Pelatihan;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\PelatihanResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\PelatihanResource\RelationManagers\IsiMateriRelationManager;

class PelatihanResource extends Resource
{
    protected static ?string $model = Pelatihan::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Penyelengaaraan';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
                    ->schema([
                        TextInput::make('name')
                        ->live(debounce:800)
                        ->afterStateUpdated(fn (Set $set, ?string $state)
                          => $set('slug', Str::slug($state)))
                        ->maxLength(250)
                        ->required()
                        ->unique(ignoreRecord:true),
                        // ->live(debounce:1000)
                        Hidden::make('slug')->disabled(true),
                        Select::make('pemilikprogram_id')
                        ->relationship('pemilikprogram', 'name')->preload(),
                        Select::make('kategori_id')
                        ->relationship('kategori', 'name')->preload(),
                        TextInput::make('jamlat')
                            ->label('jamlat'),
                            TextInput::make('hari')
                            ->label('Jumlah Hari'),
                            DatePicker::make('tgl_mulai')
                            ->label('Tanggal Mulai'),
                            DatePicker::make('tgl_akhir')
                            ->label('Tanggal Selesai'),
                            Textarea::make('keterangan')
                            ->label('Keterangan'),
                            TextInput::make('jml_peserta')
                            ->label('Jumlah Peserta'),

                    ])
                    ->columns(2),
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
                TextColumn::make('name')->label('Nama Pelatihan')
                ->searchable()
                ->sortable(),
                TextColumn::make('pemilikprogram.name')->label('Pemilik Program')
                ->sortable()->searchable(),
                TextColumn::make('hari')->label('Jml Hari')
                ->sortable()->searchable(),
                 TextColumn::make('tgl_mulai')->label('Mulai')
                ->searchable()
                ->sortable(),
                TextColumn::make('tgl_akhir')->label('Selesai')
                ->searchable()
                ->sortable(),
                TextColumn::make('jml_peserta')->label('Jml Peserta')->html(),
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
        //    IsiMateriRelationManager::class,
           ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPelatihans::route('/'),
            'create' => Pages\CreatePelatihan::route('/create'),
            'edit' => Pages\EditPelatihan::route('/{record}/edit'),
        ];
    }
}
