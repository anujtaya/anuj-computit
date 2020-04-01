<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConversationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conversations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('job_id')->unsigned()->nullable();
            $table->foreign('job_id')->references('id')->on('jobs');
            $table->bigInteger('service_provider_id')->unsigned()->nullable();
            $table->foreign('service_provider_id')->references('id')->on('users');
			
			//SULTAN - HOME - JSON PROPERTY ADD
			$table->json('json')->nullable();

            $table->string('status')->nullable(); //ARCHIVED; DELETED; OPEN;
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
        Schema::dropIfExists('conversations');
    }
}
