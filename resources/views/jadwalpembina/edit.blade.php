@extends('layouts.master')

@section('content')
<div class="pcoded-content">
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Edit Jadwal Pembina</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i
                                    class="feather icon-home"></i></a></li>
                        <li class="breadcrumb-item"><a href="{{ route('jadwal.pembina.index') }}">Jadwal Pembina</a>
                        </li>
                        <li class="breadcrumb-item"><a href="#">Edit</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">Edit Jadwal pembina</div>

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

                    <form action="{{ route('jadwal.pembina.update', $jadwal->id_jadwal_pembina) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="hari">Hari</label>
                            <select name="hari" id="hari" class="form-control">
                                <option value="Senin" {{ $jadwal->hari == 'Senin' ? 'selected' : '' }}>Senin</option>
                                <option value="Selasa" {{ $jadwal->hari == 'Selasa' ? 'selected' : '' }}>Selasa
                                </option>
                                <option value="Rabu" {{ $jadwal->hari == 'Rabu' ? 'selected' : '' }}>Rabu</option>
                                <option value="Kamis" {{ $jadwal->hari == 'Kamis' ? 'selected' : '' }}>Kamis</option>
                                <option value="Jumat" {{ $jadwal->hari == 'Jumat' ? 'selected' : '' }}>Jumat</option>
                                <option value="Sabtu" {{ $jadwal->hari == 'Sabtu' ? 'selected' : '' }}>Sabtu</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="waktu_mulai">Waktu Mulai</label>
                            <input type="time" name="waktu_mulai" id="waktu_mulai" class="form-control"
                                value="{{ $jadwal->waktu_mulai }}" required>
                        </div>
                        <div class="form-group">
                            <label for="waktu_selesai">Waktu Selesai</label>
                            <input type="time" name="waktu_selesai" id="waktu_selesai" class="form-control"
                                value="{{ $jadwal->waktu_selesai }}" required>
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select name="status" id="status" class="form-control">
                                <option value="tersedia" {{ $jadwal->status == 'tersedia' ? 'selected' : '' }}>
                                    Tersedia</option>
                                <option value="tidak tersedia" {{ $jadwal->status == 'tidak tersedia' ? 'selected' : '' }}>
                                    Tidak Tersedia</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
