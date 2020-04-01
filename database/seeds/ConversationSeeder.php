<?php

use Illuminate\Database\Seeder;

class ConversationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        App\Conversation::create([
          'job_id' => 1,
          'service_provider_id' => 2,
          'status' => 'OPEN',
          'created_at' => date('Y-m-d h:m:s'),
        ]);

        //
        App\Conversation::create([
          'job_id' => 1,
          'service_provider_id' => 3,
          'status' => 'OPEN',
          'created_at' => date('Y-m-d h:m:s'),
        ]);

        //
        App\Conversation::create([
          'job_id' => 1,
          'service_provider_id' => 4,
          'status' => 'OPEN',
          'created_at' => date('Y-m-d h:m:s'),
        ]);


        // $table->bigIncrements('id');
        // $table->bigInteger('job_id')->unsigned()->nullable();
        // $table->foreign('job_id')->references('id')->on('jobs');
        //
        // $table->string('status')->nullable(); //ARCHIVED; DELETED; OPEN;
        // $table->timestamps();
    }
}
