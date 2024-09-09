<?php

namespace App\Models;

use function PHPUnit\Framework\isEmpty;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $fillable = [
        'user_id',
        'tracking_number',
        'total_amount',
        'status'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($order) {
            if (isEmpty($order->tracking_number)) {
                $order->tracking_number = self::generateTrackingNumber();
            }
        });
    }

    /**
     * Generate a unique tracking number for the order based on the format ORD-YYYYMMDD-UNIQUEID.
     *
     * @return string The generated tracking number
     */
    public static function generateTrackingNumber()
    {
        // Example format: ORD-YYYYMMDD-UNIQUEID
        $date = date('Ymd');
        $uniqueId = uniqid(); // You might replace this with an organization-specific unique ID generator

        $trackingNumber = "ORD-{$date}-{$uniqueId}";

        return $trackingNumber;
    }

    /**
     * Get the user that owns the Order
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * Get all of the order_items for the Order
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function order_items(): HasMany
    {
        return $this->hasMany(OrderItem::class, 'order_id', 'id');
    }

    /**
     * Get all of the histories for the Order
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function histories(): HasMany
    {
        return $this->hasMany(OrderHistory::class, 'order_id', 'id');
    }

    /**
     * The coupons that belong to the Order
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function coupons(): BelongsToMany
    {
        return $this->belongsToMany(Coupon::class, 'coupon_order', 'order_id', 'coupon_id');
    }

    /**
     * Get the transaction associated with the Order
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function transaction(): HasOne
    {
        return $this->hasOne(Transaction::class, 'order_id', 'id');
    }
}
