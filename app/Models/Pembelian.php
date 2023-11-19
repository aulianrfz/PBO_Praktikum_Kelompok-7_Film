<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pembelian extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nama_pemesan',
        'jumlah_tiket',
        'harga',
        'total_harga',
    ];
    public static function boot()
    {
        parent::boot();

        self::creating(function ($film) {
            $film->harga = $film->harga ?? 50000; 
        });
    }
    
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}