<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 20px;
        }
        h1, h2 {
            text-align: center;
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid #333;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .empty-message {
            font-style: italic;
            color: #777;
        }
    </style>
</head>
<body>
    <h1>Laporan Kehadiran, Program Kegiatan, dan Prestasi</h1>

    <!-- Program Kegiatan -->
    <h2>Program Kegiatan</h2>
    @if($programKegiatan->isEmpty())
        <p class="empty-message">Tidak ada data program kegiatan untuk tahun ajaran ini.</p>
    @else
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Program</th>
                    <th>Deskripsi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($programKegiatan as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->nama_program }}</td>
                        <td>{{ $item->deskripsi }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <!-- Prestasi Siswa -->
    <h2>Prestasi Siswa</h2>
    @if($prestasiSiswa->isEmpty())
        <p class="empty-message">Tidak ada data prestasi siswa untuk tahun ajaran ini.</p>
    @else
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Siswa</th>
                    <th>Prestasi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($prestasiSiswa as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->nama_siswa }}</td>
                        <td>{{ $item->prestasi }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</body>
</html>
