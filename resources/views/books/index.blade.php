@extends('layouts.app')

@section('title', 'data Buku')

@section('content')
    <h1>Data Buku</h1>

    {{-- Potongan index.blade.php --}}
<form method="GET" action="{{ route('books.index') }}">
    <input
        type="search"
        name="q"
        value="{{ $keyword }}"
        placeholder="Cari judul, penulis, atau ISBN"
    >
    <button type="submit">Cari</button>
    <a href="{{ route('books.index') }}">Reset</a>
</form>


    <ul>
       @forelse ($books as $book)
    <tr>
        <td>{{ $books->firstItem() + $loop->index }}</td>
        <td>{{ $book->title }}</td>
        <td>{{ $book->author }}</td>
        <td>{{ $book->stock }}</td>
        <td>
            <a href="{{ route('books.show', $book) }}">Detail</a>
            <form method="POST"action="{{ route('books.destroy', $book) }}"onsubmit="return confirm('Hapus data buku ini?')">

                @csrf
                @method('DELETE')
                <button type="submit">Hapus</button>

            </form>
        </td>
    </tr>
@empty

    <tr>
        <td colspan="5">Data belum tersedia.</td>
    </tr>

@endforelse

    @if ($books->hasPages())
    <nav>
        @if ($books->onFirstPage())
            <span>Sebelumnya</span>
        @else
            <a href="{{ $books->previousPageUrl() }}">Sebelumnya</a>
        @endif

        <span>
            Halaman {{ $books->currentPage() }}
            dari {{ $books->lastPage() }}
        </span>

        @if ($books->hasMorePages())
            <a href="{{ $books->nextPageUrl() }}">Berikutnya</a>
        @endif
    </nav>
    @endif

@endsection