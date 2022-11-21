<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('user_type',20)->default('user');
        });

        $user = new User();
        $user->name = "Admin";
        $user->username = "sheadmin";
        $user->phone = "01788090909";
        $user->email = "support@gmail.com";
        $user->password = Hash::make('asdf1234');
        $user->address = "Dhaka";
        $user->delivery_location = "Dhaka";
        $user->user_type = "admin";
        $user->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
