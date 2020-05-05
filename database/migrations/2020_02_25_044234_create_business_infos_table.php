<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBusinessInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_infos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('business_name')->nullable();
            $table->string('business_email')->nullable();
            $table->string('description')->nullable();
            $table->boolean('status')->nullable();
            $table->boolean('gst_enabled')->nullable();
            $table->datetime('deleted')->nullable();
            //address fields
            $table->string('address_line_1')->nullable();
            $table->string('address_line_2')->nullable();
            $table->char('address_city', 60)->nullable();
            $table->char('address_state', 60)->nullable();
            $table->char('abn', 13)->nullable();
            $table->char('address_postcode', 60)->nullable();
            $table->char('address_country', 60)->nullable();
            $table->timestamps();
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->foreign('user_id')
            ->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('business_infos');
    }
}
