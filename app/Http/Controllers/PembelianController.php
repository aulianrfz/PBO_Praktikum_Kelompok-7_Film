<?php

namespace App\Http\Controllers;

use App\Models\Pembelian;
use App\Models\Film;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Yajra\DataTables\DataTables;


class PembelianController extends Controller
{
    public function index()
    {
        $pembelians = Pembelian::where('user_id', Auth::id())->get();
        return view('pembelians.index', compact('pembelians'));
    }

    public function create()
    {
        $films = Film::all();
        return view('pembelians.create', compact('films'));
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'film_id' => 'required|exists:films,id',
                'jumlah_tiket' => 'required|integer|min:1',
                'jumlah_pembayaran' => 'required|numeric|min:' . $request->input('total_harga'),
            ]);

            // Retrieve film data
            $film = Film::find($validatedData['film_id']);

            // Calculate total harga
            $totalHarga = $film->harga * $validatedData['jumlah_tiket'];

            // Validasi
            if ($totalHarga != $request->input('total_harga')) {
                throw ValidationException::withMessages([
                    'total_harga' => 'Total harga tidak valid.',
                ]);
            }

            $pembelian = new Pembelian([
                'film_id' => $validatedData['film_id'],
                'jumlah_tiket' => $validatedData['jumlah_tiket'],
                'total_harga' => $totalHarga,
                'user_id' => Auth::id(),
            ]);

            $pembelian->save();

            Log::info('Pembelian tiket created successfully.');

            if ($request->ajax()) {
                return new JsonResponse(['message' => 'Tiket berhasil dibeli'], Response::HTTP_OK);
            }

            return redirect()->route('pembelians.index')->with('success', 'Tiket berhasil dibeli');
        } catch (ValidationException $e) {
            Log::error('Validation failed while creating a pembelian: ' . $e->getMessage());

            if ($request->ajax()) {
                return new JsonResponse(['errors' => $e->errors()], Response::HTTP_UNPROCESSABLE_ENTITY);
            }

            return redirect()->back()->withErrors($e->errors())->withInput();
        }
    }

    public function show(Request $request, $id)
    {
        $pembelian = Pembelian::findOrFail($id);
        $films = Film::all();
        return view('pembelians.index', compact('pembelian', 'films'));
    }

    public function update(Request $request, $id)
    {
        try {
            $pembelian = Pembelian::findOrFail($id);

            $validatedData = $request->validate([
                'film_id' => 'required|exists:films,id',
                'jumlah_tiket' => 'required|integer|min:1',
            ]);

            $film = Film::find($validatedData['film_id']);
            $total_harga = $film->harga * $validatedData['jumlah_tiket'];

            $pembelian->update([
                'film_id' => $validatedData['film_id'],
                'jumlah_tiket' => $validatedData['jumlah_tiket'],
                'total_harga' => $total_harga,
            ]);

            Log::info('Pembelian tiket updated successfully.');

            return redirect()->route('pembelians.index')->with('success', 'Data pembelian tiket berhasil diperbarui');
        } catch (ValidationException $e) {
            Log::error('Validation failed while updating a pembelian: ' . $e->getMessage());
            return redirect()->back()->withErrors($e->errors())->withInput();
        }
    }

    public function showPembelian($id)
    {
        $pembelian = Pembelian::findOrFail($id);
        $films = Film::all();
        return view('pembelians.show', compact('pembelian', 'films'));
    }

    public function destroy($id)
    {
        $pembelian = Pembelian::findOrFail($id);
        $pembelian->delete();

        Log::info('Pembelian tiket deleted successfully.');

        return redirect()->route('pembelians.index')->with('success', 'Data pembelian tiket berhasil dihapus');
    }
}