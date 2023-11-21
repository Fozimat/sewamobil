@extends('layouts.app')

@push('script')
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script>
    $(document).ready(function() {
        $("#mobil_id").change(function() {
            var selected = $(this).val();
            if (selected) {
                $.ajax({
                    url: '/getPinjamanInfo/' + selected,
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        var lama_sewa = response.lama_sewa;
                        var total_tarif = response.total_tarif;
                        $("#lama_sewa").text(`Lama Pinjaman: ${lama_sewa} hari`);
                        $("#total_tarif").text(`Total Tarif: ${total_tarif}`);
                        $("#total_biaya").val(total_tarif);
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            } else {
                $("#lama_sewa").text("");
                $("#total_tarif").text("");
            }
        });
    });
</script>
@endpush

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    Kembalikan Mobil
                </div>
                <div class="card-body">
                    <form id="form" action="{{ route('kembali.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="tanggal_kembali">Tanggal Kembali</label>
                            <input type="date" class="form-control" id="tanggal_kembali" name="tanggal_kembali" required
                                value="{{ old('tanggal_kembali') }}">
                        </div>
                        <div class="form-group">
                            <label for="mobil_id">Mobil</label>
                            <select class="form-control" id="mobil_id" name="mobil_id" required>
                                <option value="">-- Pilih --</option>
                                @foreach ($array_mobil as $id => $data_mobil)
                                <option value="{{ $id }}">{{ $data_mobil }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div id="informasi_tarif" class="mt-4">
                            <p id="lama_sewa"></p>
                            <p id="total_tarif"></p>
                            <input type="hidden" name="total_biaya" id="total_biaya">
                        </div>
                        <button type="submit" class="btn btn-success mt-3">Bayar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endsection