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
        Schema::create('ecom_categories', function (Blueprint $table) {
            $table->id();
            $table->integer('parent_id')->default(0);
            $table->string('category_name');
            $table->boolean('show_in_top_menu')->default(0);
            $table->dateTime('show_in_top_menu_date')->nullable();
            $table->string('category_banner')->nullable();
            $table->boolean('show_in_home_page')->default(0);
            $table->dateTime('show_in_home_page_date')->nullable();
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
        Schema::dropIfExists('ecom_categories');
    }
};
