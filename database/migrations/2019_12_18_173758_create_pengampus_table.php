<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengampusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengampus', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->integer('user_id')->nullable();
            $table->uuid('matkul_id')->unsigned();
            $table->string('tahun', 4);
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('matkul_id')->references('id')->on('matkuls');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pengampus');
    }
}
