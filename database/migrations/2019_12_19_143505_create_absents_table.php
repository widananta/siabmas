<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAbsentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('absents', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('pertemuan_ke', 2);
            $table->dateTime('starts');
            $table->dateTime('ends');
            $table->string('kode', 6);
            $table->uuid('pengampu_id');
            $table->foreign('pengampu_id')->references('id')->on('pengampus')->onDelete('cascade');
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
        Schema::dropIfExists('absents');
    }
}
