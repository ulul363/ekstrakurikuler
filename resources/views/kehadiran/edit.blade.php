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
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i
                                        class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="{{ route('kehadiran.index') }}">Kehadiran</a></li>
                            <li class="breadcrumb-item"><a
                                    href="{{ route('kehadiran.edit', $kehadiran->id_kehadiran) }}">Edit Kehadiran</a></li>
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
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form action="{{ route('kehadiran.update', $kehadiran->id_kehadiran) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="ekstrakurikuler_id">Ekstrakurikuler</label>
                                <select name="ekstrakurikuler_id" id="ekstrakurikuler_id" class="form-control">
                                    <option value="">Pilih Ekstrakurikuler</option>
                                    @foreach ($ekstrakurikulers as $ekstrakurikuler)
                                        <option value="{{ $ekstrakurikuler->id_ekstrakurikuler }}"
                                            {{ $ekstrakurikuler->id_ekstrakurikuler == $kehadiran->ekstrakurikuler_id ? 'selected' : '' }}>
                                            {{ $ekstrakurikuler->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="ketua_id">Ketua</label>
                                <select name="ketua_id" id="ketua_id" class="form-control">
                                    <option value="">Pilih Ketua</option>
                                    @foreach ($ketuas as $ketua)
                                        <option value="{{ $ketua->id_ketua }}"
                                            {{ $ketua->id_ketua == $kehadiran->ketua_id ? 'selected' : '' }}>
                                            {{ $ketua->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="tanggal">Tanggal</label>
                                <input type="date" name="tanggal" id="tanggal" class="form-control"
                                    value="{{ old('tanggal', $kehadiran->tanggal) }}">
                            </div>
                            <div class="form-group">
                                <label for="berkas">Berkas</label>
                                <input type="file" name="berkas" id="berkas" class="form-control">
                                @if ($kehadiran->berkas)
                                    <a href="{{ asset('storage/' . $kehadiran->berkas) }}"
                                        target="_blank">{{ $kehadiran->berkas }}</a>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="aktif" {{ $kehadiran->status == 'aktif' ? 'selected' : '' }}>Aktif
                                    </option>
                                    <option value="tidak aktif"
                                        {{ $kehadiran->status == 'tidak aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
