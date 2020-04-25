<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSessionDraftJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('session_draft_jobs', function (Blueprint $table) {
            $table->string('id')->unique();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            //job information
            $table->string('title')->nullable();
            $table->char('status', 12)->nullable();//DRAFT
            $table->text('description')->nullable();
            $table->datetime('job_date_time')->nullable();
            $table->decimal("job_lat", 9,6)->nullable();
            $table->decimal("job_lng", 9,6)->nullable();
            $table->string('street_number')->nullable();
            $table->string('street_name')->nullable();
            $table->string('state')->nullable();
            $table->string('suburb')->nullable();
            $table->string('city')->nullable();
            $table->string('postcode')->nullable();
            //to enable job pin confirmation
            $table->string('service_category_name')->nullable();
            $table->string('service_subcategory_name')->nullable();
            $table->bigInteger('service_category_id')->unsigned()->nullable();
            $table->foreign('service_category_id')->references('id')->on('service_categories');
            $table->bigInteger('service_subcategory_id')->unsigned()->nullable();
            $table->foreign('service_subcategory_id')->references('id')->on('service_subcategories');
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
        Schema::dropIfExists('session_draft_jobs');
    }
}
