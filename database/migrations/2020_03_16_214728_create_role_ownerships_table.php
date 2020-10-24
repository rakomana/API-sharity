<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoleOwnershipsTable extends Migration
{
    /**
     * Run the migrations.
     * Acomart and Organization morph.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('role_ownerships', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('role_id');
            $table->uuid('model_id');
            $table->uuid('model_type');
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
        Schema::dropIfExists('role_ownerships');
    }
}
