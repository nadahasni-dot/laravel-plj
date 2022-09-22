@extends('layouts.app')

@section('content')
    <h1 class="display-4">Halaman Home</h1>
    <p class="lead">Halam ini merupakan halaman Home</p>
    <p>Nama: {{ $nama }}</p>
    <p>Mata Pelajaran</p>
    <ul>
        @foreach ($pelajaran as $item)
            <li>{{ $item }}</li>
        @endforeach
    </ul>
@endsection
