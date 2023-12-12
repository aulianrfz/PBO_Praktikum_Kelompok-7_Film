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
            <div class="row justify-content-center">
                <div class="col-8; align-items: center;">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('film.update', ['id' => $data->id]) }}" method="POST" enctype="multipart/form-data"
                                onsubmit="return validateForm()">
                                <div style="display: flex; align-items: center;">
                                    <img src="image/education_.png" alt="Profil Image"
                                        style="margin-right: 15px; width: 30px;">
                                    <h2 class="header-profil">RIWAYAT PENDIDIKAN</h2>
                                </div>
                                <hr style="margin-top: 0px; margin-bottom: 20px; color:#000000;">
                                @csrf
                                <div class="container mb-4">
                                    <div class="row-1">
                                        <div id="formRiwayatContainer">

                                            <div class="mb-3">
                                                <label for="film" class="form-label"></label>
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th>Judul Film</th>
                                                            <th>Rilis</th>
                                                            <th>Genre</th>
                                                            <th>Rating</th>
                                                            <th>Deskripsi</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="Pendidikan">
                                                        <tr>
                                                            <td><input type="text" class="form-control"
                                                                    name="judulFilm" placeholder="Judul" value="{{ $data->judulFilm}}"
                                                                    required></td>
                                                            <td><input type="date" class="form-control"
                                                                    name="rilis" placeholder="rilis" value="{{ $data->rilis }}" required>
                                                            </td>
                                                            <td><input type="text" class="form-control"
                                                                    name="genre" placeholder="Genre" value="{{ $data->genre }}"></td>
                                                            <td><input type="number" class="form-control"
                                                                    name="rating" placeholder="Rating" value="{{ $data->rating }}"></td>
                                                            <td><input type="text" class="form-control"
                                                                    name="deskripsi" placeholder="Deskripsi" value="{{ $data->deskripsi }}">
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <button type="button" class="btn btn-info" id="tambahfilm"
                                                    style="width: 120px;">
                                                    <img src="image/plus_.png" alt="Icon"
                                                        style="vertical-align: middle; margin-right: 10px; width: 20px;">
                                                    Tambah
                                                </button>
                                                <button class="btn btn-success" style="float: right;" type="submit">
                                                    Submit</button>
                                            </div>



                                        </div>

                                        
                            </form>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

</section>
<script>
    let filmIndex = 2;

    document.getElementById('tambahfilm').addEventListener('click', function () {
        let newRow = document.createElement('tr');
        newRow.innerHTML = `
            <td><input type="text" class="form-control" name="film[${filmIndex}][judulFilm]" placeholder=""></td>
            <td><input type="text" class="form-control" name="film[${filmIndex}][rilis]" placeholder=""></td>
            <td><input type="text" class="form-control" name="film[${filmIndex}][genre]" placeholder=""></td>
            <td><input type="text" class="form-control" name="film[${filmIndex}][rating]" placeholder=""></td>
            <td><input type="text" class="form-control" name="film[${filmIndex}][deskripsi]" placeholder=""></td>
        `;
        document.getElementById('Pendidikan').appendChild(newRow);
        filmIndex++;
    });
</script>
<script src="{{ asset('admin') }}/vendors/base/vendor.bundle.base.js"></script>
<script src="{{ asset('admin') }}/vendors/chart.js/Chart.min.js"></script>
<script src="{{ asset('admin') }}/vendors/datatables.net/jquery.dataTables.js"></script>
<script src="{{ asset('admin') }}/vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
<script src="{{ asset('admin') }}/js/off-canvas.js"></script>
<script src="{{ asset('admin') }}/js/hoverable-collapse.js"></script>
<script src="{{ asset('admin') }}/js/template.js"></script>
<script src="{{ asset('admin') }}/js/dashboard.js"></script>
<script src="{{ asset('admin') }}/js/data-table.js"></script>
<script src="{{ asset('admin') }}/js/jquery.dataTables.js"></script>
<script src="{{ asset('admin') }}/js/dataTables.bootstrap4.js"></script>
<script src="{{ asset('admin') }}/js/jquery.cookie.js" type="text/javascript">
</script>
@endsection
@section('script_footer')
<script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3/dist/js/bootstrap.min.js"></script>
@endsection