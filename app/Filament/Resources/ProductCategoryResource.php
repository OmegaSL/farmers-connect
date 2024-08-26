<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use App\Models\ProductCategory;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\ProductCategoryResource\Pages;
use App\Filament\Resources\ProductCategoryResource\RelationManagers;

class ProductCategoryResource extends Resource
{
    protected static ?string $model = ProductCategory::class;

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?int $navigationSort = 2;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getNavigationGroup(): ?string
    {
        return __('Manage Products');
    }

    public static function form(Form $form): Form
    {
        $product_categories = fn(string $search) => ProductCategory::where('name', 'like', "%{$search}%")
            ->doesntHave('parent')
            ->limit(20)->pluck('name', 'id');

        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->reactive()
                    ->afterStateUpdated(fn($state, callable $set) => $set('slug', Str::slug($state)))
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('parent_id')
                    ->relationship('parent', 'name')
                    ->searchable()
                    ->getSearchResultsUsing($product_categories)
                    ->getOptionLabelUsing(fn($value): ?string => ProductCategory::find($value)?->name)
                    ->label(trans('Category')),
                Forms\Components\FileUpload::make('image')
                    // ->required()
                    ->image()
                    ->maxSize(1024 * 1024 * 2)
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('description')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('parent.name')
                    ->label(__('Parent Category'))
                    ->default('No Parent')
                    ->sortable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('name')
                    ->sortable()
                    ->searchable()
                    ->toggleable(),
                Tables\Columns\ImageColumn::make('image')
                    ->circular()
                    ->sortable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label(trans('Creation Date'))
                    ->dateTime('M j, Y')->sortable(),
            ])
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProductCategories::route('/'),
            // 'create' => Pages\CreateProductCategory::route('/create'),
            // 'edit' => Pages\EditProductCategory::route('/{record}/edit'),
        ];
    }
}
