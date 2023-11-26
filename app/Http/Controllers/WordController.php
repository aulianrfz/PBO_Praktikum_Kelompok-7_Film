<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;
use App\Models\Film;


class WordController extends Controller
{
    // ...

    public function createWordDocument()
    {
        $phpWord = new PhpWord();
        $section = $phpWord->addSection();

        $tableStyle = [
            'borderSize' => 6,
            'borderColor' => '000000',
            'cellMargin' => 80,
        ];

        $table = $section->addTable($tableStyle);

        // Tambahkan baris header dengan gaya teks bold
        $table->addRow();
        $table->addCell(2000, ['bgColor' => 'C0C0C0'])->addText('Judul Film', ['bold' => true, 'align' => 'center']);
        $table->addCell(2000, ['bgColor' => 'C0C0C0'])->addText('Waktu', ['bold' => true, 'align' => 'center']);
        $table->addCell(2000, ['bgColor' => 'C0C0C0'])->addText('Tanggal Pemesanan', ['bold' => true, 'align' => 'center']);
        $table->addCell(2000, ['bgColor' => 'C0C0C0'])->addText('Row Kursi', ['bold' => true, 'align' => 'center']);
        $table->addCell(2000, ['bgColor' => 'C0C0C0'])->addText('Seat Kursi', ['bold' => true, 'align' => 'center']);
        $table->addCell(2000, ['bgColor' => 'C0C0C0'])->addText('Jumlah Tiket', ['bold' => true, 'align' => 'center']);

        // Ambil data film dan tambahkan baris untuk setiap data
        $films = Film::all();
        foreach ($films as $film) {
            $table->addRow();
            $table->addCell(2000)->addText($film->judul_film);
            $table->addCell(2000)->addText($film->waktu);
            $table->addCell(2000)->addText($film->tanggal_pemesanan);
            $table->addCell(2000)->addText($film->row_kursi);
            $table->addCell(2000)->addText($film->seat_kursi);
            $table->addCell(2000)->addText($film->jumlah_tiket);
        }

        $filename = 'film_document.docx';
        $objWriter = IOFactory::createWriter($phpWord, 'Word2007');
        $objWriter->save(public_path($filename));

        return response()->download(public_path($filename))->deleteFileAfterSend(true);
    }

}
