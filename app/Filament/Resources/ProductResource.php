<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Product;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use App\Models\ProductCategory;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\ProductResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\ProductResource\RelationManagers;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?int $navigationSort = 3;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getNavigationGroup(): ?string
    {
        return __('Manage Products');
    }

    public static function getNavigationBadge(): ?string
    {
        if (auth()->user()->hasRole('super_admin') || auth()->user()->hasRole('admin')) {
            return static::$model::count();
        } else {
            return Product::where('user_id', auth()->user()->id)->count();
        }
    }

    public static function form(Form $form): Form
    {
        $product_categories = fn(string $search) => ProductCategory::where('name', 'like', "%{$search}%")
            ->doesntHave('parent')
            ->limit(20)->pluck('name', 'id');

        return $form
            ->schema([
                Forms\Components\Section::make()
                    ->schema([
                        Forms\Components\Select::make('store_id')
                            ->relationship('store', 'store_name')
                            ->searchable()
                            ->required(),
                        Forms\Components\Select::make('category_id')
                            ->relationship('product_category', 'name')
                            ->required()
                            ->searchable()
                            ->getSearchResultsUsing($product_categories)
                            ->getOptionLabelUsing(fn($value): ?string => ProductCategory::find($value)?->name)
                            ->label(trans('Select Category')),
                        Forms\Components\TextInput::make('name')
                            ->reactive()
                            ->afterStateUpdated(fn($state, callable $set) => $set('slug', Str::slug($state)))
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('base_price')
                            ->numeric()
                            ->minValue(0)
                            ->required(),
                        Forms\Components\Select::make('status')
                            ->options([
                                'unpublished' => 'Unpublished',
                                'published' => 'Published',
                            ])
                    ])->columns(2),
                Forms\Components\RichEditor::make('short_description')
                    ->required()
                    ->maxLength(500)
                    ->label('Short Description')
                    ->columnSpanFull(),
                Forms\Components\RichEditor::make('long_description')
                    ->required()
                    ->label('Long Description')
                    ->columnSpanFull(),

                Forms\Components\Section::make('Product Images')
                    ->description('Featured image and additional images for this Item')
                    ->schema([
                        Forms\Components\FileUpload::make('image')
                            ->image()
                            ->directory('products')
                            // ->required()
                            ->label('Featured Image')
                            ->columnSpanFull(),
                        Forms\Components\Repeater::make('product_images')
                            ->label('Additional Images')
                            ->relationship()
                            ->schema([
                                Forms\Components\FileUpload::make('image')
                                    ->image()
                                    ->directory('product_images')
                                    ->required()
                                    ->label('Product Image')
                                    ->columnSpanFull(),
                            ])
                            ->collapsible()
                            ->defaultItems(0)
                            ->grid(3)
                    ]),

                Forms\Components\Section::make('Product Variants')
                    ->description('List all the item variations')
                    ->schema([
                        Forms\Components\Repeater::make('variants')
                            ->itemLabel(fn(array $state): ?string => $state['variant_name'] ?? null)
                            ->relationship()
                            ->schema([
                                Forms\Components\TextInput::make('variant_name')
                                    ->required()
                                    ->columnSpanFull(),
                                Forms\Components\TextInput::make('price')
                                    ->numeric()
                                    ->minValue(0)
                                    ->required(),
                                Forms\Components\TextInput::make('stock')
                                    ->numeric()
                                    ->minValue(0)
                                    ->required(),
                            ])
                            ->columns(2)
                            ->collapsible()
                            ->defaultItems(0)
                            ->grid(3)
                    ]),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('store.store_name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('product_category.name')
                    ->formatStateUsing(fn($state): string => $state ? Str::headline($state) : 'No Category Found!')
                    ->sortable(),
                Tables\Columns\TextColumn::make('name')
                    ->sortable()
                    ->searchable()
                    ->label(trans('Product Name')),
                Tables\Columns\ImageColumn::make('image')
                    ->label('Image')
                    ->toggleable()
                    ->rounded(),
                Tables\Columns\TextColumn::make('base_price')
                    ->numeric()
                    ->formatStateUsing(fn($state): string => 'GHS ' . number_format($state, 2))
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->colors([
                        'success' => 'published',
                        'danger' => 'unpublished',
                    ])
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label(trans('Creation Date'))
                    ->dateTime('M j, Y')->sortable(),
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
