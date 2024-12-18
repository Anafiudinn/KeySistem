<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('power_usage', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('room_id'); // Relasi ke tabel rooms
            $table->enum('power_status', ['on', 'off'])->default('off'); // Status daya
            $table->timestamps();

            // Foreign key ke tabel rooms
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
        Schema::dropIfExists('power_usage');
    }
};
