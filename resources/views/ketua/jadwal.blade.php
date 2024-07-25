@extends('layouts.master')

@section('content')
    <div class="pcoded-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Jadwal Pembina</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i
                                        class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="{{ route('jadwalpembina.index') }}">Jadwal Pembina</a>
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
                    <a href="{{ route('jadwal.pembina.create') }}" class="btn btn-primary mb-3">
                        <i class="fa fa-plus"></i> Tambah Pertemuan
                    </a>

                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

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
                                @foreach ($buatjadwal as $jadwal)
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
                                            <button class="btn btn-primary btn-sm"
                                                onclick="submitMeetingRequest({{ $jadwal->id_jadwal_pembina }})">
                                                <i class="fa fa-calendar-plus-o"></i> Ajukan Pertemuan
                                            </button>
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

    <!-- SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

    <script>
        function submitMeetingRequest(id) {
            Swal.fire({
                title: 'Ajukan Pertemuan?',
                text: "Apakah Anda ingin mengajukan pertemuan untuk jadwal ini?",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Ajukan!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Redirect or process the meeting request
                    window.location.href = '/jadwal/pembina/ajukan-pertemuan/' + id;
                }
            });
        }
    </script>
@endsection
