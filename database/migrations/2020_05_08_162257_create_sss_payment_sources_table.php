<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSssPaymentSourcesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sss_payment_sources', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('sss_payment_id')->unsigned()->nullable();
            $table->string('card_reference')->nullable();
            $table->char('last_4', 4)->nullable();
            $table->string('brand')->nullable();
            $table->date('expiry')->nullable();
            $table->tinyInteger('is_default')->nullable();
            $table->foreign('sss_payment_id')->references('id')->on('sss_payments');
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
        Schema::dropIfExists('sss_payment_sources');
    }
}
