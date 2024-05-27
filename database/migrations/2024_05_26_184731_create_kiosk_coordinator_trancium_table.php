<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKioskCoordinatorTranciumTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kiosk_coordinator_trancium', function (Blueprint $table) {
            $table->id();
            $table-> text('coupon');
            $table-> integer('sales_order');
            $table-> text('customer_name');
            $table-> integer('customer_phone');
            $table-> text('material_name');
            $table-> integer('material_num');
            $table-> text('destination');
            $table-> float('truck_plate');
            $table-> text('truck_license');
            $table-> text('driver_name');
            $table-> integer('driver_number');
            $table-> float('Qty_loaded');
            $table-> text('registeration_date_time');
            $table->boolean('trancim');

            $table->timestamps();


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kiosk_coordinator_trancium');
    }
}
