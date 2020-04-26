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
            $table->integer('work_radius')->unsigned()->default(20)->nullable();
            $table->string('password');
            $table->string('profile_image_path')->nullable();
            $table->string('phone')->nullable();
            $table->boolean('is_verified')->default(0)->nullable();
            $table->boolean('is_online')->default(0)->nullable();
            $table->string('verification_code')->nullable();
            $table->char('rating', 10)->nullable();
            $table->json('properties')->nullable();
            //user location properties
            $table->decimal("user_lat", 9,6)->nullable();
            $table->decimal("user_lng", 9,6)->nullable();
            $table->string('user_state')->nullable();
            $table->string('user_city')->nullable();
            $table->string('user_postcode')->nullable();
            $table->string('user_full_address')->nullable();
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
