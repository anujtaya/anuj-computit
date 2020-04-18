<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiceProviderPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_provider_payments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('stripe_account_id')->nullable();
            $table->string('account_status')->nullable();
            $table->string('notes')->nullable();
            $table->bigInteger("service_provider_id")->unsigned();
            $table->foreign('service_provider_id')->references('id')->on('users');
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
        Schema::dropIfExists('service_provider_payments');
    }
}
