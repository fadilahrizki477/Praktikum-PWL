<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Bookshelf;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::with('bookshelf')->get();
        return view('books.index', compact('books'));
    }

    public function create()
    {
        $bookshelfs = Bookshelf::all();
        return view('books.create', compact('bookshelfs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'        => 'required|string|max:255',
            'author'       => 'required|string|max:255',
            'year'         => 'required|digits:4',
            'publisher'    => 'required|string|max:255',
            'city'         => 'required|string|max:255',
            'bookshelf_id' => 'required|exists:bookshelfs,id',
            'cover'        => 'nullable|image|max:2048',
        ]);

        $data = $request->only(['title', 'author', 'year', 'publisher', 'city', 'bookshelf_id']);
        if ($request->hasFile('cover')) {
            $data['cover'] = $request->file('cover')->store('covers', 'public');
        }

        Book::create($data);
        return redirect()->route('book')
            ->with('message', 'Buku berhasil ditambahkan!')
            ->with('alert-type', 'success');
    }

    public function edit($id)
    {
        $book = Book::findOrFail($id);
        $bookshelfs = Bookshelf::all();
        return view('books.edit', compact('book', 'bookshelfs'));
    }

    public function update(Request $request, $id)
    {
        $book = Book::findOrFail($id);
        $request->validate([
            'title'        => 'required|string|max:255',
            'author'       => 'required|string|max:255',
            'year'         => 'required|digits:4',
            'publisher'    => 'required|string|max:255',
            'city'         => 'required|string|max:255',
            'bookshelf_id' => 'required|exists:bookshelfs,id',
            'cover'        => 'nullable|image|max:2048',
        ]);

        $data = $request->only(['title', 'author', 'year', 'publisher', 'city', 'bookshelf_id']);
        if ($request->hasFile('cover')) {
            $data['cover'] = $request->file('cover')->store('covers', 'public');
        }

        $book->update($data);
        return redirect()->route('book')
            ->with('message', 'Buku berhasil diupdate!')
            ->with('alert-type', 'success');
    }

    public function destroy($id)
    {
        Book::findOrFail($id)->delete();
        return redirect()->route('book')
            ->with('message', 'Buku berhasil dihapus!')
            ->with('alert-type', 'success');
    }
}