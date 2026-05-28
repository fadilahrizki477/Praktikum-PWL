<?php

namespace App\Http\Controllers;

use App\Models\ReturnModel;
use App\Models\LoanDetail;
use Illuminate\Http\Request;

class ReturnController extends Controller
{
    public function index()
    {
        $returns = ReturnModel::with(['loanDetail.book', 'loanDetail.loan.user'])->get();
        return view('returns.index', compact('returns'));
    }

    public function create()
    {
        $loanDetails = LoanDetail::with(['loan.user', 'book'])->get();
        return view('returns.create', compact('loanDetails'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'loan_detail_id' => 'required|exists:loan_detail,id',
            'amount'         => 'required|integer|min:0',
        ]);
        ReturnModel::create([
            'loan_detail_id' => $request->loan_detail_id,
            'charge'         => $request->boolean('charge'),
            'amount'         => $request->amount,
        ]);
        LoanDetail::find($request->loan_detail_id)->update(['is_return' => true]);
        return redirect()->route('return')
            ->with('message', 'Pengembalian berhasil ditambahkan!')
            ->with('alert-type', 'success');
    }

    public function edit($id)
    {
        $return = ReturnModel::findOrFail($id);
        $loanDetails = LoanDetail::with(['loan.user', 'book'])->get();
        return view('returns.edit', compact('return', 'loanDetails'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'loan_detail_id' => 'required|exists:loan_detail,id',
            'amount'         => 'required|integer|min:0',
        ]);
        ReturnModel::findOrFail($id)->update([
            'loan_detail_id' => $request->loan_detail_id,
            'charge'         => $request->boolean('charge'),
            'amount'         => $request->amount,
        ]);
        return redirect()->route('return')
            ->with('message', 'Pengembalian berhasil diupdate!')
            ->with('alert-type', 'success');
    }

    public function destroy($id)
    {
        ReturnModel::findOrFail($id)->delete();
        return redirect()->route('return')
            ->with('message', 'Pengembalian berhasil dihapus!')
            ->with('alert-type', 'success');
    }
}