<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('parking_place', function (Blueprint $table) {
            $table->id('place_id');
            $table->unsignedBigInteger('user_id');
            $table->integer('slot_tersedia'); 
            $table->integer('jumlah_slot'); 
            $table->integer('jumlah_booking'); 
            $table->string('lokasi', 100); 
            $table->text('url_stream'); 
            $table->integer('harga_awal'); 
            $table->integer('harga_per_jam');
            $table->string('petugas_1', 50);
            $table->string('petugas_2', 50)->nullable(); 
            $table->timestamps(); 

            // Foreign key
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parking_place');
    }
};
