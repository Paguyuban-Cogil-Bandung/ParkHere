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
        Schema::create('booking', function (Blueprint $table) {
            $table->id('booking_id'); // booking_id sebagai primary key dengan auto_increment
            $table->unsignedBigInteger('user_id'); // Menggunakan user_id untuk foreign key
            $table->unsignedBigInteger('place_id'); // Menggunakan place_id untuk foreign key
            $table->string('name_user', 80);
            $table->string('no_plat', 12);
            $table->string('name_place', 80);
            $table->enum('status_booking', ['Pending', 'Check In', 'Check Out', 'Cancelled'])->default('Pending');
            $table->enum('status_bayar', ['Bayar', 'Belum Bayar'])->default('Belum Bayar');
            $table->dateTime('jam_checkin')->nullable();
            $table->dateTime('jam_checkout')->nullable();
            $table->dateTime('jam_bayar')->nullable();
            $table->integer('durasi')->nullable();
            $table->integer('harga_awal')->nullable();
            $table->integer('harga_per_jam')->nullable();
            $table->integer('total_bayar')->nullable();
            $table->integer('tambahan_bayar')->nullable();
            $table->timestamps();

            // Foreign keys
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('place_id')->references('place_id')->on('parking_place')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booking');
    }
};
