@extends('layouts.base_admin.base_dashboard')
@section('judul', 'List Akun')
@section('script_head')
    <!-- ... Bagian head script lainnya ... -->
@endsection

@section('content')
    <section class="content-header">
        <!-- ... Bagian lain dari content header ... -->
    </section>

    <section class="content">
        <div class="card">
            <div class="card-header">
                <!-- ... Bagian lain dari card header ... -->
            </div>
            <div class="container">
                <form action="{{ route('pembelians.store') }}" method="POST" id="pembelianForm">
                    @csrf

                    <div class="mb-3">
                        <label for="film_id" class="form-label">Film</label>
                        <select name="film_id" id="film_id" class="form-select">
                            @foreach ($films as $film)
                                <option value="{{ $film->id }}">{{ $film->judul_film }}</option>
                            @endforeach
                        </select>
                    </div>                    

                    <div class="mb-3">
                        <label for="jumlah_tiket" class="form-label">Jumlah Tiket</label>
                        <select name="jumlah_tiket" id="jumlah_tiket" class="form-select" onchange="calculateTotalHarga()">
                            @for ($i = 1; $i <= 10; $i++)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="total_harga" class="form-label">Total Harga Rp.<span id="total_harga_display">50,000</span></label>
                        <input type="hidden" name="total_harga" id="total_harga" value="50000">
                    </div>

                    <div class="mb-3">
                        <label for="jumlah_pembayaran" class="form-label">Jumlah Pembayaran</label>
                        <input type="text" name="jumlah_pembayaran" id="jumlah_pembayaran" class="form-control">
                        @error('jumlah_pembayaran')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>        

                    <div class="col-sm-11.5 mt-4 mb-4">
                        <div class="d-flex justify-content-between mb-2">
                            <div class="col-sm-1.5 ml-auto">
                                <button type="submit" class="btn btn-success">Bayar</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>

    @section('script_footer')
        <script>
            function calculateTotalHarga() {
                var jumlahTiket = parseInt($('#jumlah_tiket').val());
                var hargaPerTiket = 50000; // Ganti dengan harga tiket yang sesuai

                var totalHarga = jumlahTiket * hargaPerTiket;

                $('#total_harga').val(totalHarga);
                $('#total_harga_display').text(totalHarga.toLocaleString());
            }
        </script>
        <script>
            $('#pembelianForm').submit(function (e) {
                var jumlahPembayaran = parseFloat($('#jumlah_pembayaran').val());
                var totalHarga = parseFloat($('#total_harga').val());

                if (jumlahPembayaran < totalHarga) {
                    e.preventDefault();
                    Swal.fire({
                        title: 'Peringatan!',
                        text: 'Jumlah pembayaran harus lebih besar atau sama dengan total harga.',
                        icon: 'warning',
                    });
                }
            });
        </script>
        <script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3/dist/js/bootstrap.min.js"></script>
    @endsection
@endsection
