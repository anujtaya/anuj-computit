<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDeliveryColumnsToJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('jobs', function (Blueprint $table) {
            $table->decimal("job_lat_pickup", 9,6)->nullable();
            $table->decimal("job_lng_pickup", 9,6)->nullable();
            $table->string('street_number_pickup')->nullable();
            $table->string('street_name_pickup')->nullable();
            $table->string('state_pickup')->nullable();
            $table->string('suburb_pickup')->nullable();
            $table->string('city_pickup')->nullable();
            $table->string('postcode_pickup')->nullable();
            $table->decimal("job_lat_dropoff", 9,6)->nullable();
            $table->decimal("job_lng_dropoff", 9,6)->nullable();
            $table->string('street_number_dropoff')->nullable();
            $table->string('street_name_dropoff')->nullable();
            $table->string('state_dropoff')->nullable();
            $table->string('suburb_dropoff')->nullable();
            $table->string('city_dropoff')->nullable();
            $table->string('postcode_dropoff')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('jobs', function (Blueprint $table) {
            $table->dropColumn('job_lat_pickup');
            $table->dropColumn('job_lng_pickup');
            $table->dropColumn('street_number_pickup');
            $table->dropColumn('street_name_pickup');
            $table->dropColumn('state_pickup');
            $table->dropColumn('suburb_pickup');
            $table->dropColumn('city_pickup');
            $table->dropColumn('postcode_pickup');
            $table->dropColumn('job_lat_dropoff');
            $table->dropColumn('job_lng_dropoff');
            $table->dropColumn('street_number_dropoff');
            $table->dropColumn('street_name_dropoff');
            $table->dropColumn('state_dropoff');
            $table->dropColumn('suburb_dropoff');
            $table->dropColumn('city_dropoff');
            $table->dropColumn('postcode_dropoff');
        });
    }
}
