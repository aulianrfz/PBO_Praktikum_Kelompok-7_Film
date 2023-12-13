<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tiket extends Model
{
    use HasFactory;

    protected $fillable = [
        'waktu',
        'tanggal_pemesanan',
        'row_kursi',
        'seat_kursi',
        'jumlah_tiket',
        'harga',
    ];

    public function film()
    {
        return $this->belongsTo(Film::class);
    }
}