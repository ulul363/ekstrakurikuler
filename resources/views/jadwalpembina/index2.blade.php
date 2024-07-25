@extends('layouts.master')

@section('content')
    <div class="pcoded-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Pengajuan Pertemuan</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i
                                        class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="{{ route('jadwal_pembina.index2') }}">Jadwal Pembina</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header">Pengajuan Pertemuan</div>
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        @can('jadwal_pembina.create2')
                            <a href="{{ route('jadwal_pembina.create2') }}" class="btn btn-primary mb-3">
                                <i class="fa fa-plus"></i> Tambah Jadwal Pembina
                            </a>
                        @endcan

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
                                @foreach ($jadwalPembina as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->hari }}</td>
                                        <td>{{ $item->waktu_mulai }}</td>
                                        <td>{{ $item->waktu_selesai }}</td>
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
                                            <!-- Aksi untuk Pembina dan Ketua -->
                                            @if (auth()->user()->hasRole('Pembina') || auth()->user()->hasRole('Ketua'))
                                                @if ($item->status == 'pending')
                                                    @can('jadwal_pembina.verifikasi')
                                                        <form action="{{ route('jadwal_pembina.verifikasi', $item->id_jadwal_pembina) }}"
                                                            method="POST" style="display:inline;">
                                                            @csrf
                                                            @method('POST')
                                                            <input type="hidden" name="status" value="disetujui">
                                                            <button type="submit"
                                                                class="btn btn-success btn-sm">Disetujui</button>
                                                        </form>
                                                        <form action="{{ route('jadwal_pembina.verifikasi', $item->id_jadwal_pembina) }}"
                                                            method="POST" style="display:inline;">
                                                            @csrf
                                                            @method('POST')
                                                            <input type="hidden" name="status" value="ditolak">
                                                            <button type="submit"
                                                                class="btn btn-danger btn-sm">Ditolak</button>
                                                        </form>
                                                    @endcan
                                                @else
                                                    @can('jadwal_pembina.show')
                                                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                                            data-target="#showModal{{ $item->id_jadwal_pembina }}">
                                                            <i class="fa fa-eye"></i>
                                                        </button>
                                                    @endcan
                                                @endif
                                            @endif
                                        </td>
                                    </tr>
                                    <!-- Modal -->
                                    <div class="modal fade" id="showModal{{ $item->id_jadwal_pembina }}" tabindex="-1"
                                        role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Detail Jadwal Pembina
                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p><strong>Pembina:</strong> {{ $item->jadwalpembina->nama }}</p>
                                                    <p><strong>Hari:</strong> {{ $item->hari }}</p>
                                                    <p><strong>Waktu Mulai:</strong> {{ $item->waktu_mulai }}</p>
                                                    <p><strong>Waktu Selesai:</strong> {{ $item->waktu_selesai }}</p>
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
