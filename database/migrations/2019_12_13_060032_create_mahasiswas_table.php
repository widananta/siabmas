<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMahasiswasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mahasiswas', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('nim', 11)->unique();
            $table->string('nama', 50);
            $table->string('kelas', 35);
            $table->string('angkatan', 4);
            $table->char('jenis_kelamin', 1);
            $table->string('foto', 50)->nullable();
            $table->string('alamat', 120);
            $table->string('no_telp', 12);
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
        Schema::dropIfExists('mahasiswas');
    }
}
