<?php

namespace App\Http\Controllers;

use App\Models\Pengeluaran;
use App\Models\Saldo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PengeluaranController extends Controller
{
    // List all pengeluaran items
    public function index()
    {
        $pengeluarans = Pengeluaran::orderBy('created_at', 'desc')->get();
        $saldo = Saldo::latest()->first();
        $currentSaldo = $saldo ? $saldo->amount : 0;

        return view('pengeluaran.index', compact('pengeluarans', 'currentSaldo'));
    }

    // Pay a pengeluaran by ID - marks as paid, sets payment date, and reduces saldo
    public function pay($id)
    {
        return DB::transaction(function () use ($id) {
            $pengeluaran = Pengeluaran::findOrFail($id);

            if ($pengeluaran->status === 'paid') {
                return redirect()->back()->with('error', 'Pengeluaran sudah dibayar.');
            }

            $saldo = Saldo::latest()->first();
            if (!$saldo || $saldo->amount < $pengeluaran->amount) {
                return redirect()->back()->with('error', 'Saldo tidak cukup untuk membayar pengeluaran ini.');
            }

            // Update saldo amount
            $saldo->amount -= $pengeluaran->amount;
            $saldo->save();

            // Mark pengeluaran as paid
            $pengeluaran->status = 'paid';
            $pengeluaran->payment_date = now();
            $pengeluaran->save();

            return redirect()->back()->with('success', 'Pengeluaran berhasil dibayar.');
        });
    }
}
