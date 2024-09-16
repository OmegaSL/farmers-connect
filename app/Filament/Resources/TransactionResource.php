<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TransactionResource\Pages;
use App\Filament\Resources\TransactionResource\RelationManagers;
use App\Models\Transaction;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TransactionResource extends Resource
{
    protected static ?string $model = Transaction::class;

    protected static ?string $recordTitleAttribute = 'transaction_id';

    protected static ?int $navigationSort = 7;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getNavigationGroup(): ?string
    {
        return __('Order Management');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id ')
                    ->relationship('user', 'name')
                    ->required()
                    ->searchable()
                    ->label(trans('User')),
                Forms\Components\Select::make('order_id ')
                    ->relationship('order', 'tracking_number')
                    ->required()
                    ->searchable()
                    ->label(trans('Order No')),
                Forms\Components\TextInput::make('transaction_id')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('amount')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('currency')
                    ->required()
                    ->maxLength(255)
                    ->default('USD'),
                Forms\Components\TextInput::make('payment_method')
                    ->maxLength(255),
                Forms\Components\TextInput::make('account_number')
                    ->maxLength(255),
                Forms\Components\TextInput::make('payment_reference')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('payment_status')
                    ->required()
                    ->maxLength(255)
                    ->default('pending'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.email')
                    ->sortable()
                    ->searchable()
                    ->toggleable()
                    ->default('-')
                    ->label('Customer Email'),
                // Tables\Columns\TextColumn::make('order.tracking_number')
                //     ->sortable()
                //     ->searchable()
                //     ->toggleable()
                //     ->label('Order No'),
                Tables\Columns\TextColumn::make('transaction_id')
                    ->sortable()
                    ->searchable()
                    ->toggleable()
                    ->label('Transaction ID'),
                Tables\Columns\TextColumn::make('payment_status')
                    ->badge()
                    ->colors([
                        'primary',
                        'warning' => fn($state): bool => $state === 'pending',
                        'danger' => fn($state): bool => $state === 'failed',
                        'success' => fn($state): bool => $state === 'success',
                    ])
                    ->sortable()
                    ->searchable()
                    ->toggleable()
                    ->label('Order Status'),
                Tables\Columns\TextColumn::make('order.status')
                    ->badge()
                    ->colors([
                        'primary',
                        'warning' => fn($state): bool => $state === 'pending',
                        'danger' => fn($state): bool => $state === 'cancelled',
                        'success' => fn($state): bool => $state === 'completed',
                    ])
                    ->sortable()
                    ->searchable()
                    ->toggleable()
                    ->label('Payment Status'),
                Tables\Columns\TextColumn::make('amount')
                    ->formatStateUsing(fn($record, $state): string => $record->currency . number_format($state, 2))
                    ->sortable()
                    ->searchable()
                    ->toggleable()
                    ->label('Total Price')
                    ->default(0),
                Tables\Columns\TextColumn::make('created_at')->label(trans('Creation Date'))
                    ->dateTime('M j, Y')->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTransactions::route('/'),
            // 'create' => Pages\CreateTransaction::route('/create'),
            // 'edit' => Pages\EditTransaction::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        if (auth()->user()->hasRole('super_admin') || auth()->user()->hasRole('admin')) {
            return parent::getEloquentQuery()
                ->withoutGlobalScopes([
                    SoftDeletingScope::class,
                ]);
        }

        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ])
            ->whereHas('order', function ($query) {
                $query->whereHas('order_items', function ($query) {
                    $query->whereHas('product', function ($query) {
                        $query->where('user_id', auth()->id());
                    });
                });
            });
    }
}
