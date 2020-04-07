<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActiveJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('active_jobs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->datetime("schedule")->nullable();
            $table->bigInteger("service_provider_id")->unsigned();
            $table->bigInteger("service_seeker_id")->unsigned();
            $table->string("price_hold_code")->nullable();
            $table->string("promo_code")->nullable();
            $table->double("service_price")->nullable();
            $table->double("total_hold_price")->nullable();
            $table->double("discount_factor")->nullable();
            $table->double("total_hours")->nullable();
            $table->double("total_price")->nullable();
            $table->integer("sp_rating")->nullable();
            $table->integer("client_rating")->nullable();
            $table->string("client_comment")->nullable();
            $table->string('timezone_area')->nullable();
            $table->double('timezone_difference')->nullable();
            $table->decimal("job_lat", 9,6)->nullable();
            $table->decimal("job_lng", 9,6)->nullable();
            $table->integer("service_status")->nullable();    //o-completed/1-mark uncompleted/2-paymentissue/3-attention/4=accepted/5-pending
            $table->string("service_major_name")->nullable();
            $table->string("service_minor_name")->nullable();
            $table->double("gst_percent_value")->nullable();
            $table->double("service_fee")->nullable();
            $table->double("credit_card_fee")->nullable();
            $table->string("user_update")->nullable();
            //new field for payment response messages
            $table->boolean("payment_error")->nullable();
            $table->foreign('service_provider_id')->references('id')->on('users');
            $table->foreign('service_seeker_id')->references('id')->on('users');
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
        Schema::dropIfExists('active_jobs');
    }
}
