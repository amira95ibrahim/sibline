<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserIdToSalesWeighbridgeOutTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sales_weighbridge_out', function (Blueprint $table) {
            if (!Schema::hasColumn('sales_weighbridge_out', 'user_id')) {
                $table->unsignedBigInteger('user_id')->after('id');
            }
            // Add the foreign key constraint if it doesn't exist
            if (!Schema::hasColumn('sales_weighbridge_out', 'user_id')) {
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sales_weighbridge_out', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });
    }
}
