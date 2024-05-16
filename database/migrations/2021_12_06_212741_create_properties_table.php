<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('brief')->nullable();
            $table->text('description')->nullable();
            $table->integer('min_investment');
            $table->integer('max_investment');
            $table->integer('rental_breakdown');
            $table->integer('target_Period');
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->text('image')->nullable();
            $table->text('thumb')->nullable();
            $table->text('video')->nullable();
            $table->integer('size');
            $table->enum('status', ["0","1"]);
            $table->softDeletes();
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
        Schema::dropIfExists('properties');
    }
}
