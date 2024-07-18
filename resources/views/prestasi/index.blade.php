@extends('layouts.master')
@section('content')
    <div class="pcoded-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Daftar Prestasi</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i
                                        class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="{{ route('prestasi.index') }}">Prestasi</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header">Daftar Prestasi</div>
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <a href="{{ route('prestasi.create') }}" class="btn btn-primary mb-3">
                            <i class="fa fa-plus"></i> Tambah Prestasi
                        </a>

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Prestasi</th>
                                    <th>Tanggal</th>
                                    <th>Nama Siswa</th>
                                    <th>Tahun Ajaran</th>
                                    <th>Berkas</th>
                                    <th>Verifikasi Oleh</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($prestasi as $item)
                                    <tr>
                                        <td>{{ $item->prestasi }}</td>
                                        <td>{{ $item->created_at->format('d-m-Y') }}</td>
                                        <td>
                                            @foreach (json_decode($item->nama_siswa) as $siswa)
                                                <div>{{ $siswa }}</div>
                                            @endforeach
                                        </td>
                                        <td>{{ $item->tahun_ajaran }}</td>
                                        <td><a href="{{ asset('storage/' . $item->berkas) }}" target="_blank">Lihat
                                                Berkas</a></td>
                                        <td>{{ $item->verifikasi_id ? $item->verifikasi->name : 'Belum Diverifikasi' }}</td>
                                        <td>{{ ucfirst($item->status) }}</td>
                                        <td>
                                            <a href="{{ route('prestasi.edit', $item->id_prestasi) }}"
                                                class="btn btn-primary btn-sm">Edit</a>
                                            <form action="{{ route('prestasi.destroy', $item->id_prestasi) }}"
                                                method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
