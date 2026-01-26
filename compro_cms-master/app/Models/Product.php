<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'wc_product_id',
        'title',
        'sku',
        'slug',
        'description',
        'price',
        'stock',
        'image_path',
        'status',
        'price_before_discount',
        'discount_percent',
        'is_preorder',
        'is_gajian_sale',
        'is_free_ongkir',
        'total_sales',
        'average_rating',
        'rating_count',
    ];

    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'category_id');
    }

    public function variants()
    {
        return $this->hasMany(ProductVariant::class);
    }

    public function reviews()
    {
        return $this->hasMany(ProductReview::class);
    }
}
