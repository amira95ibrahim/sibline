<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->string('password');
            $table->string('name')->nullable();
            $table->date('birth_date')->nullable();
            $table->string('main_phone');
            $table->string('main_mobile');
            $table->foreignId('address_id')->nullable()->constrained();
            $table->foreignId('occupation_id')->nullable()->constrained();
            $table->string('passport_number')->unique();
            $table->string('passport_photo')->nullable();
            $table->text('image')->nullable();
            $table->string('uuid')->unique()->nullable();
            $table->string('platform')->nullable();
            $table->string('version')->nullable();
            $table->enum('is_verified', ["0","1"]);
            $table->enum('status', ["0","1"]);
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
        Schema::dropIfExists('customers');
    }
}
