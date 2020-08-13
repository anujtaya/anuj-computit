<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_payments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('job_id')->unsigned()->nullable();
            $table->foreign('job_id')->references('id')->on('jobs');
            $table->char('status', 10)->nullable(); //PAID/PENDING/FAILED/
            $table->float('job_price')->nullable();
            $table->float('payable_job_price')->nullable();
            $table->float('service_fee_percentage')->nullable();
            $table->float('service_fee_price')->nullable();
            $table->float('service_provider_gets')->nullable();
            $table->float('payment_processing_fee')->nullable();
            $table->boolean('is_gst_applicable')->nullable();
            $table->boolean('gst_fee_value')->nullable();
            $table->char('payment_method',10)->nullable();//ZIP/STRIPE/PAYPAL/CASH
            $table->string('payment_reference_number')->nullable();//ZIP/STRIPE/PAYPAL/CASH
            $table->string('notes')->nullable();
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
        Schema::dropIfExists('job_payments');
    }
}
