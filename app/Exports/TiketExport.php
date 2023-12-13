<?php

namespace App\Exports;

use App\Models\Tiket;
use Maatwebsite\Excel\Concerns\FromCollection;

class TiketExport implements FromCollection
{
    public function collection()
    {
        return Tiket::all();
    }
}