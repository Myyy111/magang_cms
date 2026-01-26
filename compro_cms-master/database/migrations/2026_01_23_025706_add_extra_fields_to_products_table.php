<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->decimal('price_before_discount', 15, 2)->nullable();
            $table->integer('discount_percent')->nullable();
            $table->boolean('is_preorder')->default(0);
            $table->boolean('is_gajian_sale')->default(0);
            $table->boolean('is_free_ongkir')->default(0);
            $table->integer('total_sales')->default(0);
            $table->decimal('average_rating', 3, 2)->default(0);
            $table->integer('rating_count')->default(0);
        });
    }

    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn([
                'price_before_discount', 'discount_percent', 'is_preorder', 
                'is_gajian_sale', 'is_free_ongkir', 'total_sales', 
                'average_rating', 'rating_count'
            ]);
        });
    }
};
