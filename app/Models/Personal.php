<?php

namespace App\Models;

use App\Models\Education;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Personal extends Model
{
    use HasFactory;

    protected $table ='personal';

    protected $fillable = [
        'deskripsi',
        'full_name',
        'email',
        'address',
        'city',
        'telephone_number',
        'link_profile',
    ];

    public function education(){

        return $this->hasMany(Education::class, 'personal_id', 'id');
    }

    public function experience(){

        return $this->hasMany(Experience::class, 'personal_id', 'id');
    }
}
