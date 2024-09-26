<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Spatie\Permission\Models\Role;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Validation\Rules\Unique;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\DateTimePicker;
use App\Filament\Resources\UserResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Filament\Resources\UserResource\RelationManagers\StoresRelationManager;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?int $navigationSort = 0;

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    public static function getNavigationGroup(): string
    {
        return __('User Management');
    }

    public static function getNavigationBadge(): string
    {
        return static::$model::count();
    }

    public static function form(Form $form): Form
    {
        if (auth()->user()->hasRole('super_admin')) {
            $roles = fn(string $search) => Role::where('name', 'like', "%$search%")
                ->limit(20)
                ->pluck('name', 'id');
        } else {
            $roles = fn(string $search) => Role::where('name', 'like', "%$search%")
                ->whereNotIn('name', ['super_admin'])
                ->limit(20)
                ->pluck('name', 'id');
        }

        return $form
            ->schema([
                Forms\Components\FileUpload::make('profile_pic')
                    ->image()
                    ->avatar()
                    ->disk('public')
                    ->directory('profiles')
                    ->nullable()
                    ->maxSize('2048'),
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->label(trans('Username'))
                    ->maxLength(255),
                Forms\Components\TextInput::make('first_name')
                    ->maxLength(255),
                Forms\Components\TextInput::make('last_name')
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->unique(ignorable: fn($record) => $record)
                    ->email()
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('telephone')
                    ->tel()
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('password')
                    ->password()
                    ->required(fn($record) => is_null($record))
                    ->maxLength(255)
                    ->autocomplete('off')
                    ->helperText('Leave empty to keep the current password.')
                    ->dehydrateStateUsing(fn($state) => !empty($state) ? bcrypt($state) : ''),
                Forms\Components\Select::make('user_type')
                    ->reactive()
                    ->options([
                        'admin' => 'Admin',
                        'user' => 'Normal User',
                        'farmer' => 'Farmer',
                    ])
                    ->disabledOn('edit')
                    ->default('user'),
                Forms\Components\Select::make('roles')
                    ->multiple()
                    ->relationship('roles', 'name')
                    ->getSearchResultsUsing($roles)
                    // ->getOptionLabelsUsing(fn($value): ?string => Role::find($value)?->name)
                    ->disabled(fn($record) => $record?->hasRole('super_admin')),
                Forms\Components\Toggle::make('status')
                    ->required()
                    ->default(true),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('profile_pic')
                    ->circular()
                    ->defaultImageUrl(fn($record) => User::gravatar($record->email))
                    ->label('Avatar'),
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                //                Tables\Columns\TextColumn::make('telephone')
                //                    ->searchable(),
                Tables\Columns\TextColumn::make('user_type')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\IconColumn::make('status')
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('user_type')
                    ->options([
                        'admin' => 'Admin',
                        'user' => 'Normal User',
                        'farmer' => 'Farmer',
                    ]),
                Tables\Filters\Filter::make('status')
                    //    ->default()
                    ->toggle()
                    ->query(fn(Builder $query): Builder => $query->where('status', false)),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
                    ->hidden(fn($record) => $record->hasRole('super_admin')),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            StoresRelationManager::class
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
}
