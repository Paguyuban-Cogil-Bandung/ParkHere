<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ParkingPlace extends Model
{
    use HasFactory;
    protected $table = 'parking_place';
    protected $primaryKey = 'place_id';

    /**
     * Atribut yang dapat diisi (mass assignable).
     *
     * @var array
     */
    protected $fillable = [
        'slot_tersedia',
        'jumlah_slot',
        'jumlah_booking',
        'lokasi',
        'url_stream',
        'harga_awal',
        'harga_per_jam',
    ];

    public function listPetugas()
    {
        return $this->hasMany(ListPetugas::class, 'place_id');
    }
}
