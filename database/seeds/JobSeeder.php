<?php

use Illuminate\Database\Seeder;

class JobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        App\Job::create([
          'title' => 'Clean my carpet',
          'description' => 'I want my carpet to be cleaned, and when i cleaned I really mean CLEANED!',
          'status' => 'PENDING',
          'service_seeker_id' => 1,
          'service_subcategory_id' => 2,
          'created_at' => date('Y-m-d h:m:s'),
        ]);
    }
}
