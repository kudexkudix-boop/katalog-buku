<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\View\View;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;


class BookController extends Controller
{
    // public function index(): View
    // {
    //     $books= [ 
    //         [
    //         'id'=> 1,
    //         'title'=>'Dasar Pemrograman web',
    //         'author' =>'Ayu Pratama',
    //         ],
    //         [
    //             'id'=> 2,
    //             'title'=> 'Basis Data terapan',
    //             'author'=> 'Bima Nugraha',
    //         ],

    //     ];

    //     return view('books.index', compact('books'));
    // }

    // public function show(int $id): View
    // {
    //     return view('books.show-static', ['id' => $id]);
    // }

    // public function index(): View
    // {
    //     $books = Book::query()
    //     ->latest()
    //     ->paginate(10);
        
    //     return view('books.index',compact('books'));
    // }

    public function show(Book $book): View
    {
        return view('books.show', compact('book'));
    }

    public function create(): View
    {
    return view('books.create');
    }

    // public function store(Request $request): RedirectResponse
    // {
    // $validated = $request->validate([
    //     'title' => ['required', 'string', 'max:255'],
    //     'isbn' => [
    //         'nullable',
    //         'string',
    //         'max:20',
    //         'unique:books,isbn',
    //     ],
    //     'author' => ['required', 'string', 'max:150'],
    //     'publisher' => ['nullable', 'string', 'max:150'],
    //     'published_year' => [
    //         'nullable',
    //         'integer',
    //         'min:1900',
    //         'max:'.date('Y'),
    //     ],
    //     'price' => ['required', 'numeric', 'min:0'],
    //     'stock' => ['required', 'integer', 'min:0'],
    //     'description' => ['nullable', 'string'],
    // ]);

    // Book::create($validated);

    // return redirect()
    //     ->route('books.index')
    //     ->with('success', 'Data buku berhasil ditambahkan.');
    // }
    
    //p6
    public function edit(Book $book): View
    {
    return view('books.edit', compact('book'));
    }

    // public function update(Request $request, Book $book): RedirectResponse
    // {
    // $validated = $request->validate([
    //     'title' => ['required', 'string', 'max:255'],
    //     'isbn' => [
    //         'nullable',
    //         'string',
    //         'max:20',
    //         Rule::unique('books', 'isbn')->ignore($book),
    //     ],
    //     'author' => ['required', 'string', 'max:150'],
    //     'publisher' => ['nullable', 'string', 'max:150'],
    //     'published_year' => [
    //         'nullable',
    //         'integer',
    //         'min:1900',
    //         'max:'.date('Y'),
    //     ],
    //     'price' => ['required', 'numeric', 'min:0'],
    //     'stock' => ['required', 'integer', 'min:0'],
    //     'description' => ['nullable', 'string'],
    // ]);

    // $book->update($validated);

    // return redirect()
    //     ->route('books.index')
    //     ->with('success', 'Data buku berhasil diperbarui.');
    // }

    public function destroy(Book $book): RedirectResponse
    {
    $book->delete();

    return redirect()
        ->route('books.index')
        ->with('success', 'Data buku berhasil dihapus.');
    }

    //p7
    public function store(StoreBookRequest $request): RedirectResponse
    {
    Book::create($request->validated());

    return redirect()
        ->route('books.index')
        ->with('success', 'Data buku berhasil ditambahkan.');
    }

    public function update(UpdateBookRequest $request,Book $book): RedirectResponse 
    {
        $book->update($request->validated());

        return redirect()
            ->route('books.index')
            ->with('success', 'Data buku berhasil diperbarui.');
    }

    public function index(Request $request): View
    {
    $keyword = trim((string) $request->query('q', ''));

    $books = Book::query()
        ->when($keyword !== '', function ($query) use ($keyword): void {
            $query->where(function ($subQuery) use ($keyword): void {
                $subQuery
                    ->where('title', 'like', "%{$keyword}%")
                    ->orWhere('author', 'like', "%{$keyword}%")
                    ->orWhere('isbn', 'like', "%{$keyword}%");
            });
        })
        ->latest()
        ->paginate(10)
        ->withQueryString();

    return view('books.index', compact('books', 'keyword'));
    }



}

