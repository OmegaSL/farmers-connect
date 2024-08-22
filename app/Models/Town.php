<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Town extends Model
{
    use HasFactory;

    protected $table = 'towns';

    protected $fillable = [
        'name',
        'district_id',
    ];

    /**
     * Get the district that owns the Town
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function district(): BelongsTo
    {
        return $this->belongsTo(District::class, 'district_id', 'id');
    }

    /**
     * Get all of the stores for the Town
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function stores(): HasMany
    {
        return $this->hasMany(Store::class, 'town_id', 'id');
    }
}
