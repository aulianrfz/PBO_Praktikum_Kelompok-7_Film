<!-- resources/views/pembelians/index.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="text-center mt-4 mb-4">Data Pembelian Tiket</h2>
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                {{ $message }}
            </div>
        @endif
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Film</th>
                    <th>Jumlah Tiket</th>
                    <th>Total Harga</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pembelians as $pembelian)
                    <tr id="pembelian_{{ $pembelian->id }}">
                        <td>{{ $pembelian->id }}</td>
                        <td>{{ $pembelian->film->judul_film }}</td>
                        <td>{{ $pembelian->jumlah_tiket }}</td>
                        <td>{{ $pembelian->total_harga }}</td>
                        <td>
                            <a href="{{ route('pembelians.edit', $pembelian->id) }}" class="btn btn-primary">Edit</a>
                            <button class="btn btn-danger" onclick="deletePembelian({{ $pembelian->id }})">Delete</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script>
        function deletePembelian(id) {
            // Make an AJAX request to delete the record
            fetch('{{ url('dashboard/admin/pembelians/delete') }}/' + id, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-Token': '{{ csrf_token() }}',
                },
            })
            .then(response => response.json())
            .then(data => {
                // Handle the response, you can remove the row or show a success message
                console.log(data);

                // Remove the row from the table
                document.getElementById('pembelian_' + id).remove();
            })
            .catch(error => {
                // Handle errors
                console.error('Error:', error);
            });
        }
    </script>
@endsection
