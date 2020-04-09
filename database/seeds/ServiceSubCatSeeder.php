<?php

use Illuminate\Database\Seeder;

class ServiceSubCatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        App\ServiceSubCategory::create([
          'service_subname' => 'Detailing',
          'service_cat_id' => 1,
          'is_active' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);
        App\ServiceSubCategory::create([
          'service_subname' => 'Driving Lessons',
          'service_cat_id' => 1,
          'is_active' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);
        App\ServiceSubCategory::create([
          'service_subname' => 'General',
          'service_cat_id' => 1,
          'is_active' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);
        App\ServiceSubCategory::create([
          'service_subname' => 'Fuel',
          'service_cat_id' => 2,
          'is_active' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);
        App\ServiceSubCategory::create([
          'service_subname' => 'Flat Battery',
          'service_cat_id' => 3,
          'is_active' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);
        App\ServiceSubCategory::create([
          'service_subname' => 'Locked Out',
          'service_cat_id' => 1,
          'is_active' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);
        App\ServiceSubCategory::create([
          'service_subname' => 'Servicing',
          'service_cat_id' => 1,
          'is_active' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);
        App\ServiceSubCategory::create([
          'service_subname' => 'Washing',
          'service_cat_id' => 1,
          'is_active' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);
        App\ServiceSubCategory::create([
          'service_subname' => 'Other - Boat and Jetski',
          'service_cat_id' => 1,
          'is_active' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);

    }
}
