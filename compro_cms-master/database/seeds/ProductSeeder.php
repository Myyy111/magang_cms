<?php

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::truncate();

        $products = [
            [
                "title" => "HP ProBook 430 G8 i7 13.3 inch Business Laptop",
                "slug" => "hp-probook-430-g8-i7-13-3-inch-business-laptop-clone",
                "description" => "<p>Laptop Hp Probook 430 G8, Core i7 - 1165G7, Ram 8GB/32GB</p>\n<p>Spesifikasi:<br />\n- Procecor : Intel Core i7 - 1165G7<br />\n- Vga : Intel Iris Xe Graphics<br />\n- Ram : 8GB/32GB<br />\n- Layar : 13,3 inc</p>\n<p>Kelengkapan :<br />\n- Unit<br />\n- Adaptor</p>\n<p>Keterangan :<br />\n-Kondisi Fisik Barang As-Is<br />\n-Tidak termasuk SSD</p>",
                "price" => 4330400,
                "stock" => 27,
                "image_path" => "https://market.cmsdutasolusi.co.id/wp-content/uploads/2024/10/HP-Probook-i5-3.avif",
                "status" => 1,
            ],
            [
                "title" => "HP ProBook 430 G8 i5 13.3 inch Business Laptop",
                "slug" => "hp-probook-430-g8-13-3-inch",
                "description" => "<p>Laptop Hp Probook 430 G8, Core i5 - 1135G7, Ram 8GB</p>\n<p>Spesifikasi:<br />\n- Procecor : Intel Core i5 - 1135G7<br />\n- Vga : Intel Iris Xe Graphics<br />\n- Ram : 8GB<br />\n- Layar : 13,5 inc<br />\n- Lan, port, cam, wifi, speaker, batrai aman semua</p>\n<p>Kelengkapan :<br />\n- Unit<br />\n- Adaptor</p>\n<p>Keterangan :<br />\n-Kondisi Fisik Barang As-Is<br />\n-Tidak termasuk SSD</p>",
                "price" => 3800640,
                "stock" => 1318,
                "image_path" => "https://market.cmsdutasolusi.co.id/wp-content/uploads/2024/10/HP-Probook-i5-3.avif",
                "status" => 1,
            ]
        ];

        foreach ($products as $p) {
            Product::create($p);
        }
    }
}
