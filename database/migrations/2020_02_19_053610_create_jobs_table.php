<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    // The job has two types instant jobs and job that are posted to job board
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->datetime('job_date_time')->nullable();
            $table->string('status')->nullable(); // OPEN; PENDING; COMPLETED; CANCELLED
            $table->decimal("job_lat", 9,6)->nullable();
            $table->decimal("job_lng", 9,6)->nullable();
            $table->string('street_number')->nullable();
            $table->string('street_name')->nullable();
            $table->string('state')->nullable();
            $table->string('suburb')->nullable();
            $table->string('city')->nullable();
            $table->string('postcode')->nullable();
            //to enable job pin confirmation
            $table->char('job_pin', 4)->nullable();
            $table->char('job_type', 10)->nullable();
            $table->string('service_category_name')->nullable();
            $table->string('service_subcategory_name')->nullable();
            $table->bigInteger('service_category_id')->unsigned()->nullable();
            $table->foreign('service_category_id')->references('id')->on('service_categories');
            $table->bigInteger('service_seeker_id')->unsigned()->nullable();
            $table->foreign('service_seeker_id')->references('id')->on('users');
            $table->bigInteger('service_provider_id')->unsigned()->nullable();
            $table->foreign('service_provider_id')->references('id')->on('users');
            $table->bigInteger('service_subcategory_id')->unsigned()->nullable();
            $table->foreign('service_subcategory_id')->references('id')->on('service_subcategories');
            //user rating columns
            $table->char('service_seeker_rating', 1)->nullable();
            $table->char('service_provider_rating', 1)->nullable();
            $table->string('service_seeker_comment')->nullable();
            $table->string('service_provider_comment')->nullable();
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
        Schema::dropIfExists('jobs');
    }
}
