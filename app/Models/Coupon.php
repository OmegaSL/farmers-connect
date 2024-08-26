<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

use function PHPUnit\Framework\isEmpty;

class Coupon extends Model
{
    use HasFactory;

    protected $table = 'coupons';

    protected $fillable = [
        'code',
        'description',
        'discount_type',
        'discount_value',
        'usage_limit',
        'start_date',
        'end_date',
        'status',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($coupon) {
            if (isEmpty($coupon->code)) {
                $coupon->code = self::generateUniqueCode();
            }
        });
    }

    /**
     * Generate a unique coupon code of the specified length.
     *
     * @param int $length The length of the code to generate (default is 10)
     * @return string The unique coupon code
     */
    public static function generateUniqueCode($length = 10)
    {
        do {
            // Generate a random string of the specified length
            $code = Str::random($length);
        } while (Coupon::where('code', $code)->exists());

        return $code;
    }

    /**
     * The orders that belong to the Coupon
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function orders(): BelongsToMany
    {
        return $this->belongsToMany(Order::class, 'coupon_order', 'coupon_id', 'order_id');
    }
}
