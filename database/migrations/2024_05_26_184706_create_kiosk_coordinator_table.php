<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKioskCoordinatorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kiosk_coordinator', function (Blueprint $table) {
            $table->id();
            $table-> text('coupon');
            $table-> integer('purcashe_number');
            $table-> text('contractor_name');
            $table-> integer('contractor_number');
            $table-> text('material_name');
            $table-> integer('material_num');
            $table-> text('RM_source');
            $table-> float('truck_plate');
            $table-> text('driver_name');
            $table-> integer('driver_number');
            $table-> text('storage_location');
            $table-> text('registeration_date_time');

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
        Schema::dropIfExists('kiosk_coordinator');
    }
}
