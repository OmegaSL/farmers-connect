<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
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
        'description'
    ];

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
}
