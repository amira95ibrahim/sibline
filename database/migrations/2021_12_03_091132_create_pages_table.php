<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->string('url')->unique();
            $table->string('name')->nullable();
            $table->string('title')->nullable();
            $table->string('content')->unique();
            $table->string('brief')->unique();
            $table->enum('open_in_new_tab', ["0","1"]);
            $table->enum('display_top_menu', ["0","1"]);
            $table->enum('display_sidebar', ["0","1"]);
            $table->integer('president');
            $table->foreignId('parent_id')->nullable()->constrained('pages');
            $table->text('icon')->nullable();
            $table->text('image')->nullable();
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
        Schema::dropIfExists('pages');
    }
}
