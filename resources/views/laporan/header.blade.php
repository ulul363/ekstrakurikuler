<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        /* Styling untuk header */
        .header {
            text-align: center;
            font-size: 12px;
            line-height: 1.5;
            margin-bottom: 20px;
        }
        .alamat {
            font-size: 10px;
            margin-bottom: 5px;
        }
        .garis {
            border-top: 1px solid black;
            margin: 20px 0;
        }
    </style>
</head>
<body>
    <div class="header">
        <img src="{{ public_path('assets/images') }}" alt="Logo Mandemak">
        <div>MADRASAH ALIYAH NEGERI DEMAK</div>
        <div class="alamat">
            Jl. Diponegoro No. 27 Demak Jogoloyo, Kecamatan Wonosalam,<br>
            Kabupaten Demak Jawa Tengah 59571<br>
            Telepon : 0291-681219 Email : mandemak1@gmail.com
        </div>
    </div>
    <div class="garis"></div>
</body>
</html>
