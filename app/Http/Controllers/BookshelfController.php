<?php

namespace App\Http\Controllers;

use App\Models\Bookshelf;
use Illuminate\Http\Request;

class BookshelfController extends Controller
{
    public function index()
    {
        $bookshelfs = Bookshelf::all();
        return view('bookshelfs.index', compact('bookshelfs'));
    }

    public function create()
    {
        return view('bookshelfs.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|string|max:10',
            'name' => 'required|string|max:255',
        ]);
        Bookshelf::create($request->only(['code', 'name']));
        return redirect()->route('bookshelf')
            ->with('message', 'Rak buku berhasil ditambahkan!')
            ->with('alert-type', 'success');
    }

    public function edit($id)
    {
        $bookshelf = Bookshelf::findOrFail($id);
        return view('bookshelfs.edit', compact('bookshelf'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'code' => 'required|string|max:10',
            'name' => 'required|string|max:255',
        ]);
        Bookshelf::findOrFail($id)->update($request->only(['code', 'name']));
        return redirect()->route('bookshelf')
            ->with('message', 'Rak buku berhasil diupdate!')
            ->with('alert-type', 'success');
    }

    public function destroy($id)
    {
        Bookshelf::findOrFail($id)->delete();
        return redirect()->route('bookshelf')
            ->with('message', 'Rak buku berhasil dihapus!')
            ->with('alert-type', 'success');
    }
}