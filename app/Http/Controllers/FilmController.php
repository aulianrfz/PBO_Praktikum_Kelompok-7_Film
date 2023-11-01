<?php

namespace App\Http\Controllers;
use App\Exceptions\FilmException; 
use App\Models\Film;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class FilmController extends Controller
{
    public function index()
    {
        $data = Film::all();
        return view('page.admin.tiket.films',compact ('data'));
    }

    public function create()
    {
        return view('page.admin.tiket.formfilm');
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'judul_film' => 'required',
                'waktu' => 'required',
                'tanggal_pemesanan' => [
                    'required',
                    'date', // Pastikan tanggal valid.
                    'after_or_equal:' . Carbon::now()->format('Y-m-d'), // Setelah tanggal sekarang.
                    'before_or_equal:' . Carbon::now()->addWeek()->format('Y-m-d'), // Sepekan ke depan.
                ],
                'row_kursi' => 'required',
                'seat_kursi' => 'required|integer|between:1,10',
                'jumlah_tiket' => 'required|integer|max:1',
            ]);

            $film = new Film($validatedData);
            $film->save();

            Log::info('Film created successfully: ' . $film->judul_film);

            return redirect()->route('tiket.films')->with('success', 'Data Berhasil Disimpan');
        } catch (ValidationException $e) {
            Log::error('Validation failed while creating a film: ' . $e->getMessage());
            return redirect()->back()->withErrors($e->errors())->withInput();
        }
    }
    
    public function show($id)
    {
        $data = Film::find($id);
        return view('editData', compact('data'));
 
    }

    public function tampilkandata($id)
    {
        $data = Film::find($id);

        return view('page.admin.tiket.tampilfilm', compact('data'));
    }

    public function edit($id)
    {
        $data = Film::find($id);
        return view('editData', compact('data'));
    }

    public function update(Request $request, $id)
    {
        try {
            $validatedData = $request->validate([
                'judul_film' => 'required',
                'waktu' => 'required',
                'tanggal_pemesanan' => [
                    'required',
                    'date', // Pastikan tanggal valid.
                    'after_or_equal:' . Carbon::now()->format('Y-m-d'), // Setelah tanggal sekarang.
                    'before_or_equal:' . Carbon::now()->addWeek()->format('Y-m-d'), // Sepekan ke depan.
                ],
                'row_kursi' => 'required',
                'seat_kursi' => 'required|integer|between:1,10',
                'jumlah_tiket' => 'required|integer|max:1',
            ]);

            $film = Film::find($id);
            $film->update($validatedData);
            Log::info('Film updated successfully: ' . $film->judul_film);

            return redirect()->route('tiket.films')->with('success', 'Data Berhasil Edit');
        } catch (ValidationException $e) {
            Log::error('Validation failed while updating a film: ' . $e->getMessage());
            return redirect()->back()->withErrors($e->errors())->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $data = Film::find($id);
            if (!$data) {
                throw new FilmException('Data not found.');
            }

            $data->delete();
            Log::info('Film deleted successfully: ' . $film->judul_film);
            return redirect()->route('tiket.films')->with('success', 'Data Berhasil Dihapus');
        } catch (FilmException $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
