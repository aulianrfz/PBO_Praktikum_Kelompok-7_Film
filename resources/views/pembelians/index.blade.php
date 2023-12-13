<!-- resources/views/pembelians/index.blade.php -->

@extends('layouts.app')

@section('content')
    <h1>Data Pembelian</h1>

    <!-- Tampilkan data pembelian di sini -->
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Film</th>
                <th>Jumlah Tiket</th>
                <th>Harga</th>
                <th>Total Harga</th>
                <th>Jumlah Pembayaran</th>
                <th>Tanggal Pembayaran</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $pembelian)
                <tr>
                    <td>{{ $pembelian->id }}</td>
                    <td>{{ $pembelian->film->judulFilm }}</td>
                    <td>{{ $pembelian->jumlah_tiket }}</td>
                    <td>{{ $pembelian->harga }}</td>
                    <td>{{ $pembelian->total_harga }}</td>
                    <td>{{ $pembelian->jumlah_pembayaran }}</td>
                    <td>{{ $pembelian->tanggal_pembayaran }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
