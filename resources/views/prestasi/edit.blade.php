@extends('layouts.master')
@section('content')
    <div class="pcoded-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Edit Prestasi</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i
                                        class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="{{ route('prestasi.index') }}">Prestasi</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('prestasi.edit', $prestasi->id_prestasi) }}">Edit
                                    Prestasi</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header">Edit Prestasi</div>
                    <div class="card-body">
                        <form action="{{ route('prestasi.update', $prestasi->id_prestasi) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="prestasi">Prestasi</label>
                                <input type="text" name="prestasi" id="prestasi"
                                    class="form-control @error('prestasi') is-invalid @enderror"
                                    value="{{ old('prestasi', $prestasi->prestasi) }}" required>
                                @error('prestasi')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>

                            <div id="nama_siswa_wrapper">
                                @foreach (json_decode($prestasi->nama_siswa) as $siswa)
                                    <div class="form-group">
                                        <label for="nama_siswa">Nama Siswa</label>
                                        <input type="text" name="nama_siswa[]"
                                            class="form-control @error('nama_siswa.*') is-invalid @enderror"
                                            value="{{ old('nama_siswa[]', $siswa) }}" required>
                                        @error('nama_siswa.*')
                                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                        @enderror
                                    </div>
                                @endforeach
                            </div>
                            <button type="button" id="add_nama_siswa" class="btn btn-secondary mb-3">Tambah Nama
                                Siswa</button>

                            <div class="form-group">
                                <label for="tahun_ajaran">Tahun Ajaran</label>
                                <input type="number" name="tahun_ajaran" id="tahun_ajaran"
                                    class="form-control @error('tahun_ajaran') is-invalid @enderror"
                                    value="{{ old('tahun_ajaran', $prestasi->tahun_ajaran) }}" required max="9999">
                                @error('tahun_ajaran')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="berkas">Berkas</label>
                                <input type="file" name="berkas" id="berkas"
                                    class="form-control @error('berkas') is-invalid @enderror">
                                <a href="{{ asset('storage/' . $prestasi->berkas) }}" target="_blank">Lihat Berkas Saat
                                    Ini</a>
                                @error('berkas')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.getElementById('add_nama_siswa').addEventListener('click', function() {
            var wrapper = document.getElementById('nama_siswa_wrapper');
            var newInput = document.createElement('div');
            newInput.className = 'form-group';
            newInput.innerHTML =
                '<label for="nama_siswa">Nama Siswa</label><input type="text" name="nama_siswa[]" class="form-control" required>';
            wrapper.appendChild(newInput);
        });
    </script>
@endsection
