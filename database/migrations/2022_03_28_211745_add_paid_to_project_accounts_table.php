<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPaidToProjectAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('project_accounts', function (Blueprint $table) {
            $table->boolean('authorization_request')->default(0);
            $table->boolean('authorization_status')->nullable();
            $table->text('authorization_comment')->nullable();
            $table->timestamp('authorizationSent_date_time')->nullable();
            $table->string('ac_name')->nullable();
            $table->string('ac_phone')->nullable();
            $table->string('ac_email')->nullable();
            $table->string('ac_address')->nullable();
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
            $table->dropColumn('authorization_request');
            $table->dropColumn('authorization_status');
            $table->dropColumn('authorization_comment');
            $table->dropColumn('authorizationSent_date_time');
            $table->dropColumn('ac_name');
            $table->dropColumn('ac_phone');
            $table->dropColumn('ac_email');
            $table->dropColumn('ac_address');
        });
    }
}
