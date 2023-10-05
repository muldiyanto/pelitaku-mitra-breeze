<?php

namespace App\Filament\Resources;

use stdClass;
use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use Filament\Forms\Set;
use Doctrine\DBAL\Query;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Filament\Resources\Resource;
use Filament\Resources\Pages\Page;
use Filament\Forms\Components\Card;
use Illuminate\Support\Facades\Hash;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\UserResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\UserResource\RelationManagers;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Settings';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
                    ->schema([
                        TextInput::make('name')
                        ->required()
                        ->maxLength(250)
                        ->live(debounce:1000)
                        ->afterStateUpdated(fn (Set $set, ?string $state)
                            => $set('slug', Str::slug($state))),
                            TextInput::make('slug'),

                        TextInput::make('email')
                        ->label('Email Address')
                        ->required()
                        ->maxLength(50),

                        TextInput::make('password')
                        ->password()
                        ->required(fn (Page $livewire): bool =>  $livewire instanceof CreateRecord)
                        ->maxLength(50)
                        ->same('passwordConfirmation')
                        ->dehydrated(fn ($state) => filled($state))
                        ->dehydrateStateUsing(fn ($state) => Hash::make($state)),

                        TextInput::make('passwordConfirmation')
                        ->password()
                        ->required(fn (Page $livewire): bool =>  $livewire instanceof CreateRecord)
                        ->maxLength(50)
                        ->label('Password Confirmation')
                        ->dehydrated(false),

                        Select::make('roles')
                        ->multiple()
                        ->relationship('roles', 'name')->preload(),

                        Select::make('satker_id')
                        ->relationship('satker', 'name')->preload(),

                    ])
                    ->columns(1),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                textColumn::make('No')->state(
                    static function (HasTable $livewire, stdClass $rowLoop): string {
                        return (string) (
                            $rowLoop->iteration +
                            ($livewire->getTableRecordsPerPage() * (
                                $livewire->getTablePage() - 1
                            ))
                        );
                    }
                ),
                TextColumn::make('name')->limit(50)->sortable()->searchable(),
                TextColumn::make('email')->limit(50)->sortable()->searchable(),
                TextColumn::make('roles.name'),
                TextColumn::make('satker.name'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                ->iconButton(),
                Tables\Actions\DeleteAction::make()
                ->iconButton()
                ->requiresConfirmation(),
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }

    // public static function getEloquentQuery(): Builder
    // {
    //     $admins = User::whereHas('role', function ($query) {
    //         $query->where('name', 'admin');
    //     })->get()->pluck('id');
    //     return parent::getEloquentQuery()->whereNotIn('id', $admins);
    // }
}
