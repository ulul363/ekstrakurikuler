<!DOCTYPE html>
<html>

<head>
    <title>Laporan Prestasi</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <h1>Laporan Prestasi</h1>
    <p>Status: {{ request()->input('status') ? request()->input('status') : 'Semua' }}</p>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Ekstrakurikuler</th>
                <th>Ketua</th>
                <th>Nama Prestasi</th>
                <th>Tahun Ajaran</th>
                <th>Deskripsi</th>
                <th>Diverifikasi oleh</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->ekstrakurikuler->nama }}</td>
                    <td>{{ $item->ketua->nama }}</td>
                    <td>{{ $item->nama_prestasi }}</td>
                    <td>{{ $item->tahun_ajaran }}</td>
                    <td>{{ $item->deskripsi }}</td>
                    <td>
                        @if ($item->pembina && $item->pembina->nama)
                            {{ $item->pembina->nama }}
                        @else
                            Belum diverifikasi
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
