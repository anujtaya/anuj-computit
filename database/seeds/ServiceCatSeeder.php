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
        //1
        App\ServiceCategory::create([
          'service_name' => 'Boat and Jetski',
          'is_active' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);
        //2
        App\ServiceCategory::create([
          'service_name' => 'Cars',
          'is_active' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);
        //3
        App\ServiceCategory::create([
          'service_name' => 'Caravans and Motorhomes',
          'is_active' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);
        //4     
        App\ServiceCategory::create([
          'service_name' => 'Care and Support',
          'is_active' => true,
          'created_at' => date('Y-m-d h:m:s'),
          ]);
        //5   
        App\ServiceCategory::create([
          'service_name' => 'Catering',
          'is_active' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);
        //6           
        App\ServiceCategory::create([
          'service_name' => 'Cleaning',
          'is_active' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);
        //7         
        App\ServiceCategory::create([
          'service_name' => 'Clothing and Jewelery',
          'is_active' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);
        //8           
        App\ServiceCategory::create([
          'service_name' => 'Computers and Mobile Devices',
          'is_active' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);
        //9   
        App\ServiceCategory::create([
          'service_name' => 'Deliveries',
          'is_active' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);
        //10          
        App\ServiceCategory::create([
          'service_name' => 'Entertainment',
          'is_active' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);
        //11           
        App\ServiceCategory::create([
          'service_name' => 'Florist',
          'is_active' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);
        //12           
        App\ServiceCategory::create([
          'service_name' => 'Garden and outdoor Maintenance Services',
          'is_active' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);
        //13          
        App\ServiceCategory::create([
          'service_name' => 'Handyman Services',
          'is_active' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);
        //14             
        App\ServiceCategory::create([
          'service_name' => 'Health and Beauty',
          'is_active' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);
        //15           
        App\ServiceCategory::create([
          'service_name' => 'Home Maintenance Services',
          'is_active' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);
        //16   
        App\ServiceCategory::create([
           'service_name' => 'House Sitting',
           'is_active' => true,
           'created_at' => date('Y-m-d h:m:s'),
        ]);
        //17     
         App\ServiceCategory::create([
           'service_name' => 'Laundry',
           'is_active' => true,
           'created_at' => date('Y-m-d h:m:s'),
          ]);
        //18   
        App\ServiceCategory::create([
          'service_name' => 'Locksmith',
          'is_active' => true,
          'created_at' => date('Y-m-d h:m:s'),

        ]);
        //19           
        App\ServiceCategory::create([
        'service_name' => 'Marketing',
        'is_active' => true,
        'created_at' => date('Y-m-d h:m:s'),
        ]);
        //20           
        App\ServiceCategory::create([
          'service_name' => 'Pet Care',
          'is_active' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);
        //21           
        App\ServiceCategory::create([
          'service_name' => 'Professional Services',
          'is_active' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);
        //22
        App\ServiceCategory::create([
          'service_name' => 'Support and Care',
          'is_active' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);
        //23
        App\ServiceCategory::create([
            'service_name' => 'Trades - Carpenter',
            'is_active' => true,
            'created_at' => date('Y-m-d h:m:s'),
        ]);
        //24
        App\ServiceCategory::create([
          'service_name' => 'Trades - Electrician',
          'is_active' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);
        //25
        App\ServiceCategory::create([
          'service_name' => 'Trades - Fencing',
          'is_active' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);
        //26
        App\ServiceCategory::create([
          'service_name' => 'Trades - Painter',
          'is_active' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);
        //27
        App\ServiceCategory::create([
          'service_name' => 'Trades - Plumber',
          'is_active' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);
        //28
        App\ServiceCategory::create([
          'service_name' => 'Trades - Roofer',
          'is_active' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);
        //29
        App\ServiceCategory::create([
          'service_name' => 'Trades - Tiler',
          'is_active' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);
        //30
        App\ServiceCategory::create([
          'service_name' => 'Tution Music',
          'is_active' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);
        //31
        App\ServiceCategory::create([
          'service_name' => 'Tutoring',
          'is_active' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);
        //32
        App\ServiceCategory::create([
          'service_name' => 'Wildlife',
          'is_active' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);
        //Next number goes here
    }
}
