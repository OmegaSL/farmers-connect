<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'user_id',
        'store_id',
        'category_id',
        'name',
        'slug',
        'image',
        'short_description',
        'long_description',
        'base_price',
        'sale_price',
        'sku',
        'status'
    ];

    // get the user_id of the product on creation
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($product) {
            if (is_null($product->user_id)) {
                $product->user_id = auth()->user()->id;
            }

            $slug = Str::slug($product->name);
            $existingSlugs = Product::where('slug', 'like', "{$slug}%")->pluck('slug');

            for ($i = 0;; $i++) {
                $newSlug = $i ? "{$slug}-{$i}" : $slug;
                if (!$existingSlugs->contains($newSlug)) {
                    break;
                }
            }

            $product->slug = $newSlug;

            // generate a unique sku
            $existingSkus = Product::where('sku', 'like', "{$product->sku}%")->pluck('sku');
            $generate_sku = time();

            for ($i = 0;; $i++) {
                $newSku = $i ? "{$generate_sku}-{$i}" : $generate_sku;
                if (!$existingSkus->contains($newSku)) {
                    break;
                }
            }

            $product->sku = $newSku;
        });

        // delete product images from storage when deleting the product
        static::deleted(function ($product) {
            // also delete all the images associated with the product from the storage
            foreach ($product->product_images as $product_image) {
                // delete from database
                $product_image->delete();
                // delete from storage
                Storage::disk('public')->delete($product_image->image);
            }
        });
    }

    // get product available quantity from product variants
    public function getAvailableQuantityAttribute()
    {
        $total = 0;
        foreach ($this->variants as $variant) {
            $total += $variant->stock;
        }
        return $total;
    }

    protected function image(): Attribute
    {
        return Attribute::make(
            get: fn(?string $value) => $value ? asset('storage/' . $value) : asset('assets/images/products/download.jpg'),
        );
    }

    /**
     * Get the user that owns the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'users', 'id');
    }

    /**
     * Get the store that owns the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function store(): BelongsTo
    {
        return $this->belongsTo(Store::class, 'store_id', 'id');
    }

    /**
     * Get the category that owns the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product_category(): BelongsTo
    {
        return $this->belongsTo(ProductCategory::class, 'category_id', 'id');
    }

    /**
     * Get the product_images that owns the Product
     *
     * @return HasMany
     */
    public function product_images(): HasMany
    {
        return $this->hasMany(ProductImage::class, 'product_id', 'id');
    }

    /**
     * Get all of the variants for the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function variants(): HasMany
    {
        return $this->hasMany(ProductVariant::class, 'product_id', 'id');
    }

    /**
     * The promotions that belong to the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function promotions(): BelongsToMany
    {
        return $this->belongsToMany(Promotion::class, 'product_promotion', 'product_id', 'promotion_id');
    }

    /**
     * Get all of the order_items for the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function order_items(): HasMany
    {
        return $this->hasMany(OrderItem::class, 'product_id', 'id');
    }

    /**
     * Get all of the reviews for the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class, 'product_id', 'id')->where('is_approved', 1);
    }

    /**
     * Get all of the wishlists for the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function wishlists(): HasMany
    {
        return $this->hasMany(WishList::class, 'product_id', 'id');
    }
}
