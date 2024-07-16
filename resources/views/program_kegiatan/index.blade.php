@extends('layouts.master')
@section('content')
    <div class="pcoded-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Pengajuan Program Kegiatan</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i
                                        class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="{{ route('program_kegiatan.index') }}">Program Kegiatan</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header">Pengajuan Program Kegiatan</div>
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <a href="{{ route('program_kegiatan.create') }}" class="btn btn-primary mb-3">
                            <i class="fa fa-plus"></i> Ajukan Program Kegiatan
                        </a>

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Program</th>
                                    <th>Tahun Ajaran</th>
                                    <th>Deskripsi</th>
                                    <th>Diverifikasi oleh</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($programKegiatan as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->nama_program }}</td>
                                        <td>{{ $item->tahun_ajaran }}</td>
                                        <td>{{ $item->deskripsi }}</td>
                                        <td>
                                            @if ($item->verifikasi_id)
                                                {{ $item->verifikasi->pembina->nama }}
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td>
                                            @if ($item->status == 'pending')
                                                <span class="badge badge-warning">Pending</span>
                                            @elseif ($item->status == 'disetujui')
                                                <span class="badge badge-success">Disetujui</span>
                                            @elseif ($item->status == 'ditolak')
                                                <span class="badge badge-danger">Ditolak</span>
                                            @endif
                                        </td>
                                        <td>
                                            <form id="delete-program-{{ $item->id_program_kegiatan }}"
                                                action="{{ route('program_kegiatan.destroy', $item->id_program_kegiatan) }}"
                                                method="POST">
                                                @can('program_kegiatan.edit')
                                                    <a href="{{ route('program_kegiatan.edit', $item->id_program_kegiatan) }}"
                                                        class="btn btn-warning btn-sm">
                                                        <i class="fa fa-pencil-alt"></i> Edit
                                                    </a>
                                                @endcan
                                                @csrf
                                                @method('DELETE')
                                                @can('program_kegiatan.destroy')
                                                    <button type="button" class="btn btn-danger btn-sm"
                                                        onclick="confirmDelete({{ $item->id_program_kegiatan }})">
                                                        <i class="fa fa-trash"></i> Delete
                                                    </button>
                                                @endcan
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

    <script>
        function confirmDelete(id) {
            if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
                document.getElementById(`delete-program-${id}`).submit();
            }
        }
    </script>
@endsection
