<?php

namespace App\Filament\Resources;

use Closure;
use Filament\Forms;
use Filament\Tables;
use App\Models\Order;
use App\Models\Product;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\ProductVariant;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\OrderResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\OrderResource\RelationManagers;
use App\Filament\Resources\OrderResource\RelationManagers\HistoriesRelationManager;
use App\Models\OrderItem;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $recordTitleAttribute = 'tracking_number';

    protected static ?int $navigationSort = 6;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getNavigationGroup(): ?string
    {
        return __('Order Management');
    }

    public static function form(Form $form): Form
    {
        // get the variant for the selected product
        // dd($form->model->order_items);
        // $variants = ProductVariant::where('product_id', $form->getState('product_id'))->get();
        $variants = ProductVariant::query();

        return $form
            ->schema([
                // Forms\Components\TextInput::make('tracking_number')
                //     ->required()
                //     ->maxLength(255),
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name')
                    ->disabledOn('edit')
                    ->searchable()
                    ->required(),
                Forms\Components\TextInput::make('total_amount')
                    ->disabledOn('edit')
                    ->required()
                    ->numeric()
                    ->minValue(0)
                    ->default(0),
                Forms\Components\Select::make('status')
                    ->required()
                    ->options([
                        'pending' => 'Pending',
                        'processing' => 'Processing',
                        'completed' => 'Completed',
                        'cancelled' => 'Cancelled',
                        'partial_refund' => 'Partial Refund',
                        'complete_refund' => 'Complete Refund',
                    ]),

                Forms\Components\Section::make('Order Items')
                    ->description('List all the items for this order')
                    ->schema([
                        Forms\Components\Repeater::make('order_items')
                            ->relationship()
                            // ->mutateRelationshipDataBeforeFillUsing(function (array $data): array {
                            //     // dd($data);
                            //     $data = OrderItem::where('order_id', $data['order_id'])
                            //         ->where('id', $data['id'])
                            //         ->whereHas('product', function (Builder $query) use ($data) {
                            //             $query->where('user_id', auth()->id());
                            //         })
                            //         ->first()
                            //         ?->toArray();
                            //     // dd($data);

                            //     return $data ?? [];
                            // })
                            ->schema([
                                Forms\Components\Select::make('product_id')
                                    ->relationship('product', 'name')
                                    ->searchable()
                                    ->required()
                                    ->reactive()
                                    ->afterStateUpdated(function ($state, callable $set) {
                                        $product = Product::find($state);
                                        if ($product) {
                                            $set('price', (float)number_format($product->sale_price ?? $product->base_price, 2));
                                            $variants = ProductVariant::where('product_id', $state)->get();
                                            $set('product_variant_id', $variants->first()->id ?? null);
                                            // dd($variants ?? null);
                                        }
                                    })
                                    // ->disabledOn('edit')
                                    ->columnSpanFull(),
                                Forms\Components\Select::make('product_variant_id')
                                    ->relationship('variant', 'variant_name')
                                    ->searchable()
                                    ->required()
                                    ->reactive()
                                    ->afterStateUpdated(function ($state, callable $set, $get) use ($variants) {
                                        $set('price', $variants->find($state)?->price ?? $get('price'));
                                    })
                                    ->getSearchResultsUsing(function (string $search, $get) use ($variants) {
                                        return $variants
                                            ->where('product_id', $get('product_id'))
                                            ->where('variant_name', 'like', "%{$search}%")
                                            ->limit(20)
                                            ->pluck('variant_name', 'id')
                                            ->toArray();
                                    })
                                    // ->getOptionLabelUsing(function ($value) use ($variants) {
                                    //     return $variants->find($value)?->variant_name;
                                    // })
                                    // ->disabledOn('edit')
                                    ->columnSpanFull(),
                                Forms\Components\TextInput::make('quantity')
                                    ->required()
                                    ->numeric()
                                    // ->disabledOn('edit')
                                    ->minValue(0),
                                Forms\Components\TextInput::make('price')
                                    ->numeric()
                                    ->minValue(0)
                                    // ->disabledOn('edit')
                                    ->required(),
                                Forms\Components\Select::make('status')
                                    ->options([
                                        'pending' => 'Pending',
                                        'completed' => 'Completed',
                                        'dropped' => 'Dropped',
                                        'delivered' => 'Delivered',
                                    ])
                                    ->required(),
                            ])
                            ->addable(false)
                            ->columns(2)
                            ->collapsible()
                            ->defaultItems(1)
                            ->grid(3)
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('tracking_number')
                    ->searchable(),
                Tables\Columns\TextColumn::make('user.name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('user.telephone')
                    ->formatStateUsing(fn($record): string => $record->user?->telephone ?? 'N/A')
                    ->label('Customer Phone')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('total_amount')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('id')
                    ->label('Coupon Used')
                    ->numeric()
                    ->formatStateUsing(fn($record): string => $record->coupons->first() ? 'Coupon: ' . $record->coupons->first()?->code : 'Not Used')
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->badge(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label(trans('Creation Date'))
                    ->dateTime('M j, Y')
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            HistoriesRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
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
            ->whereHas('order_items', function ($query) {
                $query->whereHas('product', function ($query) {
                    $query->where('user_id', auth()->id());
                });
            });
    }
}
