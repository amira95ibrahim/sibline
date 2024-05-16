<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_accounts', function (Blueprint $table) {
            $table->id();
            $table->string('account_name')->nullable();
            $table->integer('account_number');
            $table->double('currency')->nullable();
             $table->double('ob_debit')->nullable();
              $table->double('ob_credit')->nullable();
            $table->double('m_debit')->nullable();
            $table->double('m_credit');
            $table->double('balance');
            $table->foreignId('project_id')->nullable()->constrained();
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
        Schema::dropIfExists('project_accounts');
    }
}
