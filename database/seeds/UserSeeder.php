<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $password = Hash::make('12345678');
      $password2 = Hash::make('987654321'); 
        //
        // Seeker account
        App\User::create([
          'first' => 'Sultan',
          'last' => 'Ashfaq',
          'email' => 'sultan.ashfaq@computit.com.au',
          'password' => $password,
          'user_type' => 1,
          'phone' => "0477651396",
          'is_verified' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);

        //Provider account
        App\User::create([
          'first' => 'John',
          'last' => 'Doe',
          'email' => 'tayaanuj@gmail.com',
          'password' => $password,
          'user_type' => 2,
          'phone' => "0477647917",
          'is_verified' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);
        //Provider account
        App\User::create([
          'first' => 'Tim',
          'last' => 'Burton',
          'email' => 'tim@test.com',
          'password' => $password,
          'user_type' => 2,
          'phone' => "0477647917",
          'is_verified' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);
        //Provider account
        App\User::create([
          'first' => 'Freddie',
          'last' => 'Mercury',
          'email' => 'freddie@test.com',
          'password' => $password,
          'user_type' => 2,
          'phone' => "0477647917",
          'is_verified' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);
        //Provider account
        App\User::create([
          'first' => 'Karen',
          'last' => 'Lavin',
          'email' => 'karen@local2local.com.au',
          'password' => $password2,
          'user_type' => 2,
          'phone' => "0477647917",
          'is_verified' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);
        //Provider account
        App\User::create([
          'first' => 'Peter',
          'last' => 'Stack',
          'email' => 'peter.stack@local2local.com.au',
          'password' => $password2 ,
          'user_type' => 2,
          'phone' => "0477647917",
          'is_verified' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);
    }
}
