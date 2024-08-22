<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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
