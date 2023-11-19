<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul_film',
        'waktu',
        'tanggal_pemesanan',
        'row_kursi',
        'seat_kursi',
        'jumlah_tiket',
        'harga',
    ];
}