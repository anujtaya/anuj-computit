<?php

use Illuminate\Database\Seeder;

class ServiceCatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        App\ServiceCategory::create([
          'service_name' => 'Boat and Jetski',
          'is_active' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);

        App\ServiceCategory::create([
          'service_name' => 'Car',
          'is_active' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);

        App\ServiceCategory::create([
          'service_name' => 'Caravans and Motorhomes',
          'is_active' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);
        App\ServiceCategory::create([
          'service_name' => 'Catering',
          'is_active' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);
        App\ServiceCategory::create([
          'service_name' => 'Cleaning',
          'is_active' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);
        App\ServiceCategory::create([
          'service_name' => 'Clothing and Jewelery',
          'is_active' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);

        App\ServiceCategory::create([
          'service_name' => 'Computers and Mobile Devices',
          'is_active' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);

        App\ServiceCategory::create([
          'service_name' => 'Deliveries',
          'is_active' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);
        App\ServiceCategory::create([
          'service_name' => 'Entertainment',
          'is_active' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);
        App\ServiceCategory::create([
          'service_name' => 'Florist',
          'is_active' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);
        App\ServiceCategory::create([
          'service_name' => 'Garden and outdoor Maintenance Services',
          'is_active' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);
        App\ServiceCategory::create([
          'service_name' => 'Health and Beauty',
          'is_active' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);
        App\ServiceCategory::create([
          'service_name' => 'Home Maintenance Services',
          'is_active' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);



        App\ServiceCategory::create([
           'service_name' => 'House Sitting',
           'is_active' => true,
           'created_at' => date('Y-m-d h:m:s'),
         ]);
         App\ServiceCategory::create([
           'service_name' => 'Laundry',
           'is_active' => true,
           'created_at' => date('Y-m-d h:m:s'),
           ]);


           App\ServiceCategory::create([
             'service_name' => 'Locksmith',
             'is_active' => true,
             'created_at' => date('Y-m-d h:m:s'),

           ]);
            App\ServiceCategory::create([
             'service_name' => 'Pet Care',
             'is_active' => true,
             'created_at' => date('Y-m-d h:m:s'),

           ]);
                App\ServiceCategory::create([
             'service_name' => 'Professional Services',
             'is_active' => true,
             'created_at' => date('Y-m-d h:m:s'),

           ]);
                App\ServiceCategory::create([
             'service_name' => 'Support and Care',
             'is_active' => true,
             'created_at' => date('Y-m-d h:m:s'),

           ]);
           App\ServiceCategory::create([
          'service_name' => 'Wildlife',
          'is_active' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);



    }
}
