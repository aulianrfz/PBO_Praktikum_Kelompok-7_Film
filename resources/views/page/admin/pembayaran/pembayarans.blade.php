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
                <h1>Data Pembayaran </h1>
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
            <table id="pembayaransTable" class="table table-striped table-bordered display" style="width:100%">
                <thead>
                    <tr>
                        <th>Judul Film</th>
                        <th>Jumlah Tiket</th>
                        <th>Jumlah Pembayaran</th>
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
                <a href="/dashboard/admin/pembayaran/formpembayaran" type="button" class="btn btn-success btn-sm"
                    style="width=auto">Tambah</a>
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
    $(document).ready(function () {
        var table = $('#pembayaransTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('pembayaran.pembayarans') }}",
            columns: [
                { data: 'judulFilm', name: 'films.judulFilm' },
                { data: 'jumlah_tiket', name: 'jumlah_tiket' },
                { data: 'total_harga', name: 'total_harga' },
                { data: 'jumlah_pembayaran', name: 'jumlah_pembayaran' },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false,
                    className: 'text-center',
                },
            ],
            language: {
                "decimal": "",
                "emptyTable": "Tak ada data yang tersedia pada tabel ini",
                "info": "Menampilkan _START_ hingga _END_ dari _TOTAL_ entri",
                "infoEmpty": "Menampilkan 0 hingga 0 dari 0 entri",
                "infoFiltered": "(difilter dari _MAX_ total entri)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Tampilkan _MENU_ entri",
                "loadingRecords": "Loading...",
                "processing": "Sedang Mengambil Data...",
                "search": "Pencarian:",
                "zeroRecords": "Tidak ada data yang cocok ditemukan",
                "paginate": {
                    "first": "Pertama",
                    "last": "Terakhir",
                    "next": "Selanjutnya",
                    "previous": "Sebelumnya"
                },
                "aria": {
                    "sortAscending": ": aktifkan untuk mengurutkan kolom ascending",
                    "sortDescending": ": aktifkan untuk mengurutkan kolom descending"
                }
            }

        });

        // hapus data
        $('#pembayaransTable').on('click', '.delete', function () {
            var pembayaranId = $(this).data('id');
            // var url = $(this).data("url");
            Swal
                .fire({
                    title: 'Apa kamu yakin?',
                    text: "Kamu tidak akan dapat mengembalikan ini!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                })
                .then((result) => {
                    if (result.isConfirmed) {
                        // console.log();
                        $.ajax({
                            url: "/dashboard/admin/pembayaran/destroy/" + pembayaranId,
                            type: 'DELETE',
                            data: {
                                "id": pembayaranId,
                                "_token": "{{csrf_token()}}"
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
                })
        });
    });
</script>
@endsection