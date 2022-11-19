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
        Schema::create('ecom_products', function (Blueprint $table) {
            $table->id();
            $table->integer('category_id')->default(0);
            $table->integer('sub_category_id')->default(0);

            $table->boolean('hot_product')->default(0);
            $table->boolean('new_arrival')->default(0);
            $table->boolean('top_selling')->default(0);
            $table->boolean('best_rated')->default(0);
            $table->boolean('clearense')->default(0);

            $table->boolean('user_rating')->default(5);

            $table->string('product_page_main_image');
            $table->string('product_page_other_image_1')->nullable();
            $table->string('product_page_other_image_2')->nullable();
            $table->string('product_page_other_image_3')->nullable();
            $table->string('hot_product_image')->nullable();

            $table->string('product_name');
            $table->string('price');
            $table->text('short_description')->nullable();
            $table->longText('long_description')->nullable();
            $table->string('keywords')->nullable();
            $table->boolean('in_stock')->default(1);

            $table->index(['product_name','keywords']);

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ecom_products');
    }
};
