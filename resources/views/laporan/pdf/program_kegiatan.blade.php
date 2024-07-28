<!DOCTYPE html>
<html>
<head>
    <title>Laporan Program Kegiatan</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Laporan Program Kegiatan</h1>
    <p>Status: {{ request()->input('status') ? request()->input('status') : 'Semua' }}</p>
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
            @foreach ($data as $item)
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
                            <span>Pending</span>
                        @elseif ($item->status == 'disetujui')
                            <span>Disetujui</span>
                        @elseif ($item->status == 'ditolak')
                            <span>Ditolak</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
