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
            $table->string('category_name');
            $table->boolean('show_in_search_bar')->default(0);
            $table->string('category_banner')->nullable();
            $table->boolean('show_in_home_page')->default(0);
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
