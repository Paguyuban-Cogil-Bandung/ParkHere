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
            $table->string('name_place'); 
            $table->integer('slot_tersedia'); 
            $table->string('image',100); 
            $table->integer('jumlah_slot'); 
            $table->integer('jumlah_booking'); 
            $table->string('lokasi', 100); 
            $table->text('url_stream'); 
            $table->integer('harga_awal'); 
            $table->integer('harga_per_jam');
            $table->timestamps(); 
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
