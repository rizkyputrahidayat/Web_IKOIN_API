<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTabungansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tabungans', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('id_nasabah');
            $table->foreign('id_nasabah')->references('id')->on('nasabah')->onDelete('cascade');
            $table->dateTime('tanggal');

            $table->unsignedInteger('id_penerima');
            $table->foreign('id_penerima')->references('id')->on('nasabah')->onDelete('cascade')->nullable();

            $table->unsignedInteger('id_pengirim');
            $table->foreign('id_pengirim')->references('id')->on('nasabah')->onDelete('cascade')->nullable();

            $table->double('nominal_debit')->nullable();
            $table->double('nominal_kredit')->nullable();

            $table->string('saldo');
            $table->string('keterangan');

            $table->integer('jenis_transaksi');
            // Setoran, Transfer, Penarikan, Merchant

            $table->unsignedInteger('id_atm');
            $table->foreign('id_atm')->references('id_atm')->on('atm')->onDelete('cascade')->nullable();

            $table->unsignedInteger('id_merchant');
            $table->foreign('id_merchant')->references('id_merchant')->on('merchant')->onDelete('cascade')->nullable();

            $table->integer('mode_transaksi');
            // Atm, Hp, Merchant
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
        Schema::dropIfExists('tabungans');
    }
}
