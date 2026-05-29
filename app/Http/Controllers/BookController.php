<?php

namespace App\Http\Controllers;

use App\Exports\BooksExport;
use App\Imports\BooksImport;
use App\Models\Book;
use App\Models\Bookshelf;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

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
            'title'        => 'required|max:255',
            'author'       => 'required|max:150',
            'year'         => 'required|digits:4|integer|min:1900|max:' . date('Y'),
            'publisher'    => 'required|max:100',
            'city'         => 'required|max:75',
            'bookshelf_id' => 'required|exists:bookshelfs,id',
            'cover'        => 'nullable|image|max:2048',
        ]);

        $data = $request->only(['title', 'author', 'year', 'publisher', 'city', 'bookshelf_id']);

        if ($request->hasFile('cover')) {
            $path = $request->file('cover')->storeAs(
                'covers',
                'cover_' . time() . '.' . $request->file('cover')->extension(),
                'public'
            );
            $data['cover'] = $path;
        }

        Book::create($data);

        return redirect()->route('book')
            ->with('message', 'Data buku berhasil ditambahkan!')
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
            'title'        => 'required|max:255',
            'author'       => 'required|max:150',
            'year'         => 'required|digits:4|integer|min:1900|max:' . date('Y'),
            'publisher'    => 'required|max:100',
            'city'         => 'required|max:75',
            'bookshelf_id' => 'required|exists:bookshelfs,id',
            'cover'        => 'nullable|image|max:2048',
        ]);

        $data = $request->only(['title', 'author', 'year', 'publisher', 'city', 'bookshelf_id']);

        if ($request->hasFile('cover')) {
            // Hapus cover lama
            if ($book->cover) {
                Storage::delete('public/' . $book->cover);
            }
            $path = $request->file('cover')->storeAs(
                'covers',
                'cover_' . time() . '.' . $request->file('cover')->extension(),
                'public'
            );
            $data['cover'] = $path;
        }

        $book->update($data);

        return redirect()->route('book')
            ->with('message', 'Data buku berhasil diperbarui!')
            ->with('alert-type', 'success');
    }

    public function destroy($id)
    {
        $book = Book::findOrFail($id);

        if ($book->cover) {
            Storage::delete('public/' . $book->cover);
        }

        $book->delete();

        return redirect()->route('book')
            ->with('message', 'Data buku berhasil dihapus!')
            ->with('alert-type', 'success');
    }

    public function print()
    {
        $books = Book::with('bookshelf')->get();
        $pdf = Pdf::loadView('books.print', ['books' => $books]);
        return $pdf->stream('data_buku.pdf');
    }

    public function export()
    {
        return Excel::download(new BooksExport, 'books.xlsx');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|max:10000|mimes:xlsx,xls',
        ]);

        Excel::import(new BooksImport, $request->file('file'));

        return redirect()->route('book')
            ->with('message', 'Import data berhasil dilakukan!')
            ->with('alert-type', 'success');
    }
}