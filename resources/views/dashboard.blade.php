@extends('layouts.master')
@section('content')

<div class="pcoded-content">
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.0/css/dataTables.bootstrap5.css"> --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.0/css/dataTables.dataTables.css" />

    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Selamat Datang, <span>{{ Auth::user()->name }} !</span></h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html"><i class="feather icon-home"></i></a></li>
                        <li class="breadcrumb-item"><a href="#!">Dashboard</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body table-border-style">
                    <div class="card-header">
                        <h4 class="card-title">Tabel Program Kegiatan</h4>
                    </div>
                    <div>
                        <table id="tabelEkstrakurikuler" class="display" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Deskripsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($ekstrakurikulers as $ekstrakurikuler)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $ekstrakurikuler->nama }}</td> 
                                        <td></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body table-border-style">
                    <div class="card-header">
                        <h4 class="card-title">Tabel Prestasi</h4>
                    </div>
                    <div>
                        <table id="tabelPrestasi" class="display" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Prestasi</th>
                                    <th>Nama Siswa</th>
                                    <th>Tahun Ajaran</th>
                                    <th>Berkas</th>
                                    <th>Diverifikasi Oleh</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($prestasi as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->prestasi }}</td>
                                        <td>
                                            @php
                                                $index = 1;
                                            @endphp
                                            @foreach (json_decode($item->nama_siswa) as $siswa)
                                                <div>{{ $index }}. {{ $siswa }}</div>
                                                @php
                                                    $index++;
                                                @endphp
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
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body table-border-style">
                    <div class="card-header">
                        <h4 class="card-title">Tabel Kehadiran</h4>
                    </div>
                    <div>
                        <table id="tabelKehadiran" class="display" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>Berkas</th>
                                    <th>Diverifikasi oleh</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($kehadiran as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
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
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body table-border-style">
                    <div class="card-header">
                        <h4 class="card-title">Tabel Program Kegiatan</h4>
                    </div>
                    <div>
                        <table id="tabelProgramKegiatan" class="display" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Program</th>
                                    <th>Tahun Ajaran</th>
                                    <th>Deskripsi</th>
                                    <th>Diverifikasi oleh</th>
                                    <th>Status</th>
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
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- [ Main Content ] end -->
</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/2.1.0/js/dataTables.bootstrap5.js"></script> --}}
<script src="https://cdn.datatables.net/2.1.0/js/dataTables.js"></script>
<script>
    new DataTable('#tabelEkstrakurikuler');
</script>
<script>
    new DataTable('#tabelPrestasi');
</script>
<script>
    new DataTable('#tabelKehadiran');
</script>
<script>
    new DataTable('#tabelProgramKegiatan');
</script>
@endsection




