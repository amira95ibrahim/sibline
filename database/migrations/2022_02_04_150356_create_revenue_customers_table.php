<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRevenueCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('revenue_customers', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->integer('amount')->nullable();
            $table->float('percentage')->nullable();
            $table->float('commission')->nullable();
            $table->date('date')->nullable();
            $table->foreignId('revenue_id')->nullable()->constrained();
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
        Schema::dropIfExists('revenue_customers');
    }
}
