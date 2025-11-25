@extends('layouts.app')

@section('title', 'Daftar Pengeluaran')

@section('content')
<div class="container py-4">
    <h2>Daftar Pengeluaran</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Jenis Tagihan</th>
                <th>Jumlah</th>
                <th>Status</th>
                <th>Tanggal Pembayaran</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pengeluarans as $item)
            <tr>
                <td>{{ $item->type }}</td>
                <td>Rp {{ number_format($item->amount, 0, ',', '.') }}</td>
                <td>
                    @if($item->status === 'paid')
                        <span class="badge bg-success">Dibayar</span>
                    @else
                        <span class="badge bg-warning text-dark">Belum Dibayar</span>
                    @endif
                </td>
                <td>{{ $item->payment_date ? $item->payment_date->format('d/m/Y H:i') : '-' }}</td>
                <td>
                    @if($item->status === 'unpaid')
                    <form method="POST" action="{{ route('pengeluaran.pay', $item->id) }}">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-success">Bayar</button>
                    </form>
                    @else
                    <i class="fas fa-check text-success"></i>
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center">Belum ada pengeluaran</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-4">
        <h5>Saldo Saat Ini: Rp {{ number_format($currentSaldo, 0, ',', '.') }}</h5>
    </div>
</div>
@endsection
