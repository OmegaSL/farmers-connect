<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductCategory extends Model
{
    use HasFactory;

    protected $table = 'product_categories';

    protected $fillable = [
        'parent_id',
        'name',
        'slug',
        'image',
        'description',
        'status'
    ];

    // generate unique slug when ever a new category is created
    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->slug = Str::slug($model->name);
        });
    }

    /**
     * Get the category image.
     */
    protected function image(): Attribute
    {
        return Attribute::make(
            get: fn(?string $value) => $value ? asset('storage/' . $value) : asset('assets/images/products/download.jpg'),
        );
    }

    /**
     * Get the parent that owns the ProductCategory
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(self::class, 'parent_id', 'id');
    }

    /**
     * Get all of the sub_categories for the Category
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sub_categories(): HasMany
    {
        return $this->hasMany(self::class, 'parent_id', 'id');
    }

    /**
     * Get the top_category that owns the Category
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function top_category(): BelongsTo
    {
        return $this->belongsTo(User::class, 'parent_id', 'id');
    }

    /**
     * Get all of the products for the ProductCategory
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'category_id', 'id');
    }
}
