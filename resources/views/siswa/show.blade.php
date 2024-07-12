@extends('layouts.master')
@section('content')

<div class="pcoded-content">

    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Selamat Datang <span>{{ Auth::user()->name }}</span></h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html"><i class="feather icon-home"></i></a></li>
                        <li class="breadcrumb-item"><a href="#!">Dashboard Analytics</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-12">
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
    <!-- [ Main Content ] end -->
</div>
@endsection




