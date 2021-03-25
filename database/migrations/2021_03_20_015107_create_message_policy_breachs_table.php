<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessagePolicyBreachsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('message_policy_breachs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('status')->default('OPEN')->nullable(); //OPEN | CLOSED
            $table->string('source')->nullable(); //Message | BIO
            $table->text('notes')->nullable(); 
            $table->text('reported_message_text')->nullable(); 
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->bigInteger('conversation_id')->unsigned()->nullable();
            $table->foreign('conversation_id')->references('id')->on('conversations');
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
        Schema::dropIfExists('message_policy_breachs');
    }
}
