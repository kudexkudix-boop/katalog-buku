@extends('layouts.app')

@section('title', 'Home')

@section('content') <h1>Selamat Datang di Katalog Buku</h1>

<p>Silakan lihat daftar buku yang tersedia.</p>

<a href="{{ route('books.index') }}"> <button type="button">Lihat Daftar Buku</button> </a> @endsection