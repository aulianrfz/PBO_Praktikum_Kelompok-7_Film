<?php

namespace App\Http\Controllers;

use App\Exceptions\FilmException; 

use App\Models\Film;

use Illuminate\Http\Request;

use Illuminate\Validation\ValidationException;


class FilmController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Film::all();
        return view('page.admin.tiket.films',compact ('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('page.admin.tiket.formfilm');
    }

    /**
     * Store a newly created resource in storage.
     */
    
     public function store(Request $request)
    {
        try {
            // Perform data validation
            $request->validate([
                'judul_film' => 'required',
                'waktu' => 'required',
                'tanggal_pemesanan' => 'required',
                'row_kursi' => 'required',
                'seat_kursi' => 'required',
                'jumlah_tiket' => 'required|integer',
            ]);

            // If validation passes, create a new film
            $film = new Film();
            $film->judul_film = $request->input('judul_film');
            $film->waktu = $request->input('waktu');
            $film->tanggal_pemesanan = $request->input('tanggal_pemesanan');
            $film->row_kursi = $request->input('row_kursi');
            $film->seat_kursi = $request->input('seat_kursi');
            $film->jumlah_tiket = $request->input('jumlah_tiket');
            $film->save();

            return redirect()->route('tiket.films')->with('success', 'Data Berhasil Disimpan');
        } catch (ValidationException $e) {
            throw new FilmException('Film data validation failed: ' . $e->getMessage());
        }
    }
    

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $data = Film::find($id);
        return view('editData', compact('data'));
 
    }

    public function tampilkandata($id)
    {
        // dd($id);
        $data = Film::find($id);
        // dd($data);

        return view('page.admin.tiket.tampilfilm', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
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
                'tanggal_pemesanan' => 'required',
                'row_kursi' => 'required',
                'seat_kursi' => 'required',
                'jumlah_tiket' => 'required|integer',
            ]);

            $film = Film::find($id);
            $film->update($validatedData);

            return redirect()->route('tiket.films')->with('success', 'Data Berhasil Diedit');
        } catch (FilmException $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $data = Film::find($id);
            if (!$data) {
                throw new FilmException('Data not found.');
            }

            $data->delete();
            return redirect()->route('tiket.films')->with('success', 'Data Berhasil Dihapus');
        } catch (FilmException $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
