<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTokenGeneratorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('token_generator', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('id_nasabah')->nullable();
            $table->foreign('id_nasabah')->references('id')->on('nasabah')->onDelete('cascade');
            $table->string('token')->nullable();
            $table->dateTime('date_request')->nullable();
            $table->dateTime('date_expired')->nullable();
            $table->unsignedInteger('id_atm')->nullable();
            $table->foreign('id_atm')->references('id_atm')->on('atm')->onDelete('cascade')->nullable();
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
        Schema::dropIfExists('token_generator');
    }
}
