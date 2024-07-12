<!-- resources/views/pembina/show.blade.php -->
@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Detail Pembina</div>

                <div class="card-body">
                    <div class="form-group">
                        <strong>NIP Pembina:</strong>
                        {{ $pembina->nip_pembina }}
                    </div>

                    <div class="form-group">
                        <strong>Nama:</strong>
                        {{ $pembina->nama }}
                    </div>

                    <div class="form-group">
                        <strong>Email:</strong>
                        {{ $pembina->email }}
                    </div>

                    <div class="form-group">
                        <strong>No HP:</strong>
                        {{ $pembina->no_hp }}
                    </div>

                    <div class="form-group">
                        <strong>Alamat:</strong>
                        {{ $pembina->alamat }}
                    </div>

                    <div class="form-group">
                        <strong>Jenis Kelamin:</strong>
                        {{ $pembina->jenis_kelamin }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
