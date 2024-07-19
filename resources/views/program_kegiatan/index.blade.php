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
                                            @endif
                                        </td>
                                        <td>
                                            <form id="delete-program-{{ $item->id_program_kegiatan }}"
                                                action="{{ route('program_kegiatan.destroy', $item->id_program_kegiatan) }}"
                                                method="POST">
                                                @if ($item->status == 'pending')
                                                    @can('program_kegiatan.edit')
                                                        <a href="{{ route('program_kegiatan.edit', $item->id_program_kegiatan) }}"
                                                            class="btn btn-warning btn-sm">
                                                            <i class="fa fa-pencil-alt"></i>
                                                        </a>
                                                    @endcan

                                                    @can('program_kegiatan.destroy')
                                                        <button type="button" class="btn btn-danger btn-sm"
                                                            onclick="confirmDelete({{ $item->id_program_kegiatan }})">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    @endcan
                                                @endif
                                                <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                                    data-target="#showModal{{ $item->id_program_kegiatan }}">
                                                    <i class="fa fa-eye"></i>
                                                </button>
                                            </form>
                                            <!-- Modal -->
                                            <div class="modal fade" id="showModal{{ $item->id_program_kegiatan }}"
                                                tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                                aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Detail Program
                                                                Kegiatan</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p><strong>Nama Program:</strong> {{ $item->nama_program }}</p>
                                                            <p><strong>Tahun Ajaran:</strong> {{ $item->tahun_ajaran }}</p>
                                                            <p><strong>Deskripsi:</strong> {{ $item->deskripsi }}</p>
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

@section('scripts')
    <script>
        function showDetail(id) {
            $.ajax({
                url: "{{ url('program_kegiatan') }}/" + id,
                method: 'GET',
                success: function(data) {
                    $('#modalNamaProgram').text(data.nama_program);
                    $('#modalTahunAjaran').text(data.tahun_ajaran);
                    $('#modalDeskripsi').text(data.deskripsi);
                    $('#modalVerifikasiOleh').text(data.verifikasi ? data.verifikasi.pembina.nama : '-');
                    $('#modalStatus').text(data.status.charAt(0).toUpperCase() + data.status.slice(1));

                    $('#programKegiatanModal').modal('show');
                }
            });
        }

        function confirmDelete(id) {
            if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
                document.getElementById(`delete-program-${id}`).submit();
            }
        }
    </script>
@endsection
