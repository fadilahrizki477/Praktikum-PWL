<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $request->validate(['category' => 'required|string|max:255']);
        Category::create($request->only('category'));
        return redirect()->route('category')
            ->with('message', 'Kategori berhasil ditambahkan!')
            ->with('alert-type', 'success');
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $request->validate(['category' => 'required|string|max:255']);
        Category::findOrFail($id)->update($request->only('category'));
        return redirect()->route('category')
            ->with('message', 'Kategori berhasil diupdate!')
            ->with('alert-type', 'success');
    }

    public function destroy($id)
    {
        Category::findOrFail($id)->delete();
        return redirect()->route('category')
            ->with('message', 'Kategori berhasil dihapus!')
            ->with('alert-type', 'success');
    }
}