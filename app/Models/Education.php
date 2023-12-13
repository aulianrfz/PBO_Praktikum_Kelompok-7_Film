<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    use HasFactory;

    protected $table ='education';

    protected $fillable = [
        'personal_id',
        'Edu_institution',
        'Loc_edu',
        'Start_date_edu',
        'End_date_edu',
        'Achievment',
        'Education_level',
    ];

    public function personal(){
        return $this->belongsTo(Personal::class, 'personal_id', 'id');
    }
}
