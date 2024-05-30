<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserIdToQuarryCoordinatorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('quarry_coordinator', function (Blueprint $table) {
            if (!Schema::hasColumn('quarry_coordinator', 'user_id')) {
                $table->unsignedBigInteger('user_id')->after('id');
            }
            // Add the foreign key constraint if it doesn't exist
            if (!Schema::hasColumn('quarry_coordinator', 'user_id')) {
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
        Schema::table('quarry_coordinator', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });
    }
}
