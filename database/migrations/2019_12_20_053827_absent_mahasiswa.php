<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AbsentMahasiswa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    
    public function up()
    {
        Schema::create('absent_mahasiswa', function (Blueprint $table) {
            $table->uuid('absent_id');
            $table->foreign('absent_id')->references('id')->on('absents')->onDelete('cascade');
            $table->uuid('mahasiswa_id');
            $table->foreign('mahasiswa_id')->references('id')->on('mahasiswas')->onDelete('cascade');
            $table->string('status',10)->nullable();
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
        Schema::table('absent_mahasiswa', function (Blueprint $table) {
            //
        });
    }
}
