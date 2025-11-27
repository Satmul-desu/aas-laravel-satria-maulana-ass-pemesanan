@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Tambah Peminjaman</h1>
    <form action="{{ route('peminjamans.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="tanggal_pinjam" class="form-label">Tanggal Pinjam</label>
            <input type="date" name="tanggal_pinjam" id="tanggal_pinjam" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="tanggal_kembali" class="form-label">Tanggal Kembali</label>
            <input type="date" name="tanggal_kembali" id="tanggal_kembali" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="user_id" class="form-label">Admin (User)</label>
            <select name="user_id" id="user_id" class="form-select" required>
                <option value="">Pilih Admin</option>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Alat yang Dipinjam</label>
            <div id="alat-list">
                <div class="row mb-2 alat-item">
                    <div class="col">
                        <select name="alats[0][id]" class="form-select" required>
                            <option value="">Pilih Alat</option>
                            @foreach ($alats as $alat)
                                <option value="{{ $alat->id }}">{{ $alat->nama_alat }} (Stok: {{ $alat->stok }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col">
                        <input type="number" name="alats[0][jumlah]" class="form-control" min="1" placeholder="Jumlah" required>
                    </div>
                    <div class="col-auto">
                        <button type="button" class="btn btn-danger btn-remove-alat">Hapus</button>
                    </div>
                </div>
            </div>
            <button type="button" id="add-alat" class="btn btn-secondary btn-sm mt-2">Tambah Alat</button>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    let alatIndex = 1;
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
