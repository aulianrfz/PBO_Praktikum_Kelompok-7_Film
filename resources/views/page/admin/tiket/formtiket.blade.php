@extends('layouts.base_admin.base_dashboard')@section('judul', 'List Akun')
@section('script_head')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Tiket Bioskop </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}">Tiket</a>
                    </li>
                    <li class="breadcrumb-item active">Pembelian Tiket</li>
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
            <form action="{{ route('tiket.store') }}" method="POST">
                @csrf

                <div class="form-group mt-4">
                    <label for="judul_film">Judul Film</label>
                    <select class="form-select" name="judul_film" placeholder="Masukkan judul tiket kursi">
                    @foreach ($data as $film)
                        <option value="{{ $film->id }}">{{ $film->judulFilm }}</option>
                    @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="waktu">Waktu</label>
                    <input type="time" name="waktu" class="form-control @error('waktu') is-invalid @enderror" id="waktu"
                        placeholder="Masukkan waktu">
                    @error('waktu')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="tanggal_pemesanan">Tanggal Pemesanan</label>
                    <input type="date" name="tanggal_pemesanan"
                        class="form-control @error('tanggal_pemesanan') is-invalid @enderror" id="tanggal_pemesanan"
                        placeholder="Masukkan tanggal pemesanan">
                    @error('tanggal_pemesanan')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
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

                <div class="form-group">
                    <label for="seat_kursi">Seat Kursi</label>
                    <input type="number" name="seat_kursi"
                        class="form-control @error('seat_kursi') is-invalid @enderror" id="seat_kursi"
                        placeholder="Masukkan seat kursi">
                    @error('seat_kursi')
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
@section('script_footer')
        <script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3/dist/js/bootstrap.min.js"></script>

        <script>
            // Add an event listener for the "Lanjut Pembayaran" button
            document.getElementById('lanjutPembayaran').addEventListener('click', function () {
                // Get the selected film title
                var selectedFilmTitle = document.querySelector('select[name="judul_film"] option:checked').innerText;

                // Redirect to pembelians.create with the selected film title as a query parameter
                window.location.href = "{{ route('pembelians.create') }}?film_title=" + encodeURIComponent(selectedFilmTitle);
            });
        </script>
    @endsection
<script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3/dist/js/bootstrap.min.js"></script>
@endsection