<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\User;
use Illuminate\Http\Request;

class LoanController extends Controller
{
    public function index()
    {
        $loans = Loan::with('user')->get();
        return view('loans.index', compact('loans'));
    }

    public function create()
    {
        $users = User::all();
        return view('loans.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_npm'  => 'required|exists:users,npm',
            'loan_at'   => 'required|date',
            'return_at' => 'required|date|after_or_equal:loan_at',
        ]);
        Loan::create($request->only(['user_npm', 'loan_at', 'return_at']));
        return redirect()->route('loan')
            ->with('message', 'Peminjaman berhasil ditambahkan!')
            ->with('alert-type', 'success');
    }

    public function edit($id)
    {
        $loan = Loan::findOrFail($id);
        $users = User::all();
        return view('loans.edit', compact('loan', 'users'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'user_npm'  => 'required|exists:users,npm',
            'loan_at'   => 'required|date',
            'return_at' => 'required|date|after_or_equal:loan_at',
        ]);
        Loan::findOrFail($id)->update($request->only(['user_npm', 'loan_at', 'return_at']));
        return redirect()->route('loan')
            ->with('message', 'Peminjaman berhasil diupdate!')
            ->with('alert-type', 'success');
    }

    public function destroy($id)
    {
        Loan::findOrFail($id)->delete();
        return redirect()->route('loan')
            ->with('message', 'Peminjaman berhasil dihapus!')
            ->with('alert-type', 'success');
    }
}