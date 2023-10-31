<?php

namespace App\Http\Controllers;

use App\Models\Film;

use Illuminate\Http\Request;

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
        $film = new Film();
        $film->judul_film = $request->input('judul_film');
        $film->waktu = $request->input('waktu');
        $film->tanggal_pemesanan = $request->input('tanggal_pemesanan');
        $film->row_kursi = $request->input('row_kursi');
        $film->seat_kursi = $request->input('seat_kursi');
        $film->jumlah_tiket = $request->input('jumlah_tiket');
        $film->save();

        return redirect()->route('tiket.films')->with('success', 'Data Berhasil Disimpan');
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
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = Film::find($id);
        $data->delete();
        return redirect()->route('tiket.films')->with('success','Data Berhasil Dihapus');
    }
}
