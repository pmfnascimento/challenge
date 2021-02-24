<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarsDriversTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cars_drivers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cars_id')->nullable();
            $table->foreign('cars_id')->references('id')->on('cars')->onDelete('cascade');
            $table->unsignedBigInteger('drivers_id')->nullable();
            $table->foreign('drivers_id')->references('id')->on('drivers')->onDelete('cascade');
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
        Schema::dropIfExists('cars_drivers');
    }
}
