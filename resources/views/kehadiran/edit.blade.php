@extends('layouts.master')
@section('content')
    <div class="pcoded-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Edit Kehadiran</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="{{ route('kehadiran.index') }}">Kehadiran</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('kehadiran.edit', $kehadiran->id_kehadiran) }}">Edit Kehadiran</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header">Edit Kehadiran</div>
                    <div class="card-body">
                        <form action="{{ route('kehadiran.update', $kehadiran->id_kehadiran) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="tanggal">Tanggal</label>
                                <input type="date" name="tanggal" id="tanggal" class="form-control @error('tanggal') is-invalid @enderror"
                                    value="{{ old('tanggal', $kehadiran->tanggal) }}" required>
                                @error('tanggal')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="berkas">Berkas</label>
                                <input type="file" name="berkas" id="berkas" class="form-control @error('berkas') is-invalid @enderror">
                                @error('berkas')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                                @if ($kehadiran->berkas)
                                    <a href="{{ asset('storage/' . $kehadiran->berkas) }}" target="_blank">Lihat Berkas</a>
                                @endif
                            </div>

                            <button type="submit" class="btn btn-primary">Perbarui</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
