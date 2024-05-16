<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emails', function (Blueprint $table) {
            $table->id();
            $table->text('driver')->nullable();
            $table->text('host')->nullable();
            $table->text('port')->nullable();
            $table->text('username')->nullable();
            $table->text('password')->nullable();
            $table->text('encryption')->nullable();
            $table->text('from_address')->nullable();
            $table->text('from_name')->nullable();
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
        Schema::dropIfExists('emails');
    }
}
