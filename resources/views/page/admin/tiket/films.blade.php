<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0 shrink-to-fit=no">
    <link rel="stylesheet" type="text/css" href="style.css">    
    <title >Tiket Bioskop</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body>
    <h1 class="text-center mt-4 mb-4"> Pembelian Tiket Film Bioskop </h1>

    <div class="container">
        <a href="/formfilm" class="btn btn-success mb-3" >Tambah</a>
        <div class="row">
        @if ($message = Session::get('success'))
            <div class="alert alert-success" role="alert">
                {{$message}}
            </div>
        @endif
            <table class="table">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Judul Film</th>
                <th scope="col">Waktu</th>
                <th scope="col">Tanggal Pemesanan</th>
                <th scope="col">Row Kursi</th>
                <th scope="col">Seat Kursi</th>
                <th scope="col">Jumlah Tiket</th>
              </tr>
            </thead>
            <tbody>
            @foreach ($data as $row)
                <tr>
                    <th scope="row">{{$row->id}}</th>
                    <td>{{$row->judul_film}}</td>
                    <td>{{$row->waktu}}</td>
                    <td>{{$row->tanggal_pemesanan}}</td>
                    <td>{{$row->row_kursi}}</td>
                    <td>{{$row->seat_kursi}}</td>
                    <td>{{$row->jumlah_tiket}}</td>
                    <td>
                        <a href="/tampilkandata/{{$row->id}}"  class="btn btn-primary">Edit</a>
                        <a href="#" class="btn btn-danger delete" data-id="{{$row->id}}" >Delete</a>
                    </td>
                </tr>
            @endforeach              
            </tbody>
            </table>    
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.slim.js" integrity="sha256-UgvvN8vBkgO0luPSUl2s8TIlOSYRoGFAX4jlCIm9Adc=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
<script>

    $('.delete').click(function(){
        var jobid = $(this).attr('data-id')
        Swal.fire({
          title: 'Peringatan!',
          text: "Apakah kamu yakin data job dengan id "+jobid+"  ini mau dihapus?",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Ya, hapus!'
        }).then((result) => {
          if (result.isConfirmed) {
            window.location ="/deletedata/"+jobid+""
            Swal.fire(
              'Terhapus!',
              'Data berhasil terhapus.',
              'success'
            )
          }
        });    
    });   
</script>
</html>