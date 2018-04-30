<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDatatransaksiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::dropIfExists('penyimpanan_simpanan');
        Schema::dropIfExists('penyimpanan_deposito');
        Schema::dropIfExists('penyimpanan_pembiayaan');

        Schema::create('penyimpanan_simpanan', function (Blueprint $table) {
            $table->increments('id');
            $table->string('id_p_simpanan')->unique();
            $table->string('id_users');
            $table->string('id_simpanan');
            $table->text('transaksi');
            $table->timestamps();
            $table->foreign('id_users')
                ->references('no_ktp')
                ->on('users')
                ->onDelete('cascade');
            $table->foreign('id_simpanan')
                ->references('id_simpanan')
                ->on('simpanan')
                ->onDelete('cascade');
        });

        Schema::create('penyimpanan_deposito', function (Blueprint $table) {
            $table->increments('id');
            $table->string('id_p_deposito')->unique();
            $table->string('id_users');
            $table->string('id_deposito');
            $table->text('transaksi');
            $table->timestamps();
            $table->foreign('id_users')
                ->references('no_ktp')
                ->on('users')
                ->onDelete('cascade');
            $table->foreign('id_deposito')
                ->references('id_deposito')
                ->on('deposito')
                ->onDelete('cascade');
        });

        Schema::create('penyimpanan_pembiayaan', function (Blueprint $table) {
            $table->increments('id');
            $table->string('id_p_simpanan')->unique();
            $table->string('id_users');
            $table->string('id_pembiayaan');
            $table->text('transaksi');
            $table->timestamps();
            $table->foreign('id_users')
                ->references('no_ktp')
                ->on('users')
                ->onDelete('cascade');
            $table->foreign('id_pembiayaan')
                ->references('id_pembiayaan')
                ->on('pembiayaan')
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
        Schema::dropIfExists('penyimpanan_simpanan');
        Schema::dropIfExists('penyimpanan_deposito');
        Schema::dropIfExists('penyimpanan_pembiayaan');
    }
}
