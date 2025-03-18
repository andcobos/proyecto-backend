<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'product_name',
        'sku',
        'price',
        'stock',
        'stock_status_id',
        'seller_id',
        'category_id',
    ];

    // Relacion StockStatus
    public function stockStatus(): BelongsTo
    {
        return $this->belongsTo(StockStatus::class, 'stock_status_id');
    }

    // Relacion Seller
    public function seller(): BelongsTo
    {
        return $this->belongsTo(Seller::class, 'seller_id');
    }

    // Relacion ProductCategory
    public function category(): BelongsTo
    {
        return $this->belongsTo(ProductCategory::class, 'category_id');
    }
}
