@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="text-center mt-4 mb-4">Beli Tiket Film</h2>
        <form action="{{ route('pembelians.store') }}" method="POST" id="pembelianForm">
            @csrf
            <div class="mb-3">
                <label for="film_id" class="form-label">Film</label>
                <select name="film_id" id="film_id" class="form-select">
                    @foreach ($films as $film)
                        <option value="{{ $film->id }}" data-harga="{{ $film->harga }}">{{ $film->judul_film }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="jumlah_tiket" class="form-label">Jumlah Tiket</label>
                <select name="jumlah_tiket" id="jumlah_tiket" class="form-select">
                    @for ($i = 1; $i <= 10; $i++)
                        <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                </select>
            </div>

            <!-- Summary Section -->
            <div class="mb-3">
                <label for="total_harga" class="form-label">Total Harga Rp.<span id="total_harga_display">50,000</span></label>
                <input type="hidden" name="total_harga" id="total_harga" value="50000">
            </div>

            <div class="mb-3">
                <label for="jumlah_pembayaran" class="form-label">Jumlah Pembayaran</label>
                <input type="number" name="jumlah_pembayaran" id="jumlah_pembayaran" class="form-control">
                @error('jumlah_pembayaran')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Beli Tiket</button>
        </form>
    </div>
    <script>
        document.getElementById('film_id').addEventListener('change', calculateTotalHarga);
        document.getElementById('jumlah_tiket').addEventListener('change', calculateTotalHarga);

        function calculateTotalHarga() {
            var selectedOption = document.getElementById('film_id').options[document.getElementById('film_id').selectedIndex];
            var harga = parseFloat(selectedOption.getAttribute('data-harga'));
            var jumlahTiket = parseInt(document.getElementById('jumlah_tiket').value);
            var totalHarga = harga * jumlahTiket;

            document.getElementById('total_harga').value = totalHarga.toFixed(2);
            document.getElementById('total_harga_display').innerText = totalHarga.toFixed(2);
        }
    </script>
@endsection
