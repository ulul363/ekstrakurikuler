@extends('layouts.master')
@section('content')
    <div class="pcoded-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Pengajuan Prestasi</h5>
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
                    <div class="card-header">Pengajuan Prestasi</div>
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        @can('prestasi.create')
                            <a href="{{ route('prestasi.create') }}" class="btn btn-primary mb-3">
                                <i class="fa fa-plus"></i> Tambah Prestasi
                            </a>
                        @endcan

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Prestasi</th>
                                    <th>Nama Siswa</th>
                                    <th>Kelas</th>
                                    <th>Tahun Ajaran</th>
                                    <th>Berkas</th>
                                    <th>Diverifikasi Oleh</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($prestasi as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->prestasi }}</td>
                                        <td>
                                            @php
                                                $siswaList = json_decode($item->nama_siswa);
                                            @endphp
                                            @foreach ($siswaList as $index => $siswa)
                                                @if(count($siswaList) > 1)
                                                    <div>{{ $loop->iteration }}. {{ $siswa }}</div>
                                                @else
                                                    <div>{{ $siswa }}</div>
                                                @endif
                                            @endforeach
                                        </td>
                                        <td>
                                            @php
                                                $kelasList = json_decode($item->kelas);
                                            @endphp
                                            @foreach ($kelasList as $index => $kls)
                                                @if(count($kelasList) > 1)
                                                    <div>{{ $loop->iteration }}. {{ $kls }}</div>
                                                @else
                                                    <div>{{ $kls }}</div>
                                                @endif
                                            @endforeach
                                        </td>
                                        <td>{{ $item->tahun_ajaran }}</td>
                                        <td><a href="{{ asset('storage/' . $item->berkas) }}" target="_blank">Lihat
                                                Berkas</a></td>
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
                                                    @can('prestasi.verifikasi')
                                                        <form action="{{ route('prestasi.verifikasi', $item->id_prestasi) }}"
                                                            method="POST" style="display:inline;">

                                                            @csrf
                                                            @method('POST')
                                                            <input type="hidden" name="status" value="disetujui">
                                                            <button type="submit"
                                                                class="btn btn-success btn-sm">Disetujui</button>
                                                        </form>
                                                    @endcan
                                                    @can('prestasi.verifikasi')
                                                        <form action="{{ route('prestasi.verifikasi', $item->id_prestasi) }}"
                                                            method="POST" style="display:inline;">
                                                            @csrf
                                                            @method('POST')
                                                            <input type="hidden" name="status" value="ditolak">
                                                            <button type="submit"
                                                                class="btn btn-danger btn-sm">Ditolak</button>
                                                        </form>
                                                    @endcan
                                                @else
                                                    @can('prestasi.show')
                                                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                                            data-target="#showModal{{ $item->id_prestasi }}">
                                                            <i class="fa fa-eye"></i>
                                                        </button>
                                                    @endcan
                                                @endif
                                            @elseif (auth()->user()->hasRole('Ketua'))
                                                @if ($item->status == 'pending')
                                                    <form action="{{ route('prestasi.destroy', $item->id_prestasi) }}"
                                                        method="POST" style="display:inline;">

                                                        @can('prestasi.edit')
                                                            <a href="{{ route('prestasi.edit', $item->id_prestasi) }}"
                                                                class="btn btn-warning btn-sm">
                                                                <i class="fa fa-edit"></i>
                                                            </a>
                                                        @endcan

                                                        @can('prestasi.destroy')
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="button" class="btn btn-danger btn-sm"
                                                                onclick="confirmDelete('delete-prestasi-{{ $item->id_prestasi }}')">
                                                                <i class="fa fa-trash"></i>
                                                            </button>
                                                        @endcan
                                                    </form>
                                                    @can('prestasi.show')
                                                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                                            data-target="#showModal{{ $item->id_prestasi }}">
                                                            <i class="fa fa-eye"></i>
                                                        </button>
                                                    @endcan
                                                @else
                                                    @can('prestasi.show')
                                                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                                            data-target="#showModal{{ $item->id_prestasi }}">
                                                            <i class="fa fa-eye"></i>
                                                        </button>
                                                    @endcan
                                                @endif
                                            @endif
                                        </td>
                                    </tr>
                                    <!-- Modal -->
                                    <div class="modal fade" id="showModal{{ $item->id_prestasi }}" tabindex="-1"
                                        role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Detail Prestasi</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p><strong>Ketua:</strong> {{ $item->ketua->nama }}</p>
                                                    <p><strong>Prestasi:</strong> {{ $item->prestasi }}</p>
                                                    <p><strong>Nama Siswa:</strong>
                                                        @php
                                                            $index = 1;
                                                        @endphp
                                                        @foreach (json_decode($item->nama_siswa) as $siswa)
                                                            <div>{{ $index }}. {{ $siswa }}</div>
                                                            @php
                                                                $index++;
                                                            @endphp
                                                        @endforeach
                                                    </p>
                                                    <p><strong>Tahun Ajaran:</strong> {{ $item->tahun_ajaran }}</p>
                                                    <p>
                                                        <strong>Ekstrakurikuler:</strong>
                                                        {{ $item->ekstrakurikuler->nama }}
                                                    </p>
                                                    <p><strong>Diverifikasi oleh:</strong>
                                                        @if ($item->pembina && $item->pembina->nama)
                                                            {{ $item->pembina->nama }}
                                                        @else
                                                            Belum diverifikasi
                                                        @endif
                                                    </p>
                                                    <p><strong>Berkas:</strong>
                                                        @if ($item->berkas)
                                                            <a href="{{ asset('storage/' . $item->berkas) }}"
                                                                target="_blank">Lihat Berkas</a>
                                                        @else
                                                            Tidak ada berkas
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
