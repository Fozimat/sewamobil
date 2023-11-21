@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    Edit Mobil
                </div>
                <div class="card-body">
                    <form id="form" action="{{ route('mobil.update', $mobil->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="merk">Merk</label>
                            <input type="text" class="form-control" id="merk" name="merk" required
                                value="{{ $mobil->merk }}">
                        </div>
                        <div class="form-group">
                            <label for="model">Model</label>
                            <input type="text" class="form-control" id="model" name="model" required
                                value="{{ $mobil->model }}">
                        </div>
                        <div class="form-group">
                            <label for="no_plat">No Plat</label>
                            <input type="text" class="form-control" id="no_plat" name="no_plat" required
                                value="{{ $mobil->no_plat }}">
                        </div>
                        <div class="form-group">
                            <label for="tarif_sewa">Tarif Sewa</label>
                            <input type="number" class="form-control" id="tarif_sewa" name="tarif_sewa" required
                                value="{{ $mobil->tarif_sewa }}">
                        </div>
                        <button type="submit" class="btn btn-success mt-3">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endsection