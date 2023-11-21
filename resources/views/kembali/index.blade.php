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
                    <a href="{{ route('kembali.create') }}" class="btn btn-success">
                        Kembalikan</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="oji_table" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Mobil</th>
                                    <th>Tanggal Kembali</th>
                                    <th>Total Biaya Sewa</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($kembali as $data)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $data->pinjam->mobil->merk }} {{ $data->pinjam->mobil->model }} - {{
                                        $data->pinjam->mobil->no_plat }}</td>
                                    <td>{{ $data->tanggal_kembali->isoFormat('D MMMM Y') }}</td>
                                    <td>@format_angka($data->total_biaya)</td>
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