<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Booking extends Model
{
    use HasFactory;
    protected $table = 'booking';
    protected $primaryKey = 'booking_id';

    /**
     * Atribut yang dapat diisi (mass assignable).
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'place_id',
        'name_user',
        'no_plat',
        'name_place',
        'status_booking',
        'status_bayar',
        'jam_checkin',
        'jam_checkout',
        'jam_bayar',
        'durasi',
        'harga_awal',
        'harga_per_jam',
        'total_bayar',
        'tambahan_bayar',
        'metode_bayar',
    ];
}
