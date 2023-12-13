<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    use HasFactory;

    protected $table ='experience';

    protected $fillable = [
        'personal_id',
        'Company_name',
        'Loc_org',
        'Start_date_org',
        'End_date_org',
        'Job_desc',
        'Job_title',
    ];

    public function personal(){
        return $this->belongsTo(Personal::class, 'personal_id' , 'id');
    }
}

