<?php

namespace App\Http\Controllers;

use App\Models\Pembelian;
use App\Exceptions\PembelianException;
use App\Models\Film;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Yajra\DataTables\DataTables;



class PembelianController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Pembelian::with('film')->get();

            return DataTables::of($data)
                ->addColumn('action', function ($row) {
                    $actionBtn = '<a href="' . route('pembelians.edit', $row->id) . '" class="btn btn-primary">Edit</a> ';
                    $actionBtn .= '<button type="button" class="btn btn-danger delete-btn" data-id="' . $row->id . '">Delete</button>';

                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('pembelians.index');
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
                'total_harga' => 'required|numeric',
                'jumlah_pembayaran' => 'required|numeric|min:' . Film::find($request->film_id)->harga * $request->jumlah_tiket,
            ]);

            // Retrieve film data
            $film = Film::find($validatedData['film_id']);

            // Calculate total harga
            $totalHarga = $film->harga * $validatedData['jumlah_tiket'];

            // Validasi
            if ($totalHarga != $validatedData['total_harga']) {
                throw ValidationException::withMessages([
                    'total_harga' => 'Total harga tidak valid.',
                ]);
            }

            // Check if the payment amount is sufficient
            if ($validatedData['jumlah_pembayaran'] < $totalHarga) {
                // Insufficient payment
                return Redirect::back()->withErrors(['jumlah_pembayaran' => 'Pembayaran kurang.'])->withInput();
            }

            // Payment is sufficient, proceed to save data
            $pembelian = new Pembelian([
                'film_id' => $validatedData['film_id'],
                'jumlah_tiket' => $validatedData['jumlah_tiket'],
                'total_harga' => $totalHarga,
                'user_id' => Auth::id(),
            ]);

            $pembelian->save();

            $data = Pembelian::with('film')->get();

            return redirect()->route('pembelians.index')->with('success', 'Tiket berhasil dibeli');
        } catch (ValidationException $e) {
            Log::error('Validation failed while creating a pembelian: ' . $e->getMessage());
    
            // Redirect back with errors
            return redirect()->back()->withErrors($e->errors())->withInput();
        }
    }
    
    public function edit($id)
    {
        $pembelian = Pembelian::findOrFail($id);
        $films = Film::all();
        return view('pembelians.edit', compact('pembelian', 'films'));
    }

    public function update(Request $request, $id)
    {
        try {

            return new JsonResponse(['message' => 'Data pembelian tiket berhasil diperbarui'], Response::HTTP_OK);
        } catch (ValidationException $e) {
            return new JsonResponse(['errors' => $e->errors()], Response::HTTP_UNPROCESSABLE_ENTITY);
        } catch (\Exception $e) {
            return new JsonResponse(['message' => 'Terjadi kesalahan.'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    public function destroy($id)
    {
        try {
            $pembelian = Pembelian::findOrFail($id);
            $pembelian->delete();

            return new JsonResponse(['message' => 'Data pembelian tiket berhasil dihapus'], Response::HTTP_OK);
        } catch (\Exception $e) {
            return new JsonResponse(['message' => 'Terjadi kesalahan.'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

}