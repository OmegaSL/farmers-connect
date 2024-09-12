<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Store extends Model
{
    use HasFactory;

    protected $table = 'stores';

    protected $fillable = [
        'user_id',
        'town_id',
        'store_name',
        'store_slug',
        'address',
        'description',
        'status',
    ];

    // generate unique slug when ever a new store is created
    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->store_slug = Str::slug($model->store_name);
        });
    }

    /**
     * Get the user that owns the Store
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * Get the town that owns the Store
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function town(): BelongsTo
    {
        return $this->belongsTo(Town::class, 'town_id', 'id');
    }
}
