<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDataPageToProjectAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('project_accounts', function (Blueprint $table) {
            $table->boolean('type_replay')->nullable();
            $table->boolean('is_replay')->nullable();
            $table->text('comment')->nullable();
            $table->string('attachement')->nullable();
            $table->string('c_first_name')->nullable();
            $table->string('c_last_name')->nullable();
            $table->string('c_email')->nullable();
            $table->string('c_position')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('project_accounts', function (Blueprint $table) {
            $table->dropColumn('type_replay');
            $table->dropColumn('is_replay');
            $table->dropColumn('comment');
            $table->dropColumn('attachement');
            $table->dropColumn('c_first_name');
            $table->dropColumn('c_last_name');
            $table->dropColumn('c_email');
            $table->dropColumn('c_position');
        });
    }
}
