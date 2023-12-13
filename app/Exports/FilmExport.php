<?php

namespace App\Exports;

use App\Models\Film;
use Maatwebsite\Excel\Concerns\FromCollection;

class FilmExport implements FromCollection
{
    public function collection()
    {
        return Film::all();
    }
}