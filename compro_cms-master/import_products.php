<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$kernel->handle(Illuminate\Http\Request::capture());

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductVariant;
use App\Models\ProductReview;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

DB::statement('SET FOREIGN_KEY_CHECKS=0;');
ProductReview::truncate();
ProductVariant::truncate();
Product::truncate();
ProductCategory::truncate();
DB::statement('SET FOREIGN_KEY_CHECKS=1;');

$cat = ProductCategory::create([
    'title' => 'Laptops',
    'slug' => 'laptops'
]);

$products_data = [
    [
        "title" => "HP ProBook 430 G8 i7 13.3 inch Business Laptop",
        "slug" => "hp-probook-430-g8-i7-13-3-inch-business-laptop-clone",
        "description" => "<p>Laptop Hp Probook 430 G8, Core i7 - 1165G7, Ram 8GB/32GB</p>\n<p>Spesifikasi:<br />\n- Procecor : Intel Core i7 - 1165G7<br />\n- Vga : Intel Iris Xe Graphics<br />\n- Ram : 8GB/32GB<br />\n- Layar : 13,3 inc</p>\n<p>Kelengkapan :<br />\n- Unit<br />\n- Adaptor</p>\n<p>Keterangan :<br />\n-Kondisi Fisik Barang As-Is<br />\n-Tidak termasuk SSD</p>",
        "price" => 4330400,
        "price_before_discount" => 5413000,
        "discount_percent" => 20,
        "is_gajian_sale" => 1,
        "is_free_ongkir" => 1,
        "stock" => 27,
        "total_sales" => 27,
        "average_rating" => 5.0,
        "rating_count" => 12,
        "image_path" => "https://market.cmsdutasolusi.co.id/wp-content/uploads/2024/10/HP-Probook-i5-3.avif",
        "status" => 1,
        "category_id" => $cat->id,
        "variants" => [
            ['name' => 'RAM', 'value' => '8GB', 'price' => 0, 'stock' => 15],
            ['name' => 'RAM', 'value' => '16GB', 'price' => 500000, 'stock' => 10],
            ['name' => 'RAM', 'value' => '32GB', 'price' => 1200000, 'stock' => 2],
            ['name' => 'Storage', 'value' => '256GB SSD', 'price' => 300000, 'stock' => 10],
            ['name' => 'Storage', 'value' => '512GB SSD', 'price' => 700000, 'stock' => 10],
        ]
    ],
    [
        "title" => "HP ProBook 430 G8 i5 13.3 inch Business Laptop",
        "slug" => "hp-probook-430-g8-13-3-inch",
        "description" => "<p>Laptop Hp Probook 430 G8, Core i5 - 1135G7, Ram 8GB</p>\n<p>Spesifikasi:<br />\n- Procecor : Intel Core i5 - 1135G7<br />\n- Vga : Intel Iris Xe Graphics<br />\n- Ram : 8GB<br />\n- Layar : 13,5 inc<br />\n- Lan, port, cam, wifi, speaker, batrai aman semua</p>\n<p>Kelengkapan :<br />\n- Unit<br />\n- Adaptor</p>\n<p>Keterangan :<br />\n-Kondisi Fisik Barang As-Is<br />\n-Tidak termasuk SSD</p>",
        "price" => 3800640,
        "price_before_discount" => 4100000,
        "discount_percent" => 7,
        "is_gajian_sale" => 0,
        "is_free_ongkir" => 1,
        "stock" => 1318,
        "total_sales" => 1318,
        "average_rating" => 4.9,
        "rating_count" => 450,
        "image_path" => "https://market.cmsdutasolusi.co.id/wp-content/uploads/2024/10/HP-Probook-i5-3.avif",
        "status" => 1,
        "category_id" => $cat->id,
        "variants" => [
            ['name' => 'RAM', 'value' => '8GB', 'price' => 0, 'stock' => 1000],
            ['name' => 'RAM', 'value' => '16GB', 'price' => 450000, 'stock' => 318],
            ['name' => 'Storage', 'value' => '128GB SSD', 'price' => 0, 'stock' => 500],
            ['name' => 'Storage', 'value' => '256GB SSD', 'price' => 250000, 'stock' => 818],
        ]
    ]
];

foreach ($products_data as $p_data) {
    $variants = $p_data['variants'];
    unset($p_data['variants']);
    
    $product = Product::create($p_data);

    foreach ($variants as $v) {
        ProductVariant::create([
            'product_id' => $product->id,
            'attribute_name' => $v['name'],
            'attribute_value' => $v['value'],
            'price_extra' => $v['price'],
            'stock' => $v['stock']
        ]);
    }

    // Add dummy reviews
    ProductReview::create([
        'product_id' => $product->id,
        'customer_name' => 'Budi Santoso',
        'rating' => 5,
        'comment' => 'Barang sangat bagus, pengiriman cepat sekali!',
        'status' => 1
    ]);
    ProductReview::create([
        'product_id' => $product->id,
        'customer_name' => 'Siti Aminah',
        'rating' => 4,
        'comment' => 'Layar jernih, performa mantap untuk coding.',
        'status' => 1
    ]);
}

echo "Successfully imported categories, products, variants, and reviews.";


