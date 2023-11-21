@extends('layouts.app')
@push('style')

@endpush
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
@push('script')
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
<script>
    new DataTable('#oji_table');
</script>
@endpush

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @if (session('message'))
            <div class="alert alert-success" role="alert">
                {{ session('message') }}
            </div>
            @endif
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <a href="{{ route('mobil.create') }}" class="btn btn-success">
                        Tambah Data</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="oji_table" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Merk</th>
                                    <th>Model</th>
                                    <th>No Plat</th>
                                    <th>Tarif Sewa</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($mobil as $data)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $data->merk }}</td>
                                    <td>{{ $data->model }}</td>
                                    <td>{{ $data->no_plat }}</td>
                                    <td>@format_angka($data->tarif_sewa)</td>
                                    <td>
                                        @if($data->status == 'ready')
                                        <a href="#" class="btn btn-sm btn-success">Ready</a>
                                        @else
                                        <a href="#" class="btn btn-sm btn-danger">Not Ready</a>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-center gap-3 align-items-start">
                                            <a href="{{ route('mobil.edit', $data->id) }}"
                                                class="btn btn-primary btn-circle ">
                                                Edit
                                            </a>

                                            <form method="POST" action="{{ route('mobil.destroy', $data->id) }}">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" class="btn btn-danger btn-circle"
                                                    onclick="return confirm('Hapus data?')">Hapus</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection