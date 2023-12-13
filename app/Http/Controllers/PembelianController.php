<?php

namespace App\Http\Controllers;// app/Http/Controllers/PembelianController.php// app/Http/Controllers/PembelianController.php// app/Http/Controllers/PembelianController.php

use App\Models\Film;
use App\Models\Pembelian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Carbon\Carbon;

class PembelianController extends Controller
{
    public function index(Request $request)
    {
        $data = Pembelian::with('film')->get();

        // Tambahkan kolom total_harga ke data
        $data->map(function ($item) {
            $item['total_harga'] = $item->jumlah_tiket * $item->film->harga;
            return $item;
        });

        return view('pembelians.index', compact('data'));
    }

    public function create()
    {
        $films = Film::all();
        return view('pembelians.create', compact('films'));
    }

    public function store(Request $request)
    {
        try {
            // Validasi input
            $request->validate([
                'film_id' => 'required|exists:films,id',
                'jumlah_tiket' => 'required|integer|min:1',
                'jumlah_pembayaran' => 'required|numeric|min:0',
            ]);

            $film = Film::find($request->film_id);
            $totalHarga = $film->harga * $request->jumlah_tiket;

            $pembelian = new Pembelian([
                'film_id' => $request->film_id,
                'jumlah_tiket' => $request->jumlah_tiket,
                'harga' => $film->harga,
                'total_harga' => $totalHarga,
                'user_id' => Auth::id(),
                'jumlah_pembayaran' => $request->jumlah_pembayaran,
                'tanggal_pembayaran' => Carbon::now(),
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
            // Validasi input
            $request->validate([
                'jumlah_tiket' => 'required|integer|min:1',
                'jumlah_pembayaran' => 'required|numeric|min:0',
            ]);

            $pembelian = Pembelian::find($id);

            // Update data pembelian
            $pembelian->jumlah_tiket = $request->jumlah_tiket;
            $pembelian->jumlah_pembayaran = $request->jumlah_pembayaran;
            $pembelian->save();

            return redirect()->route('pembelians.index')->with('success', 'Data pembelian tiket berhasil diperbarui');
        } catch (\Exception $e) {
            Log::error('Error updating pembelian: ' . $e->getMessage());

            return redirect()->back()->with('error', 'Terjadi kesalahan saat memperbarui data pembelian')->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $pembelian = Pembelian::findOrFail($id);
            $pembelian->delete();

            return redirect()->route('pembelians.index')->with('success', 'Data pembelian tiket berhasil dihapus');
        } catch (\Exception $e) {
            Log::error('Error deleting pembelian: ' . $e->getMessage());

            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus data pembelian');
        }
    }
}