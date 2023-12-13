<?php

// app/Models/Pembelian.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembelian extends Model
{
    use HasFactory;

    protected $fillable = ['film_id', 'jumlah_tiket', 'harga', 'total_harga', 'user_id', 'jumlah_pembayaran', 'tanggal_pembayaran'];

    public function film()
    {
        return $this->belongsTo(Film::class, 'film_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}