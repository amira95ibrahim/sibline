<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCouponsGeneratingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupons_generating', function (Blueprint $table) {
            $table->id();
            $table-> text('purchase_order');
            $table-> text('contractor_name');
            $table-> text('material_name');
            $table-> text('storage_location');
            $table-> integer('RM_source');
            $table-> float('total_quantity');
            $table-> integer('contractor_number');
            $table-> integer('material_num');
            $table-> float('truck_Av_load_weight');
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
        Schema::dropIfExists('coupons_generating');
    }
}
