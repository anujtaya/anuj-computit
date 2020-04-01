<?php

use Illuminate\Database\Seeder;

class ConversationMessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        App\ConversationMessage::create([
          'sender_id' => 2,
          'receiver_id' => 1,
          'conversation_id' => 1,
          'text' => 'Hi, looks like you are interested in my job offer.',
          'created_at' => date('Y-m-d h:m:10'),
        ]);
        App\ConversationMessage::create([
          'sender_id' => 2,
          'receiver_id' => 1,
          'conversation_id' => 1,
          'text' => 'Any cheap offer?',
          'created_at' => date('Y-m-d h:m:20'),
        ]);
        App\ConversationMessage::create([
          'sender_id' => 1,
          'receiver_id' => 2,
          'conversation_id' => 1,
          'text' => 'No!',
          'created_at' => date('Y-m-d h:m:30'),
        ]);

        App\ConversationMessage::create([
          'sender_id' => 1,
          'receiver_id' => 3,
          'conversation_id' => 2,
          'text' => 'How long will it take for you to reach my place to fix blah blah blah',
          'created_at' => date('Y-m-d h:m:s'),
        ]);
        App\ConversationMessage::create([
          'sender_id' => 3,
          'receiver_id' => 1,
          'conversation_id' => 2,
          'text' => 'I can come right away!',
          'created_at' => date('Y-m-d h:m:s'),
        ]);


        // $table->bigIncrements('id');
        //
        // $table->bigInteger('sender_id')->unsigned()->nullable();
        // $table->foreign('sender_id')->references('id')->on('users');
        //
        // $table->bigInteger('receiver_id')->unsigned()->nullable();
        // $table->foreign('receiver_id')->references('id')->on('users');
        //
        // $table->bigInteger('conversation_id')->unsigned()->nullable();
        // $table->foreign('conversation_id')->references('id')->on('conversations');
        //
        // $table->string('text')->nullable();
        // $table->json('json')->nullable();
        // $table->timestamps();
    }
}
