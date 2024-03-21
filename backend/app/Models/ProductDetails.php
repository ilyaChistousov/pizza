<?php

namespace App\Models;

use App\Enums\ProductSize;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class ProductDetails extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'size',
        'price',
    ];

    protected $casts = [
        'size' => ProductSize::class
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function scopeFindPrice(
        Builder $query,
        int $productId,
        ProductSize $size
    ): Model
    {
        return $query
            ->select('price', 'size')
            ->where([
                'product_id' => $productId,
                'size' => $size])
            ->first();
    }
}
