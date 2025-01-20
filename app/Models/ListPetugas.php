<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ListPetugas extends Model
{
    use HasFactory;
    protected $table = 'list_petugas';
    protected $primaryKey = 'id_list_petugas';

    /**
     * Atribut yang dapat diisi (mass assignable).
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'place_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
