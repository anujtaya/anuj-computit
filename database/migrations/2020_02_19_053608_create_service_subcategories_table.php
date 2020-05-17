<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiceSubcategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_subcategories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string("service_subname")->nullable();
            $table->bigInteger("service_cat_id")->unsigned()->nullable();
            $table->boolean("is_active")->nullable();
            $table->bigInteger("priority")->nullable();
            $table->foreign('service_cat_id')->references('id')->on('service_categories');
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
        Schema::dropIfExists('service_subcategories');
    }
}
