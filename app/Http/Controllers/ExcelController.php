<?php

namespace App\Http\Controllers;

use App\Exports\FilmExport;
use App\Exports\TiketExport;
use App\Exports\PembelianExport;
use Maatwebsite\Excel\Facades\Excel;

class ExcelController extends Controller
{
    public function exportFilms()
    {
        return Excel::download(new FilmExport(), 'films.xlsx');
    }
    public function exportTikets()
    {
        return Excel::download(new TiketExport(), 'tiket.xlsx');
    }
    public function exportPembelians()
    {
        return Excel::download(new PembelianExport(), 'pembelian.xlsx');
    }
}