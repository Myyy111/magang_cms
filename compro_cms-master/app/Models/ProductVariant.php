<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'wc_variant_id',
        'attribute_name',
        'attribute_value',
        'price_extra',
        'stock'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
