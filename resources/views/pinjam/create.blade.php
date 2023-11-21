@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    Tambah Peminjaman
                </div>
                <div class="card-body">
                    <form id="form" action="{{ route('pinjam.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="mobil_id">Mobil</label>
                            <select class="form-control" id="mobil_id" name="mobil_id" required>
                                <option value="">-- Pilih --</option>
                                @foreach ($mobil as $mob)
                                <option value="{{ $mob->id }}">{{ $mob->model }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="tanggal_mulai">Tanggal Mulai</label>
                            <input type="date" class="form-control" id="tanggal_mulai" name="tanggal_mulai" required
                                value="{{ old('model') }}">
                        </div>
                        <div class="form-group">
                            <label for="tanggal_selesai">Tanggal Selesai</label>
                            <input type="date" class="form-control" id="tanggal_selesai" name="tanggal_selesai" required
                                value="{{ old('tanggal_selesai') }}">
                        </div>
                        <button type="submit" class="btn btn-success mt-3">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endsection