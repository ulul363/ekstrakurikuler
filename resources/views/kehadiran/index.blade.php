@extends('layouts.master')

@section('content')
    <div class="pcoded-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Pengajuan Kehadiran</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i
                                        class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="{{ route('kehadiran.index') }}">Kehadiran</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header">Pengajuan Kehadiran</div>
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        @can('kehadiran.create')
                            <a href="{{ route('kehadiran.create') }}" class="btn btn-primary mb-3">
                                <i class="fa fa-plus"></i> Tambah Kehadiran
                            </a>
                        @endcan

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Kegiatan</th>
                                    <th>Tanggal</th>
                                    <th>Berkas</th>
                                    <th>Diverifikasi oleh</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($kehadiran as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->nama_kegiatan }}</td>
                                        <td>{{ $item->tanggal }}</td>
                                        <td>
                                            <a href="{{ asset('storage/' . $item->berkas) }}" target="_blank">Lihat
                                                Berkas</a>
                                        </td>
                                        <td>
                                            @if ($item->pembina && $item->pembina->nama)
                                                {{ $item->pembina->nama }}
                                            @else
                                                Belum diverifikasi
                                            @endif
                                        </td>
                                        <td>
                                            @if ($item->status == 'pending')
                                                <span class="badge badge-warning">Pending</span>
                                            @elseif ($item->status == 'disetujui')
                                                <span class="badge badge-success">Disetujui</span>
                                            @elseif ($item->status == 'ditolak')
                                                <span class="badge badge-danger">Ditolak</span>
                                            @else
                                                <span class="badge badge-secondary">{{ $item->status }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if (auth()->user()->hasRole('Pembina'))
                                                @if ($item->status == 'pending')
                                                    @can('kehadiran.verifikasi')
                                                        <form action="{{ route('kehadiran.verifikasi', $item->id_kehadiran) }}"
                                                            method="POST" style="display:inline;">

                                                            @csrf
                                                            @method('POST')
                                                            <input type="hidden" name="status" value="disetujui">
                                                            <button type="submit"
                                                                class="btn btn-success btn-sm">Disetujui</button>
                                                        </form>
                                                    @endcan
                                                    @can('kehadiran.verifikasi')
                                                        <form action="{{ route('kehadiran.verifikasi', $item->id_kehadiran) }}"
                                                            method="POST" style="display:inline;">
                                                            @csrf
                                                            @method('POST')
                                                            <input type="hidden" name="status" value="ditolak">
                                                            <button type="submit"
                                                                class="btn btn-danger btn-sm">Ditolak</button>
                                                        </form>
                                                    @endcan
                                                @else
                                                    @can('kehadiran.show')
                                                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                                            data-target="#showModal{{ $item->id_kehadiran }}">
                                                            <i class="fa fa-eye"></i>
                                                        </button>
                                                    @endcan
                                                @endif
                                            @elseif (auth()->user()->hasRole('Ketua'))
                                                @if ($item->status == 'pending')
                                                    <form action="{{ route('kehadiran.destroy', $item->id_kehadiran) }}"
                                                        method="POST" style="display:inline;">

                                                        @can('kehadiran.edit')
                                                            <a href="{{ route('kehadiran.edit', $item->id_kehadiran) }}"
                                                                class="btn btn-warning btn-sm">
                                                                <i class="fa fa-edit"></i>
                                                            </a>
                                                        @endcan

                                                        @can('kehadiran.destroy')
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="button" class="btn btn-danger btn-sm"
                                                                onclick="confirmDelete('delete-kehadiran-{{ $item->id_kehadiran }}')">
                                                                <i class="fa fa-trash"></i>
                                                            </button>
                                                        @endcan
                                                    </form>
                                                    @can('kehadiran.show')
                                                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                                            data-target="#showModal{{ $item->id_kehadiran }}">
                                                            <i class="fa fa-eye"></i>
                                                        </button>
                                                    @endcan
                                                @else
                                                    @can('kehadiran.show')
                                                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                                            data-target="#showModal{{ $item->kehadiran }}">
                                                            <i class="fa fa-eye"></i>
                                                        </button>
                                                    @endcan
                                                @endif
                                            @endif
                                        </td>
                                    </tr>
                                    <!-- Modal -->
                                    <div class="modal fade" id="showModal{{ $item->id_kehadiran }}" tabindex="-1"
                                        role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Detail Kehadiran
                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p><strong>Ketua:</strong> {{ $item->ketua->nama }}</p>
                                                    <p><strong>Tanggal:</strong> {{ $item->tanggal }}</p>
                                                    <p><strong>Berkas:</strong>
                                                        <a href="{{ asset('storage/' . $item->berkas) }}"
                                                            target="_blank">{{ $item->berkas }}</a>
                                                    </p>
                                                    <p><strong>Diverifikasi oleh:</strong>
                                                        @if ($item->pembina && $item->pembina->nama)
                                                            {{ $item->pembina->nama }}
                                                        @else
                                                            Belum diverifikasi
                                                        @endif
                                                    </p>
                                                    <p><strong>Status:</strong>
                                                        @if ($item->status == 'pending')
                                                            <span class="badge badge-warning">Pending</span>
                                                        @elseif ($item->status == 'disetujui')
                                                            <span class="badge badge-success">Disetujui</span>
                                                        @elseif ($item->status == 'ditolak')
                                                            <span class="badge badge-danger">Ditolak</span>
                                                        @endif
                                                    </p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
