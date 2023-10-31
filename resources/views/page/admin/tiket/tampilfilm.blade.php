<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0 shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="style.css">    
    <title>Pembelian Tiket Film Bioskop</title>
</head>
<body>
    <div class="container">
        <form action="{{ route('tiket.update', ['id' => $data->id]) }}" method="POST" enctype="multipart/form-data" onsubmit="">
            @csrf
            <h2 class="text-center mt-4 mb-4">Tiket Bioskop</h2>

            <div class="form-group">
                <label for="judul_film">Judul Film</label>
                <input type="text" name="judul_film" class="form-control" id="judul_film" placeholder="Masukkan judul film" value = "{{ $data -> judul_film }}">
            </div>

            <div class="form-group">
                <label for="waktu">Waktu</label>
                <input type="time" name="waktu" class="form-control" id="waktu" placeholder="Masukkan waktu" value = "{{ $data -> waktu }}">
            </div>

            <div class="form-group">
                <label for="tanggal_pemesanan">Tanggal Pemesanan</label>
                <input type="date" name="tanggal_pemesanan" class="form-control" id="tanggal_pemesanan" placeholder="Masukkan tanggal pemesanan" value = "{{ $data -> tanggal_pemesanan }}">
            </div>

            <div class="form-group">
                <label for="row_kursi">Row Kursi</label>
                <input type="text" name="row_kursi" class="form-control" id="row_kursi" placeholder="Masukkan row kursi" value = "{{ $data -> row_kursi }}">
            </div>

            <div class="form-group">
                <label for="seat_kursi">Seat Kursi</label>
                <input type="text" name="seat_kursi" class="form-control" id="seat_kursi" placeholder="Masukkan seat kursi" value = "{{ $data -> seat_kursi }}">
            </div>

            <div class="form-group">
                <label for="jumlah_tiket">Jumlah Tiket</label>
                <input type="number" name="jumlah_tiket" class="form-control" id="jumlah_tiket" placeholder="Masukkan jumlah tiket" value = "{{ $data -> jumlah_tiket }}">
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>

    <footer>
        <p>© 2023 Pembelian Tiket Film Bioskop.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3/dist/js/bootstrap.min.js"></script>
</body>
</html>
