@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Detail Pelanggan</h4>
                </div> 
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>ID:</strong> {{ $pelanggan->id }}</p>
                            <p><strong>Kode Pelanggan:</strong> {{ $pelanggan->kode_pelanggan }}</p>
                            <p><strong>Nama:</strong> {{ $pelanggan->nama }}</p>
                            <p><strong>Email:</strong> {{ $pelanggan->email }}</p>
                            <p><strong>Telepon:</strong> {{ $pelanggan->telepon }}</p>
                            <p><strong>Alamat:</strong> {{ $pelanggan->alamat }}</p>
                            <p><strong>Dibuat:</strong> {{ $pelanggan->created_at->format('d-m-Y H:i') }}</p>
                            <p><strong>Diupdate:</strong> {{ $pelanggan->updated_at->format('d-m-Y H:i') }}</p>
                        </div>
                    </div>
                    <a href="{{ route('pelanggans.index') }}" class="btn btn-secondary">Kembali</a>
                    <a href="{{ route('pelanggans.edit', $pelanggan) }}" class="btn btn-warning">Edit</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
