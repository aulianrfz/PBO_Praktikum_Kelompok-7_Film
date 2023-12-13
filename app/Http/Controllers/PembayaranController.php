<?php

namespace App\Http\Controllers;

use App\Exceptions\pembayaranException;
use App\Models\pembayaran;
use App\Models\tiket;
use App\Models\film;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use Yajra\DataTables\DataTables;

class PembayaranController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $data = pembayaran::select('*');

            $data = pembayaran::select(['pembayarans.*', 'tikets.seat_kursi'])
                ->leftJoin('tikets', 'pembayarans.tiket_id', '=', 'tikets.id')
                ->leftJoin('films', 'tikets.film_id', '=', 'films.id') // Add this line to join films table
                ->addSelect(['films.judulFilm']); // Add this line to select judul_film


            return DataTables::of($data)
                ->addColumn('action', function ($row) {
                    $btn = '<a href="' . route('pembayaran.edit', $row->id) . '" class="btn btn-info">Edit</a>';
                    $btn .= ' <button class="btn btn-danger delete" data-id="' . $row->id . '">Delete</button>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        if(auth()->user()->role != 'admin'){
            $data = Film::all();
            return view('tampilan.dashboardfilm', compact('data'));
        }
        return view('page.admin.pembayaran.pembayarans');
    }

    public function create()
    {
        $data = tiket::all();

        if(auth()->user()->role != 'admin'){
            return view('page.user.pembayaran.formpembayaran', compact('data'));
        }

        return view('page.admin.pembayaran.formpembayaran', compact('data'));
    }

    public function store(Request $request)
    {
        // try {

        $totalHarga = 50000 * $request->jumlah_tiket;

        $validatedData = $request->validate([
            'seat_kursi' => 'required',
            'jumlah_tiket' => 'required|integer', // Adjust this validation rule as needed
            'total_harga' => 'required', // Adjust this validation rule as needed
            'jumlah_pembayaran' => 'required', // Adjust this validation rule as needed
        ]);

        $selectedtiketId = $validatedData['seat_kursi'];

        $tiket = Tiket::find($selectedtiketId);
        $film = Film::find($selectedtiketId);

        $tiket_id = $tiket->id;
        $judul_film = $tiket->film->judulFilm;
        // dd($judul_film);

        $pembayaran = new pembayaran($validatedData);
        $pembayaran->tiket_id = $tiket_id;
        // dd($pembayaran->tiket_id);
        $pembayaran->save();

        Log::info('pembayaran created successfully: ' . $pembayaran->seat_kursi);

        

        return redirect()->route('pembayaran.pembayarans')->with('success', 'Data Berhasil Disimpan');
        // } catch (ValidationException $e) {
        //     Log::error('Validation failed while creating a pembayaran: ' . $e->getMessage());
        //     return redirect()->back()->withErrors($e->errors())->withInput();
        // }
    }

    public function show($id)
    {
        $data = pembayaran::find($id);
        return view('page.admin.pembayaran.tampilpembayaran', compact('data'));
    }

    public function tampilkandata($id)
    {
        $data = pembayaran::find($id);
        return view('page.admin.pembayaran.tampilpembayaran', compact('data'));
    }

    public function edit($id)
    {
        $data = pembayaran::find($id);
        return view('page.admin.pembayaran.tampilpembayaran', compact('data'));
    }

    public function update(Request $request, $id)
    {
        try {
            $validatedData = $request->validate([
            ]);

            $pembayaran = pembayaran::find($id);
            $pembayaran->update($validatedData);
            Log::info('pembayaran updated successfully: ' . $pembayaran->judul_pembayaran);

            return redirect()->route('pembayaran.pembayarans')->with('success', 'Data Berhasil Edit');
        } catch (ValidationException $e) {
            Log::error('Validation failed while updating a pembayaran: ' . $e->getMessage());
            return redirect()->back()->withErrors($e->errors())->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $data = pembayaran::find($id);
            if (!$data) {
                throw new pembayaranException('Data not found.');
            }

            $data->delete();
            // Log::info('pembayaran deleted successfully: ' . $data->seat_kursi);
            Log::info('pembayaran deleted successfully: ');

            return response()->json(['success' => 'Data Berhasil Dihapus']);
        } catch (pembayaranException $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }


}