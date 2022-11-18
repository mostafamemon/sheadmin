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
        Schema::create('ecom_banners', function (Blueprint $table) {
            $table->id();
            $table->string('slider_1')->nullable();
            $table->string('slider_2')->nullable();
            $table->string('slider_3')->nullable();

            $table->string('right_banner_1')->nullable();
            $table->string('right_banner_2')->nullable();
            $table->string('right_banner_3')->nullable();

            $table->string('first_triple_banner_1')->nullable();
            $table->string('first_triple_banner_2')->nullable();
            $table->string('first_triple_banner_3')->nullable();

            $table->string('second_triple_banner_1')->nullable();
            $table->string('second_triple_banner_2')->nullable();
            $table->string('second_triple_banner_3')->nullable();

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
        Schema::dropIfExists('ecom_banners');
    }
};
