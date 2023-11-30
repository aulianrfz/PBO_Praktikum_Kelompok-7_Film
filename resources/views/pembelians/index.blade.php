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
                <h1>Data </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}">Beranda</a>
                    </li>
                    <li class="breadcrumb-item active">Akun</li>
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
        <div class="card-body p-0" style="margin: 20px">
            <table id="filmsTable" class="table table-striped table-bordered display" style="width:100%">
                <thead>
                    <tr>
                        <th>Judul Film</th>
                        <th>Jumlah Tiket</th>
                        <th>Total Harga</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
    <div class="col-sm-11.5">
        <div class="d-flex justify-content-between mb-2">
            <div class="col-sm-1">
                <a href ="/dashboard/admin/pembelians/create" type="button" class="btn btn-success btn-sm" style="width=auto">Tambah</a>
            </div>
            <div class="col-sm-1.5">
                <a href="/create-word-document" type="button" class="btn btn-info btn-sm">Download</a>
            </div>
        </div>
    </div>

</section>
@endsection @section('script_footer')
<script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
<script>
$(document).ready(function() {
    var table = $('#filmsTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('pembelians.index') }}",
        columns: [
            { data: 'film.judul_film', name: 'film.judul_film' },
            { data: 'jumlah_tiket', name: 'row_kursi' },
            { data: 'total_harga', name: 'total_harga' },
            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false,
                className: 'text-center',
            },
        ],
    });

    $('#filmsTable').on('click', '.delete-btn', function() {
        var filmId = $(this).data('id');
        Swal.fire({
            title: 'Peringatan!',
            text: "Apakah kamu yakin data film dengan ID " + filmId + " ini mau dihapus?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "/dashboard/admin/tiket/destroy/" + filmId,
                    type: "DELETE",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "id": filmId // Pass the id parameter
                    },
                    success: function (data) {
                        Swal.fire(
                            'Terhapus!',
                            'Data berhasil terhapus.',
                            'success'
                        );
                        // Perbarui tabel setelah penghapusan
                        table.ajax.reload();
                    },
                    error: function (data) {
                        console.error('Error:', data);
                    }
                });
            }
        });
    });
});
</script>
@endsection
