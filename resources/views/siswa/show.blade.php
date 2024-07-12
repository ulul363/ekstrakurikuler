<!-- resources/views/siswa/show.blade.php -->
@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Detail Siswa</div>

                <div class="card-body">
                    <div class="form-group">
                        <strong>NIS:</strong>
                        {{ $siswa->nis }}
                    </div>

                    <div class="form-group">
                        <strong>Nama:</strong>
                        {{ $siswa->nama }}
                    </div>

                    <div class="form-group">
                        <strong>Alamat:</strong>
                        {{ $siswa->alamat }}
                    </div>

                    <div class="form-group">
                        <strong>Jenis Kelamin:</strong>
                        {{ $siswa->jenis_kelamin }}
                    </div>

                    <div class="form-group">
                        <strong>Email:</strong>
                        {{ $siswa->email }}
                    </div>

                    <div class="form-group">
                        <strong>No HP:</strong>
                        {{ $siswa->no_hp }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
