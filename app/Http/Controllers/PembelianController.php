<?php

namespace App\Http\Controllers;

use App\Models\Pembelian;
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

            // Tambahkan kolom total_harga ke data
            $data->map(function ($item) {
                $item['total_harga'] = $item->jumlah_tiket * 50000;
                return $item;
            });

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
            $film = Film::find($request->film_id);
            $totalHarga = $film->harga * $request->jumlah_tiket;

            $pembelian = new Pembelian([
                'film_id' => $request->film_id,
                'jumlah_tiket' => $request->jumlah_tiket,
                'total_harga' => $totalHarga,
                'user_id' => Auth::id(),
            ]);

            $pembelian->save();

            return redirect()->route('pembelians.index')->with('success', 'Tiket berhasil dibeli');
        } catch (\Exception $e) {
            Log::error('Error saving pembelian: ' . $e->getMessage());

            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan data')->withInput();
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
            // Perbaikan untuk fungsi update jika diperlukan
            return new JsonResponse(['message' => 'Data pembelian tiket berhasil diperbarui'], Response::HTTP_OK);
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