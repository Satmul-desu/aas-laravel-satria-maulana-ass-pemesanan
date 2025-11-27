@extends('layouts.app')

@section('title', 'Permohonan Pembayaran')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h4>Form Permohonan Pembayaran</h4>
        </div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ \$error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('permohonan-pembayaran.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="pelanggan_id" class="form-label">Pelanggan</label>
                    <select id="pelanggan_id" name="pelanggan_id" class="form-select" required>
                        <option value="">-- Pilih Pelanggan --</option>
                        @foreach(\App\Models\Pelanggan::all() as $pelanggan)
                            <option value="{{ \$pelanggan->id }}" {{ old('pelanggan_id') == \$pelanggan->id ? 'selected' : '' }}>{{ \$pelanggan->nama }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="jenis_pembayaran" class="form-label">Jenis Pembayaran</label>
                    <select id="jenis_pembayaran" name="jenis_pembayaran" class="form-select" required>
                        <option value="">-- Pilih Jenis Pembayaran --</option>
                        @foreach (\$paymentTypes as \$type)
                            <option value="{{ \$type }}" {{ old('jenis_pembayaran') == \$type ? 'selected' : '' }}>{{ ucfirst(\$type) }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat (Opsional)</label>
                    <textarea id="alamat" name="alamat" class="form-control" rows="2">{{ old('alamat') }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi (Opsional)</label>
                    <textarea id="deskripsi" name="deskripsi" class="form-control" rows="3">{{ old('deskripsi') }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="harga" class="form-label">Harga (Nominal yang harus dibayar)</label>
                    <input type="number" id="harga" name="harga" class="form-control" value="{{ old('harga') }}" required min="0" step="0.01">
                </div>

                <button type="submit" class="btn btn-success">Kirim Permohonan</button>
                <a href="{{ route('pemesanans.index') }}" class="btn btn-secondary ms-2">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection
