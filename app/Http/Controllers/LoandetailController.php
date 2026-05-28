<?php

namespace App\Http\Controllers;

use App\Models\LoanDetail;
use App\Models\Loan;
use App\Models\Book;
use Illuminate\Http\Request;

class LoanDetailController extends Controller
{
    public function index()
    {
        $loanDetails = LoanDetail::with(['loan.user', 'book'])->get();
        return view('loan-details.index', compact('loanDetails'));
    }

    public function create()
    {
        $loans = Loan::with('user')->get();
        $books = Book::all();
        return view('loan-details.create', compact('loans', 'books'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'loan_id' => 'required|exists:loans,id',
            'book_id' => 'required|exists:books,id',
        ]);
        LoanDetail::create([
            'loan_id'   => $request->loan_id,
            'book_id'   => $request->book_id,
            'is_return' => $request->boolean('is_return'),
        ]);
        return redirect()->route('loan-detail')
            ->with('message', 'Detail peminjaman berhasil ditambahkan!')
            ->with('alert-type', 'success');
    }

    public function edit($id)
    {
        $loanDetail = LoanDetail::findOrFail($id);
        $loans = Loan::with('user')->get();
        $books = Book::all();
        return view('loan-details.edit', compact('loanDetail', 'loans', 'books'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'loan_id' => 'required|exists:loans,id',
            'book_id' => 'required|exists:books,id',
        ]);
        LoanDetail::findOrFail($id)->update([
            'loan_id'   => $request->loan_id,
            'book_id'   => $request->book_id,
            'is_return' => $request->boolean('is_return'),
        ]);
        return redirect()->route('loan-detail')
            ->with('message', 'Detail peminjaman berhasil diupdate!')
            ->with('alert-type', 'success');
    }

    public function destroy($id)
    {
        LoanDetail::findOrFail($id)->delete();
        return redirect()->route('loan-detail')
            ->with('message', 'Detail peminjaman berhasil dihapus!')
            ->with('alert-type', 'success');
    }
}