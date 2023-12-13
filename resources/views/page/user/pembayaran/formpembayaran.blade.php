@extends('tampilan.profil')

@section('bodyfilm')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>pembayaran Bioskop </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}">pembayaran</a>
                    </li>
                    <li class="breadcrumb-item active">Pembelian pembayaran</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"></h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                    <i class="fas fa-times"></i>
                </button>
            </div>

        </div>
        <div class="container">
            <form action="{{ route('pembayaran.store') }}" method="POST">
                @csrf

                <div class="form-group mt-4">
                    <label for="seat_kursi">Judul tiket</label>
                    <select class="form-select" name="seat_kursi" placeholder="Masukkan judul pembayaran kursi">
                    @foreach ($data as $tiket)
                        <option value="{{ $tiket->id }}">{{ $tiket->seat_kursi }}</option>
                    @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="row_kursi" class="form-label @error('row_kursi') is-invalid @enderror">Row Kursi</label>
                    <select class="form-select" name="row_kursi" placeholder="Masukkan row kursi">
                        <option value=""></option>
                        <option value="A">A</option>
                        <option value="B">B</option>
                        <option value="C">C</option>
                        <option value="D">D</option>
                        <option value="E">E</option>
                        <option value="F">F</option>
                        <option value="G">G</option>
                        <option value="H">H</option>
                        <option value="I">I</option>
                        <option value="J">J</option>
                        <option value="K">K</option>
                        <option value="L">L</option>
                    </select>
                    @error('row_kursi')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
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
                            <button type="submit" class="btn btn-success">Lanjut Pembayaran</button>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>

</section>
@endsection @section('script_footer')
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
@endsection('bodyfilm')