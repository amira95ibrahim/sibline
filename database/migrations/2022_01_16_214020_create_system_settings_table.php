<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSystemSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('system_settings', function (Blueprint $table) {
            $table->id();
            $table->text('name')->nullable();
            $table->text('short_name')->nullable();
            $table->text('address')->nullable();
            $table->text('footer_text')->nullable();
            $table->text('phone')->nullable();
            $table->text('email')->nullable();
            $table->text('facebook')->nullable();
            $table->text('twitter')->nullable();
            $table->text('youtube')->nullable();
            $table->text('logo_header')->nullable();
            $table->text('logo_footer')->nullable();
            $table->text('favicon')->nullable();
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
        Schema::dropIfExists('system_settings');
    }
}
