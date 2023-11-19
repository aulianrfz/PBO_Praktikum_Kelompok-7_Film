<!-- resources/views/page/admin/tiket/films.blade.php -->

@include('layouts.app')

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0 shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <title>Pembelian Tiket Film Bioskop</title>
</head>

<body>
    <div class="container">
        <h2 class="text-center mt-4 mb-4">Tiket Bioskop</h2>
        <div class="container">
            <a href="{{ route('tiket.formfilm') }}" class="btn btn-success mb-3">Tambah</a>
            <div class="row">
                @if ($message = Session::get('success'))
                    <div class="alert alert-success" role="alert">
                        {{ $message }}
                    </div>
                @endif
                <table id="filmsTable" class="table">
                    <thead>
                        <tr>
                            <th>Judul Film</th>
                            <th>Waktu</th>
                            <th>Tanggal Pemesanan</th>
                            <th>Row Kursi</th>
                            <th>Seat Kursi</th>
                            <th>Jumlah Tiket</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    <footer style="text-align: center">
        <p>© 2023 Pembelian Tiket Film Bioskop.</p>
    </footer>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    ...

<script>
    $(document).ready(function() {
        var table = $('#filmsTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('tiket.films') }}",
            columns: [
                { data: 'judul_film', name: 'judul_film' },
                { data: 'waktu', name: 'waktu' },
                { data: 'tanggal_pemesanan', name: 'tanggal_pemesanan' },
                { data: 'row_kursi', name: 'row_kursi' },
                { data: 'seat_kursi', name: 'seat_kursi' },
                { data: 'jumlah_tiket', name: 'jumlah_tiket' },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false,
                    className: 'text-center',
                },
            ],
        });

        $('#filmsTable').on('click', '.delete', function() {
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
</body>

</html>
