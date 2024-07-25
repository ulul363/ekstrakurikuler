@extends('layouts.master')
@section('content')
    <div class="pcoded-content">

        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Jadwal Pembina</span></h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i
                                        class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="{{ route('jadwal.pembina.index') }}">Jadwal Pembina</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header">Jadwal Pembina</div>

                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <a href="{{ route('jadwal.pembina.create') }}" class="btn btn-primary mb-3">
                            <i class="fa fa-plus"></i> Tambah Jadwal Pembina
                        </a>

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Hari</th>
                                    <th>Waktu Mulai</th>
                                    <th>Waktu Selesai</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($jadwalPembina as $jadwal)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $jadwal->hari }}</td>
                                        <td>{{ \Carbon\Carbon::parse($jadwal->waktu_mulai)->format('H:i') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($jadwal->waktu_selesai)->format('H:i') }}</td>
                                        <td>
                                            @if ($jadwal->status == 'tersedia')
                                                <span class="badge badge-success">Tersedia</span>
                                            @elseif($jadwal->status == 'tidak tersedia')
                                                <span class="badge badge-danger">Tidak Tersedia</span>
                                            @endif
                                        </td>

                                        <td>
                                            <form id="delete-jadwal-{{ $jadwal->id_jadwal_pembina }}"
                                                action="{{ route('jadwal.pembina.destroy', $jadwal->id_jadwal_pembina) }}"
                                                method="POST">
                                                
                                                    <a href="{{ route('jadwal.pembina.edit', $jadwal->id_jadwal_pembina) }}"
                                                        class="btn btn-warning btn-sm">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                
                                                
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-danger btn-sm"
                                                        onclick="confirmDelete('delete-jadwal-{{ $jadwal->id_jadwal_pembina }}')">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                
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
        <!-- [ Main Content ] end -->
    </div>
@endsection
