<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoryApiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('history_api', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('jenis_service')->default('1001');
            $table->integer('jenis_device')->nullable();
            $table->dateTime('date')->nullable();
            $table->string('json_request')->nullable();
            $table->integer('status_request')->default('1');
            $table->string('keterangan')->nullable();
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
        Schema::dropIfExists('history_api');
    }
}
