<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommissionTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('commission_transactions', function (Blueprint $table) {
            $table->id();
            $table->integer('percentage')->nullable();
            $table->integer('value')->nullable();
            $table->foreignId('broker_id')->nullable()->constrained();
            $table->foreignId('partner_id')->nullable()->constrained();
            $table->foreignId('order_id')->nullable()->constrained();
            $table->foreignId('wallet_transaction_id')->nullable()->constrained();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('commission_transactions');
    }
}
