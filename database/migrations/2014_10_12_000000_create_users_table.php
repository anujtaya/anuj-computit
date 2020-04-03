<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('first')->nullable();
            $table->string('last')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('default_timezone')->nullable();
            $table->tinyInteger('user_type')->nullable();
            $table->string('password');
            $table->string('profile_image_path')->nullable();
            $table->string('phone')->nullable();
            $table->boolean('is_verified')->default(0);
            $table->string('verification_code')->nullable();
            $table->char('rating', 10)->nullable();
            $table->json('properties')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
