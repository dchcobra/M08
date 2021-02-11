<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksCategories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('parent')->nullable();
            $table->foreign('parent')->references('id')->on('categories');
            $table->timestamps();
        });

        Schema::table('tasks', function(Blueprint $table) {
            $table->foreignId('category_id')->constrined()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // eliminem FK primer
        Schema::table('tasks', function(Blueprint $table) {
            $table->dropColumn('category_id');
        });
        // dp eliminem taula
        Schema::dropIfExists('categories');
    }
}
