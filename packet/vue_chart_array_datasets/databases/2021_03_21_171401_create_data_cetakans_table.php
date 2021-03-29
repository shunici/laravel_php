<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataCetakansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_cetakans', function (Blueprint $table) {
            $table->increments('id');
            $table->string('kategori', 10);
            $table->string('label', 50)->nullable();
            $table->string('borderColor', 50)->nullable();
            $table->string('backgroundColor', 50)->nullable();
            $table->string('total', 50); //ini nantinya array yang di jsonparse
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
        Schema::dropIfExists('data_cetakans');
    }
}
