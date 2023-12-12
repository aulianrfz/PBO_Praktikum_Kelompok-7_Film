@extends('tampilan.profil')

@section('bodyfilm')
<div class="movie-info border-b border-gray-800">
    <div class="container mx-auto px-4 py-16 flex flex-col md:flex-row">
        <div class="flex-none">
            <img src="https://image.tmdb.org/t/p/w500//qV4fdXXUm5xNlEJ2jw7af3XxuQB.jpg" alt="poster"
                class="w-64 lg:w-96">
        </div>
        <div class="md:ml-24">
            <h2 class="text-4xl mt-4 md:mt-0 font-semibold">{{ $data->judulFilm }} </h2>
            <div class="flex flex-wrap items-center text-gray-400 text-sm">
                <svg class="fill-current text-orange-500 w-4" viewBox="0 0 24 24">
                    <g data-name="Layer 2">
                        <path
                            d="M17.56 21a1 1 0 01-.46-.11L12 18.22l-5.1 2.67a1 1 0 01-1.45-1.06l1-5.63-4.12-4a1 1 0 01-.25-1 1 1 0 01.81-.68l5.7-.83 2.51-5.13a1 1 0 011.8 0l2.54 5.12 5.7.83a1 1 0 01.81.68 1 1 0 01-.25 1l-4.12 4 1 5.63a1 1 0 01-.4 1 1 1 0 01-.62.18z"
                            data-name="star"></path>
                    </g>
                </svg>
                <span class="ml-1">{{ $data->rating }} %</span>
                <span class="mx-2">|</span>
                <span>{{ $data->rilis }} </span>
                <span class="mx-2">|</span>
                <span>{{ $data->genre }} </span>
            </div>

            <p class="text-gray-300 mt-8">{{ $data->deskripsi }}</p>

            <div class="mt-12">
                <button @click="isOpen = true"
                    class="flex inline-flex items-center bg-orange-500 text-gray-900 rounded font-semibold px-5 py-4 hover:bg-orange-600 transition ease-in-out duration-150">
                    <svg class="w-6 fill-current" viewBox="0 0 24 24">
                        <path d="M0 0h24v24H0z" fill="none"></path>
                        <path
                            d="M10 16.5l6-4.5-6-4.5v9zM12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z">
                        </path>
                    </svg>
                    <a href="/dashboard/admin/tiket/formtiket">
                        <span class="ml-2">Pesan tiket</span>
                    </a>
                </button>
            </div>
        </div>
    </div>
</div>

@endsection('bodyfilm')