<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class WishList extends Model
{
    use HasFactory;

    // table name
    protected $table = 'wish_lists';

    protected $fillable = [
        'user_id',
        'product_id',
        'ip_address',
    ];

    // set ip_address to user ip address on create
    protected static function boot()
    {
        parent::boot();

        static::saving(function ($wishlist) {
            $wishlist->ip_address = request()->ip();
        });
    }

    /**
     * Get the user that owns the Wishlist
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * Get the product that owns the Wishlist
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
