@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Peminjaman</h1>
    <form action="{{ route('peminjamans.update', $peminjaman->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="tanggal_pinjam" class="form-label">Tanggal Pinjam</label>
            <input type="date" name="tanggal_pinjam" id="tanggal_pinjam" class="form-control" value="{{ $peminjaman->tanggal_pinjam->format('Y-m-d') }}" required>
        </div>
        <div class="mb-3">
            <label for="tanggal_kembali" class="form-label">Tanggal Kembali</label>
            <input type="date" name="tanggal_kembali" id="tanggal_kembali" class="form-control" value="{{ $peminjaman->tanggal_kembali->format('Y-m-d') }}" required>
        </div>
        <div class="mb-3">
            <label for="pelanggan_id" class="form-label">Pelanggan</label>
            <select name="pelanggan_id" id="pelanggan_id" class="form-select" required>
                <option value="">Pilih Pelanggan</option>
                @foreach ($pelanggans as $pelanggan)
                    <option value="{{ $pelanggan->id }}" {{ $peminjaman->pelanggan_id == $pelanggan->id ? 'selected' : '' }}>{{ $pelanggan->nama }} -- {{ $pelanggan->kode_pelanggan }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="user_id" class="form-label">Admin (User)</label>
            <select name="user_id" id="user_id" class="form-select" required>
                <option value="">Pilih Admin</option>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}" {{ $peminjaman->user_id == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Alat yang Dipinjam</label>
            <div id="alat-list">
                @foreach ($peminjaman->alats as $index => $alat)
                    <div class="row mb-2 alat-item">
                        <div class="col">
                            <select name="alats[{{ $index }}][id]" class="form-select" required>
                                <option value="">Pilih Alat</option>
                                @foreach ($alats as $a)
                                    <option value="{{ $a->id }}" {{ $alat->id == $a->id ? 'selected' : '' }}>
                                        {{ $a->nama_alat }} (Stok: {{ $a->stok }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col">
                            <input type="number" name="alats[{{ $index }}][jumlah]" class="form-control" min="1" value="{{ $alat->pivot->jumlah }}" placeholder="Jumlah" required>
                        </div>
                        <div class="col-auto">
                            <button type="button" class="btn btn-danger btn-remove-alat">Hapus</button>
                        </div>
                    </div>
                @endforeach
            </div>
            <button type="button" id="add-alat" class="btn btn-secondary btn-sm mt-2">Tambah Alat</button>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    let alatIndex = {{ $peminjaman->alats->count() }};
    document.getElementById('add-alat').addEventListener('click', function() {
        const alatList = document.getElementById('alat-list');
        const newItem = document.querySelector('.alat-item').cloneNode(true);
        newItem.querySelectorAll('select')[0].name = 'alats[' + alatIndex + '][id]';
        newItem.querySelectorAll('select')[0].value = '';
        newItem.querySelectorAll('input')[0].name = 'alats[' + alatIndex + '][jumlah]';
        newItem.querySelectorAll('input')[0].value = '';
        alatList.appendChild(newItem);
        alatIndex++;

        newItem.querySelector('.btn-remove-alat').addEventListener('click', function() {
            newItem.remove();
        });
    });

    document.querySelectorAll('.btn-remove-alat').forEach(button => {
        button.addEventListener('click', function() {
            if (document.querySelectorAll('.alat-item').length > 1) {
                this.closest('.alat-item').remove();
            }
        });
    });
});
</script>
@endsection
