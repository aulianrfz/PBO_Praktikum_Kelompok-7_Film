<?php

namespace App\Http\Controllers;

use App\Exceptions\FilmException;
use App\Models\Film;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;

class FilmController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Film::select('*');
            return DataTables::of($data)
                ->addColumn('action', function ($row) {
                    $btn = '<a href="' . route('film.edit', $row->id) . '" class="btn btn-info">Edit</a>';
                    $btn .= ' <button class="btn btn-danger delete" data-id="' . $row->id . '">Delete</button>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('page.admin.film.films');
    }

    public function create()
    {
        return view('page.admin.film.formfilm');
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'judulFilm' => 'required|string',
                'rilis' => 'required|date',
                'genre' => 'required|string',
                'rating' => 'required|numeric',
                'deskripsi' => 'required|string',
            ]);

            $film = new Film($validatedData);
            $film->save();
            // dd($film);

            Log::info('film created successfully: ' . $film->judulFilm);

            return redirect()->route('film.films')->with('success', 'Data Berhasil Disimpan');
        } catch (ValidationException $e) {
            // dd($film);
            Log::error('Validation failed while creating a film: ' . $e->getMessage());
            return redirect()->back()->withErrors($e->errors())->withInput();
        }
    }

    public function show($id)
    {
        $data = Film::find($id);
        return view('page.admin.film.tampilfilm', compact('data'));
    }

    public function tampilkandata($id)
    {
        $data = film::Find($id);
        return view('page.admin.film.tampilfilm', compact('data'));
    }

    public function showdashboard()
    {
        $data = Film::all();

        return view('tampilan.dashboardfilm', compact('data'));
    }

    public function showprofil($id)
    {
        $data = Film::find($id);
        return view('tampilan.profilfilm', compact('data'));
    }

    public function edit($id)
    {
        $data = film::find($id);
        return view('page.admin.film.tampilfilm', compact('data'));
    }

    public function update(Request $request, $id)
    {
        try {
            $validatedData = $request->validate([
                'judulFilm' => 'required',
                'rilis' => 'required|date',
                'genre' => 'required|string',
                'rating' => 'required|numeric',
                'deskripsi' => 'required|string',
            ]);

            $film = Film::find($id);
            $film->update($validatedData);
            Log::info('film updated successfully: ' . $film->judul_film);

            return redirect()->route('film.films')->with('success', 'Data Berhasil Edit');
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
            Log::info('film deleted successfully: ' . $data->judul_film);

            return response()->json(['success' => 'Data Berhasil Dihapus']);
        } catch (FilmException $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }






}
