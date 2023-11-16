<?php

namespace App\Http\Controllers;

use App\Exceptions\FilmException;
use App\Models\Film;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use Yajra\DataTables\DataTables;

class FilmController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Film::select('*');
            return DataTables::of($data)
                ->addColumn('action', function ($row) {
                    $btn = '<a href="' . route('tiket.edit', $row->id) . '" class="btn btn-info">Edit</a>';
                    $btn .= ' <form action="' . route('tiket.destroy', $row->id) . '" method="POST" style="display:inline;">
                                ' . csrf_field() . '
                                ' . method_field('DELETE') . '
                                <button type="submit" class="btn btn-danger" onclick="return confirm(\'Are you sure?\')">Delete</button>
                            </form>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('page.admin.tiket.films');
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
                    'date',
                    'after_or_equal:' . Carbon::now()->format('Y-m-d'),
                    'before_or_equal:' . Carbon::now()->addWeek()->format('Y-m-d'),
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
                    'date',
                    'after_or_equal:' . Carbon::now()->format('Y-m-d'),
                    'before_or_equal:' . Carbon::now()->addWeek()->format('Y-m-d'),
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
            Log::info('Film deleted successfully: ' . $data->judul_film);
            return response()->json(['success' => 'Data Berhasil Dihapus']);
        } catch (FilmException $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }
}