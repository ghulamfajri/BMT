<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDatamasterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('rekening');
        Schema::dropIfExists('simpanan');
        Schema::dropIfExists('deposito');
        Schema::dropIfExists('pembiayaan');

        Schema::create('rekening', function (Blueprint $table) {
            $table->increments('id');
            $table->string('id_rekening')->unique();
            $table->string('id_induk');
            $table->string('nama_rekening');
            $table->string('jenis_rekening');
            $table->text('detail');
            $table->timestamps();
        });

        Schema::create('simpanan', function (Blueprint $table) {
            $table->increments('id');
            $table->string('id_simpanan')->unique();
            $table->string('id_rekening');
            $table->string('jenis_simpanan');
            $table->string('nisbah');
            $table->string('saldo_minimal');
            $table->timestamps();
            $table->foreign('id_rekening')
                ->references('id_rekening')
                ->on('rekening')
                ->onDelete('cascade');
        });

        Schema::create('deposito', function (Blueprint $table) {
            $table->increments('id');
            $table->string('id_deposito')->unique();
            $table->string('id_rekening');
            $table->string('jenis_deposito');
            $table->string('nisbah');
            $table->string('durasi');
            $table->timestamps();
            $table->foreign('id_rekening')
                ->references('id_rekening')
                ->on('rekening')
                ->onDelete('cascade');
        });


        Schema::create('pembiayaan', function (Blueprint $table) {
            $table->increments('id');
            $table->string('id_pembiayaan')->unique();
            $table->string('id_rekening');
            $table->string('jenis_pembiayaan');
            $table->string('nisbah');
            $table->string('angsuran');
            $table->timestamps();
            $table->foreign('id_rekening')
                ->references('id_rekening')
                ->on('rekening')
                ->onDelete('cascade');
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rekening');
        Schema::dropIfExists('simpanan');
        Schema::dropIfExists('deposito');
        Schema::dropIfExists('pembiayaan');
    }
}
