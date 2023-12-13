<?php

namespace App\Http\Controllers;

use App\Exceptions\tiketException;
use App\Models\tiket;
use App\Models\Film;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use Yajra\DataTables\DataTables;

class TiketController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $data = tiket::select('*');
            
            $data->addSelect(['films.judulFilm as judul_film'])
                ->leftJoin('films', 'tikets.film_id', '=', 'films.id');

            return DataTables::of($data)
                ->addColumn('action', function ($row) {
                    $btn = '<a href="' . route('tiket.edit', $row->id) . '" class="btn btn-info">Edit</a>';
                    $btn .= ' <button class="btn btn-danger delete" data-id="' . $row->id . '">Delete</button>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        if(auth()->user()->role != 'admin'){
            return view('page.user.pembayaran.formpembayaran');
        }
        return view('page.admin.tiket.tikets');
    }

    public function create()
    {
        $data = Film::all();

        if(auth()->user()->role != 'admin'){
            return view('page.user.tiket.formtiket', compact('data'));
        }

        return view('page.admin.tiket.formtiket', compact('data'));
    }

    public function store(Request $request)
    {
        // try {
        $validatedData = $request->validate([
            'judul_film' => 'required',
            'waktu' => 'required',
            'tanggal_pemesanan' => [
                'required',
                'date',
                'after_or_equal:' . Carbon::now()->format('Y-m-d'),
                'before_or_equal:' . Carbon::now()->addWeek()->format('Y-m-d'),
            ],
            'row_kursi' => 'required',
            'seat_kursi' => 'required|integer|between:1,10',
        ]);

        $selectedFilmId = $validatedData['judul_film'];

        $film = Film::find($selectedFilmId);

        $film_id = $film->id;

        $tiket = new tiket($validatedData);
        $tiket->film_id = $film_id;
        $tiket->save();

        Log::info('tiket created successfully: ' . $tiket->judul_film);

        return redirect()->route('tiket.tikets')->with('success', 'Data Berhasil Disimpan');
        // } catch (ValidationException $e) {
        //     Log::error('Validation failed while creating a tiket: ' . $e->getMessage());
        //     return redirect()->back()->withErrors($e->errors())->withInput();
        // }
    }

    public function show($id)
    {
        $data = tiket::find($id);
        return view('page.admin.tiket.tampiltiket', compact('data'));
    }

    public function tampilkandata($id)
    {
        $data = tiket::find($id);
        return view('page.admin.tiket.tampiltiket', compact('data'));
    }

    public function edit($id)
    {
        $data = tiket::find($id);
        return view('page.admin.tiket.tampiltiket', compact('data'));
    }

    public function update(Request $request, $id)
    {
        try {
            $validatedData = $request->validate([
                'waktu' => 'required',
                'tanggal_pemesanan' => [
                    'required',
                    'date',
                    'after_or_equal:' . Carbon::now()->format('Y-m-d'),
                    'before_or_equal:' . Carbon::now()->addWeek()->format('Y-m-d'),
                ],
                'row_kursi' => 'required',
                'seat_kursi' => 'required|integer|between:1,10',
            ]);

            $tiket = tiket::find($id);
            $tiket->update($validatedData);
            Log::info('tiket updated successfully: ' . $tiket->judul_tiket);

            return redirect()->route('tiket.tikets')->with('success', 'Data Berhasil Edit');
        } catch (ValidationException $e) {
            Log::error('Validation failed while updating a tiket: ' . $e->getMessage());
            return redirect()->back()->withErrors($e->errors())->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $data = tiket::find($id);
            if (!$data) {
                throw new tiketException('Data not found.');
            }

            $data->delete();
            // Log::info('tiket deleted successfully: ' . $data->judul_film);
            Log::info('tiket deleted successfully: ');

            return response()->json(['success' => 'Data Berhasil Dihapus']);
        } catch (tiketException $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }


}