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
        //1
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
          'service_cat_id' => 1,
          'is_active' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);
        App\ServiceSubCategory::create([
          'service_subname' => 'Flat Battery',
          'service_cat_id' => 1,
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
        //2
        App\ServiceSubCategory::create([
          'service_subname' => 'Broken Down',
          'service_cat_id' => 2,
          'is_active' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);
        App\ServiceSubCategory::create([
          'service_subname' => 'Driving Lessons',
          'service_cat_id' => 2,
          'is_active' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);
        App\ServiceSubCategory::create([
          'service_subname' => 'Detailing',
          'service_cat_id' => 2,
          'is_active' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);
        App\ServiceSubCategory::create([
          'service_subname' => 'General',
          'service_cat_id' => 2,
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
          'service_subname' => 'Washing',
          'service_cat_id' => 2,
          'is_active' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);
        App\ServiceSubCategory::create([
          'service_subname' => 'Servicing',
          'service_cat_id' => 2,
          'is_active' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);
        App\ServiceSubCategory::create([
          'service_subname' => 'Locked Out',
          'service_cat_id' => 2,
          'is_active' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);
        App\ServiceSubCategory::create([
          'service_subname' => 'Flat Battery',
          'service_cat_id' => 2,
          'is_active' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);
        App\ServiceSubCategory::create([
          'service_subname' => 'Change Tyre',
          'service_cat_id' => 2,
          'is_active' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);
        App\ServiceSubCategory::create([
          'service_subname' => 'Other - Car',
          'service_cat_id' => 2,
          'is_active' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);
        //3
        //4
        App\ServiceSubCategory::create([
          'service_subname' => 'Baby Sitting',
          'service_cat_id' => 4,
          'is_active' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);
        App\ServiceSubCategory::create([
          'service_subname' => 'Child Minding',
          'service_cat_id' => 4,
          'is_active' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);
        App\ServiceSubCategory::create([
          'service_subname' => 'General',
          'service_cat_id' => 4,
          'is_active' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);
        App\ServiceSubCategory::create([
          'service_subname' => 'Paliative Care',
          'service_cat_id' => 4,
          'is_active' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);
        App\ServiceSubCategory::create([
          'service_subname' => 'Reading',
          'service_cat_id' => 4,
          'is_active' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);
        App\ServiceSubCategory::create([
          'service_subname' => 'Respite',
          'service_cat_id' => 4,
          'is_active' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);
        App\ServiceSubCategory::create([
          'service_subname' => 'Other - Care and Support',
          'service_cat_id' => 4,
          'is_active' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);
        //5
        App\ServiceSubCategory::create([
          'service_subname' => 'Other - Catering',
          'service_cat_id' => 5,
          'is_active' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);
        //6
        App\ServiceSubCategory::create([
          'service_subname' => 'Other - Cleaning',
          'service_cat_id' => 6,
          'is_active' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);
        //7
        App\ServiceSubCategory::create([
          'service_subname' => 'Alterations',
          'service_cat_id' => 7,
          'is_active' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);
        App\ServiceSubCategory::create([
          'service_subname' => 'Cleaning',
          'service_cat_id' => 7,
          'is_active' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);
        App\ServiceSubCategory::create([
          'service_subname' => 'Repairs',
          'service_cat_id' => 7,
          'is_active' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);
        App\ServiceSubCategory::create([
          'service_subname' => 'Other - Clothing & Jewelery',
          'service_cat_id' => 7,
          'is_active' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);
        //8
        App\ServiceSubCategory::create([
          'service_subname' => 'Mobile Device Set-up',
          'service_cat_id' => 8,
          'is_active' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);
        App\ServiceSubCategory::create([
          'service_subname' => 'Repairs',
          'service_cat_id' => 8,
          'is_active' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);
        App\ServiceSubCategory::create([
          'service_subname' => 'Software Installation',
          'service_cat_id' => 8,
          'is_active' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);
        App\ServiceSubCategory::create([
          'service_subname' => 'Virus Removal',
          'service_cat_id' => 8,
          'is_active' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);
        App\ServiceSubCategory::create([
          'service_subname' => 'Networking',
          'service_cat_id' => 8,
          'is_active' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);
        App\ServiceSubCategory::create([
          'service_subname' => 'Other - Computers',
          'service_cat_id' => 8,
          'is_active' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);
        //9
        App\ServiceSubCategory::create([
          'service_subname' => 'Courier',
          'service_cat_id' => 9,
          'is_active' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);
        App\ServiceSubCategory::create([
          'service_subname' => 'Driving',
          'service_cat_id' => 9,
          'is_active' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);
        App\ServiceSubCategory::create([
          'service_subname' => 'Removalist',
          'service_cat_id' => 9,
          'is_active' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);
        App\ServiceSubCategory::create([
          'service_subname' => 'Shopping',
          'service_cat_id' => 9,
          'is_active' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);
        App\ServiceSubCategory::create([
          'service_subname' => 'Other - Deliveries',
          'service_cat_id' => 9,
          'is_active' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);
        //10
        App\ServiceSubCategory::create([
          'service_subname' => 'Other - Entertainment',
          'service_cat_id' => 10,
          'is_active' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);
        //11
        App\ServiceSubCategory::create([
          'service_subname' => 'Chocs',
          'service_cat_id' => 11,
          'is_active' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);
        App\ServiceSubCategory::create([
          'service_subname' => 'Flowers',
          'service_cat_id' => 11,
          'is_active' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);
        App\ServiceSubCategory::create([
          'service_subname' => 'Gifts',
          'service_cat_id' => 11,
          'is_active' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);
        App\ServiceSubCategory::create([
          'service_subname' => 'Other - Florist',
          'service_cat_id' => 11,
          'is_active' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);
        //12
        App\ServiceSubCategory::create([
          'service_subname' => 'Bond Cleaning',
          'service_cat_id' => 12,
          'is_active' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);
        App\ServiceSubCategory::create([
          'service_subname' => 'Weeding',
          'service_cat_id' => 12,
          'is_active' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);
        App\ServiceSubCategory::create([
          'service_subname' => 'Waste Removal',
          'service_cat_id' => 12,
          'is_active' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);
        App\ServiceSubCategory::create([
          'service_subname' => 'Pool Leak Detection',
          'service_cat_id' => 12,
          'is_active' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);
        App\ServiceSubCategory::create([
          'service_subname' => 'Pool Cleaning',
          'service_cat_id' => 12,
          'is_active' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);
        App\ServiceSubCategory::create([
          'service_subname' => 'Painting',
          'service_cat_id' => 12,
          'is_active' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);
        App\ServiceSubCategory::create([
          'service_subname' => 'Mowing',
          'service_cat_id' => 12,
          'is_active' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);
        App\ServiceSubCategory::create([
          'service_subname' => 'Maintenance',
          'service_cat_id' => 12,
          'is_active' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);
        App\ServiceSubCategory::create([
          'service_subname' => 'General Cleaning',
          'service_cat_id' => 12,
          'is_active' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);
        App\ServiceSubCategory::create([
          'service_subname' => 'Carpet Cleaning',
          'service_cat_id' => 12,
          'is_active' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);
        App\ServiceSubCategory::create([
          'service_subname' => 'Other - Home & Garden',
          'service_cat_id' => 12,
          'is_active' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);
        //13
        App\ServiceSubCategory::create([
          'service_subname' => 'Change Lightbulb',
          'service_cat_id' => 13,
          'is_active' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);
        App\ServiceSubCategory::create([
          'service_subname' => 'Flat Pack Installation',
          'service_cat_id' => 13,
          'is_active' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);
        App\ServiceSubCategory::create([
          'service_subname' => 'Gutter Cleaning',
          'service_cat_id' => 13,
          'is_active' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);
        App\ServiceSubCategory::create([
          'service_subname' => 'Home Maintenance',
          'service_cat_id' => 13,
          'is_active' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);
        App\ServiceSubCategory::create([
          'service_subname' => 'Systems Setup eg TV/Stereo',
          'service_cat_id' => 13,
          'is_active' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);
        App\ServiceSubCategory::create([
          'service_subname' => 'Other - Handyman Services',
          'service_cat_id' => 13,
          'is_active' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);
        //14
        App\ServiceSubCategory::create([
          'service_subname' => 'Hairdresser',
          'service_cat_id' => 14,
          'is_active' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);
        App\ServiceSubCategory::create([
          'service_subname' => 'Make-up',
          'service_cat_id' => 14,
          'is_active' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);
        App\ServiceSubCategory::create([
          'service_subname' => 'Massage',
          'service_cat_id' => 14,
          'is_active' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);
        App\ServiceSubCategory::create([
          'service_subname' => 'Personal Trainer',
          'service_cat_id' => 14,
          'is_active' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);
        App\ServiceSubCategory::create([
          'service_subname' => 'Treatments',
          'service_cat_id' => 14,
          'is_active' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);
        App\ServiceSubCategory::create([
          'service_subname' => 'Other - Health & Beauty',
          'service_cat_id' => 14,
          'is_active' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);
        //15
        App\ServiceSubCategory::create([
          'service_subname' => 'Home Maintenance Services',
          'service_cat_id' => 15,
          'is_active' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);
        //16
        App\ServiceSubCategory::create([
          'service_subname' => 'Long Term',
          'service_cat_id' => 16,
          'is_active' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);
        App\ServiceSubCategory::create([
          'service_subname' => 'Short Term',
          'service_cat_id' => 16,
          'is_active' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);
        App\ServiceSubCategory::create([
          'service_subname' => 'Other - House Sitting',
          'service_cat_id' => 16,
          'is_active' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);
        //17
        App\ServiceSubCategory::create([
          'service_subname' => 'Dry Cleaning',
          'service_cat_id' => 17,
          'is_active' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);
        App\ServiceSubCategory::create([
          'service_subname' => 'Ironing',
          'service_cat_id' => 17,
          'is_active' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);
        App\ServiceSubCategory::create([
          'service_subname' => 'General - Washing',
          'service_cat_id' => 17,
          'is_active' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);
        App\ServiceSubCategory::create([
          'service_subname' => 'Linen - Blankets',
          'service_cat_id' => 17,
          'is_active' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);
        App\ServiceSubCategory::create([
          'service_subname' => 'Linen - Doonas',
          'service_cat_id' => 17,
          'is_active' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);
        App\ServiceSubCategory::create([
          'service_subname' => 'Linen - Pillows',
          'service_cat_id' => 17,
          'is_active' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);
        App\ServiceSubCategory::create([
          'service_subname' => 'Linen - Sheets',
          'service_cat_id' => 17,
          'is_active' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);
        App\ServiceSubCategory::create([
          'service_subname' => 'Other - Washing',
          'service_cat_id' => 17,
          'is_active' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);
        //18
        App\ServiceSubCategory::create([
          'service_subname' => 'Change Locks',
          'service_cat_id' => 18,
          'is_active' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);
        App\ServiceSubCategory::create([
          'service_subname' => 'Keys Cut',
          'service_cat_id' => 18,
          'is_active' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);
        App\ServiceSubCategory::create([
          'service_subname' => 'Locked Out',
          'service_cat_id' => 18,
          'is_active' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);
        App\ServiceSubCategory::create([
          'service_subname' => 'Other - Locksmith',
          'service_cat_id' => 18,
          'is_active' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);
        //19
        App\ServiceSubCategory::create([
          'service_subname' => 'Digital',
          'service_cat_id' => 19,
          'is_active' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);
        App\ServiceSubCategory::create([
          'service_subname' => 'Print',
          'service_cat_id' => 19,
          'is_active' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);
        App\ServiceSubCategory::create([
          'service_subname' => 'General/Other',
          'service_cat_id' => 19,
          'is_active' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);
        //20
        App\ServiceSubCategory::create([
          'service_subname' => 'Dog Walking',
          'service_cat_id' => 20,
          'is_active' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);
        App\ServiceSubCategory::create([
          'service_subname' => 'Washing/Grooming',
          'service_cat_id' => 20,
          'is_active' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);
        App\ServiceSubCategory::create([
          'service_subname' => 'Feeding',
          'service_cat_id' => 20,
          'is_active' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);
        App\ServiceSubCategory::create([
          'service_subname' => 'Holiday Minding',
          'service_cat_id' => 20,
          'is_active' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);
        App\ServiceSubCategory::create([
          'service_subname' => 'Other - Pet Care',
          'service_cat_id' => 20,
          'is_active' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);
        //21
        App\ServiceSubCategory::create([
          'service_subname' => 'Accounting',
          'service_cat_id' => 21,
          'is_active' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);
        App\ServiceSubCategory::create([
          'service_subname' => 'Architecture',
          'service_cat_id' => 21,
          'is_active' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);
        App\ServiceSubCategory::create([
          'service_subname' => 'Draftsman/Council Plans',
          'service_cat_id' => 21,
          'is_active' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);
        App\ServiceSubCategory::create([
          'service_subname' => 'Lawyer',
          'service_cat_id' => 21,
          'is_active' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);  
        App\ServiceSubCategory::create([
          'service_subname' => 'General/Other - Professional Services',
          'service_cat_id' => 21,
          'is_active' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);
        //22
        App\ServiceSubCategory::create([
          'service_subname' => 'Support and Care',
          'service_cat_id' => 22,
          'is_active' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);
        //23
        App\ServiceSubCategory::create([
          'service_subname' => 'Other - Carpenter',
          'service_cat_id' => 23,
          'is_active' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);
        //24
        App\ServiceSubCategory::create([
          'service_subname' => 'Airconditioning',
          'service_cat_id' => 24,
          'is_active' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);
        App\ServiceSubCategory::create([
          'service_subname' => 'Appliance Repairs',
          'service_cat_id' => 24,
          'is_active' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);
        App\ServiceSubCategory::create([
          'service_subname' => 'Hot Water',
          'service_cat_id' => 24,
          'is_active' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);
        App\ServiceSubCategory::create([
          'service_subname' => 'Install',
          'service_cat_id' => 24,
          'is_active' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);  
        App\ServiceSubCategory::create([
          'service_subname' => 'No Power',
          'service_cat_id' => 24,
          'is_active' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);
        App\ServiceSubCategory::create([
          'service_subname' => 'Test and Tag',
          'service_cat_id' => 24,
          'is_active' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);
        App\ServiceSubCategory::create([
          'service_subname' => 'Tripping Circuit',
          'service_cat_id' => 24,
          'is_active' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);  
        App\ServiceSubCategory::create([
          'service_subname' => 'General/Other - Electrician',
          'service_cat_id' => 24,
          'is_active' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);
        //25
        App\ServiceSubCategory::create([
          'service_subname' => 'Other - Fencing',
          'service_cat_id' => 25,
          'is_active' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);
        //26
        App\ServiceSubCategory::create([
          'service_subname' => 'External',
          'service_cat_id' => 26,
          'is_active' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);
        App\ServiceSubCategory::create([
          'service_subname' => 'Internal',
          'service_cat_id' => 26,
          'is_active' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);
        App\ServiceSubCategory::create([
          'service_subname' => 'Repairing',
          'service_cat_id' => 26,
          'is_active' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);
        App\ServiceSubCategory::create([
          'service_subname' => 'General/Other - Painter',
          'service_cat_id' => 26,
          'is_active' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);
        //27
        App\ServiceSubCategory::create([
          'service_subname' => 'Blocked Drains',
          'service_cat_id' => 27,
          'is_active' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);
        App\ServiceSubCategory::create([
          'service_subname' => 'Patching',
          'service_cat_id' => 27,
          'is_active' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);
        App\ServiceSubCategory::create([
          'service_subname' => 'No Water',
          'service_cat_id' => 27,
          'is_active' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);
        App\ServiceSubCategory::create([
          'service_subname' => 'Leaking Toilets',
          'service_cat_id' => 27,
          'is_active' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);
        App\ServiceSubCategory::create([
          'service_subname' => 'Internal',
          'service_cat_id' => 27,
          'is_active' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);
        App\ServiceSubCategory::create([
          'service_subname' => 'Gas Leaks',
          'service_cat_id' => 27,
          'is_active' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);
        App\ServiceSubCategory::create([
          'service_subname' => 'External',
          'service_cat_id' => 27,
          'is_active' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);
        App\ServiceSubCategory::create([
          'service_subname' => 'Blocked Stromwater Drain',
          'service_cat_id' => 27,
          'is_active' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);
        App\ServiceSubCategory::create([
          'service_subname' => 'Blocked Sewer Drain',
          'service_cat_id' => 27,
          'is_active' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);
        App\ServiceSubCategory::create([
          'service_subname' => 'General/ Other - Plumber',
          'service_cat_id' => 27,
          'is_active' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);
        //28
        App\ServiceSubCategory::create([
          'service_subname' => 'Gutters',
          'service_cat_id' => 28,
          'is_active' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);
        App\ServiceSubCategory::create([
          'service_subname' => 'Leaking Roof',
          'service_cat_id' => 28,
          'is_active' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);
        App\ServiceSubCategory::create([
          'service_subname' => 'Other - Roofer',
          'service_cat_id' => 28,
          'is_active' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);
        //29
        App\ServiceSubCategory::create([
          'service_subname' => 'Other - Tiler',
          'service_cat_id' => 29,
          'is_active' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);
        //30
        App\ServiceSubCategory::create([
          'service_subname' => 'Piano',
          'service_cat_id' => 30,
          'is_active' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);
        App\ServiceSubCategory::create([
          'service_subname' => 'Guitar',
          'service_cat_id' => 30,
          'is_active' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);
        App\ServiceSubCategory::create([
          'service_subname' => 'Violin',
          'service_cat_id' => 30,
          'is_active' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);
        App\ServiceSubCategory::create([
          'service_subname' => 'Cello',
          'service_cat_id' => 30,
          'is_active' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);
        App\ServiceSubCategory::create([
          'service_subname' => 'Flute',
          'service_cat_id' => 30,
          'is_active' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);
        App\ServiceSubCategory::create([
          'service_subname' => 'Trumpet',
          'service_cat_id' => 30,
          'is_active' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);
        App\ServiceSubCategory::create([
          'service_subname' => 'Voice',
          'service_cat_id' => 30,
          'is_active' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);
        App\ServiceSubCategory::create([
          'service_subname' => 'Other - Tuiton Music',
          'service_cat_id' => 30,
          'is_active' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);
        //31
        App\ServiceSubCategory::create([
          'service_subname' => 'Grade P-3',
          'service_cat_id' => 31,
          'is_active' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);
        App\ServiceSubCategory::create([
          'service_subname' => 'Grade 4-6',
          'service_cat_id' => 31,
          'is_active' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);
        App\ServiceSubCategory::create([
          'service_subname' => 'Grade 7-10',
          'service_cat_id' => 31,
          'is_active' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);
        App\ServiceSubCategory::create([
          'service_subname' => 'Grade 11-12',
          'service_cat_id' => 31,
          'is_active' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);
        App\ServiceSubCategory::create([
          'service_subname' => 'Special Needs',
          'service_cat_id' => 31,
          'is_active' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);
        App\ServiceSubCategory::create([
          'service_subname' => 'Unviersity Level',
          'service_cat_id' => 31,
          'is_active' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);
        App\ServiceSubCategory::create([
          'service_subname' => 'Other - Tutoring',
          'service_cat_id' => 31,
          'is_active' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);
        //32
        App\ServiceSubCategory::create([
          'service_subname' => 'Carer',
          'service_cat_id' => 32,
          'is_active' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);
        App\ServiceSubCategory::create([
          'service_subname' => 'Snake Removal',
          'service_cat_id' => 32,
          'is_active' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);
        App\ServiceSubCategory::create([
          'service_subname' => 'Vet',
          'service_cat_id' => 32,
          'is_active' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);
        App\ServiceSubCategory::create([
          'service_subname' => 'Other - Wildlife',
          'service_cat_id' => 32,
          'is_active' => true,
          'created_at' => date('Y-m-d h:m:s'),
        ]);
        //Next number goes here
    }
}
