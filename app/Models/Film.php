<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    protected $fillable = [
        'judulFilm',
        'rilis',
        'genre',
        'rating',
        'deskripsi',
        'photo_path', 
    ];
    
    protected $guarded = [];
    
    use HasFactory;
}