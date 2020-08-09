<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(UserSeeder::class);
        // $this->call(ServiceCatSeeder::class);
        // $this->call(ServiceSubCatSeeder::class);
        // $this->call(JobSeeder::class);
        // $this->call(ConversationSeeder::class);
        // $this->call(ConversationMessageSeeder::class);
    }
}
