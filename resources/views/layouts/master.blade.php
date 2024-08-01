<!DOCTYPE html>
<html lang="en">

<head>
    <title>Flat Able - Premium Admin Template by Phoenixcoded</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="" />
    <meta name="keywords" content="">
    <meta name="author" content="Phoenixcoded" />
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <!-- Favicon icon -->
    <link rel="icon" href="{{ URL::to('assets/images/favicon.ico') }}" type="image/x-icon">

    <!-- vendor css -->
    <link rel="stylesheet" href="{{ URL::to('assets/css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">


    <!-- DataTables Bahasa Indonesia -->
    <!-- Sertakan CSS DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.0/css/dataTables.dataTables.css" />

</head>

<body class="">
    @include('layouts.sidebar')

    @include('layouts.header')

    <div class="pcoded-main-container">
        @yield('content')
    </div>

    <!-- Required Js -->
    <script src="{{ URL::to('assets/js/vendor-all.min.js') }}"></script>
    <script src="{{ URL::to('assets/js/plugins/bootstrap.min.js') }}"></script>
    <script src="{{ URL::to('assets/js/pcoded.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <!-- Apex Chart -->
    <script src="{{ URL::to('assets/js/plugins/apexcharts.min.js') }}"></script>


    <!-- custom-chart js -->
    <script src="{{ URL::to('assets/js/pages/dashboard-main.js') }}"></script>
    <script src="{{ asset('node_modules/sweetalert2/dist/sweetalert2.all.min.js') }}"></script>
    {{-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <!-- Script untuk SweetAlert2 konfirmasi penghapusan -->

    <script>
        function confirmDelete(formId) {
            var form = document.getElementById(formId);
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Anda tidak akan dapat mengembalikan ini!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit(); // Submit form jika pengguna memilih Ya
                }
            });
        }
    </script>

    <!-- Datatables -->
    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
    <script src="https://cdn.datatables.net/2.1.0/js/dataTables.js"></script>

    <!-- Atur bahasa global untuk semua DataTable -->
    <script>
        $(document).ready(function() {
            $.extend(true, $.fn.dataTable.defaults, {
                "language": {
                    "url": "https://cdn.datatables.net/plug-ins/2.1.0/i18n/id.json"
                }
            });

            $('#tabelKetua').DataTable();
            $('#tabelEkstrakurikuler').DataTable();
            $('#tabelPrestasi').DataTable();
            $('#tabelKehadiran').DataTable();
            $('#tabelProgramKegiatan').DataTable();
        });
    </script>

    @yield('scripts')
</body>

</html>
