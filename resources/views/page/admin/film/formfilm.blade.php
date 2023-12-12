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
                <h1>film Bioskop </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}">film</a>
                    </li>
                    <li class="breadcrumb-item active">Pembelian film</li>
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
            <form action="{{ route('film.store') }}" method="POST">
                @csrf
                <div class="form-group mt-4">
                    <label for="judulFilm">Judul film</label>
                    <input type="text" class="form-control" name="judulFilm" placeholder="Judul" required></td>
                </div>

                <div class="form-group">
                    <label for="rilis">Rilis</label>
                    <input type="date" class="form-control" name="rilis" placeholder="rilis" required>
                </div>

                <div class="form-group">
                    <label for="genre">Genre</label>
                    <input type="text" class="form-control" name="genre" placeholder="Genre">
                </div>

                <div class="form-group">
                    <label for="rating">Rating</label>
                    <input type="number" class="form-control" name="rating" placeholder="Rating">
                </div>

                <div class="form-group">
                    <label for="deskripsi">Deskripsi</label>
                    <input type="text" class="form-control" name="deskripsi" placeholder="Deskripsi">
                </div>

                <div class="col-sm-11.5 mt-4 mb-4">
                    <div class="d-flex justify-content-between mb-2">
                        <div class="col-sm-1.5 ml-auto">
                            <button type="submit" class="btn btn-success">Simpan</button>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>

</section>
@endsection @section('script_footer')
<script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3/dist/js/bootstrap.min.js"></script>
@endsection