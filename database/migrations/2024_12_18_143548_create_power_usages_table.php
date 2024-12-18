<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePowerUsagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('power_usages', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->unsignedBigInteger('room_id'); // Foreign key ke tabel rooms
            $table->enum('power_status', ['on', 'off'])->default('off'); // Status daya
            $table->timestamps();

            // Relasi ke tabel rooms
            $table->foreign('room_id')->references('id')->on('rooms')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('power_usages');
    }
}
