@extends('layouts.master')

@section('content')
    <div class="pcoded-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Tambah Jadwal Pembina</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="{{ route('jadwal_pembina.index2') }}">Jadwal Pembina</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('jadwal_pembina.create2') }}">Tambah Jadwal Pembina</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header">Tambah Jadwal Pembina</div>
                    <div class="card-body">
                        <form action="{{ route('jadwal_pembina.store2') }}" method="POST">
                            @csrf

                            <div class="form-group">
                                <label for="pembina_id">Pembina</label>
                                <select name="pembina_id" id="pembina_id" class="form-control @error('pembina_id') is-invalid @enderror">
                                    @foreach($pembina as $p)
                                        <option value="{{ $p->id_pembina }}">{{ $p->nama }}</option>
                                    @endforeach
                                </select>
                                @error('pembina_id')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="hari">Hari</label>
                                <input type="text" name="hari" id="hari" class="form-control @error('hari') is-invalid @enderror" required>
                                @error('hari')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="waktu_mulai">Waktu Mulai</label>
                                <input type="time" name="waktu_mulai" id="waktu_mulai" class="form-control @error('waktu_mulai') is-invalid @enderror" required>
                                @error('waktu_mulai')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="waktu_selesai">Waktu Selesai</label>
                                <input type="time" name="waktu_selesai" id="waktu_selesai" class="form-control @error('waktu_selesai') is-invalid @enderror" required>
                                @error('waktu_selesai')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="status">Status</label>
                                <select name="status" id="status" class="form-control @error('status') is-invalid @enderror">
                                    <option value="pending">Pending</option>
                                    <option value="disetujui">Disetujui</option>
                                    <option value="ditolak">Ditolak</option>
                                </select>
                                @error('status')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary">Tambah</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
