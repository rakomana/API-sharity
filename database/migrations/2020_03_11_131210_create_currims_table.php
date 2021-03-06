<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCurrimsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('currims', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('id_or_passport');
            $table->string('nationality');
            $table->string('gender');
            $table->string('languages');
            $table->string('physical_address');
            $table->string('category');
            $table->string('phone_number');
            $table->string('documents');
            $table->string('video');
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
        Schema::dropIfExists('currims');
    }
}
