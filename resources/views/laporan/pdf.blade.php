<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Program Kegiatan</title>
    <style>
        /* Tambahkan gaya CSS untuk PDF Anda di sini */
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        th {
            background-color: #f4f4f4;
        }
    </style>
</head>
<body>
    <h1>Laporan Program Kegiatan</h1>
    <p>Ekstrakurikuler: {{ $programKegiatan->first()->ekstrakurikuler->nama ?? 'Semua' }}</p>
    <p>Tahun Ajaran: {{ $programKegiatan->first()->tahun_ajaran ?? 'Semua' }}</p>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Ekstrakurikuler</th>
                <th>Ketua</th>
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
                    <td>{{ $item->ekstrakurikuler->nama }}</td>
                    <td>{{ $item->ketua->nama }}</td>
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
</body>
</html>
