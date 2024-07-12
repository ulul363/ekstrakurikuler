<!DOCTYPE html>
<html lang="en">

<head>
    <title>Flat Able - Premium Admin Template by Phoenixcoded</title>
    <!-- HTML5 Shim and Respond.js IE11 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 11]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="" />
    <meta name="keywords" content="">
    <meta name="author" content="Phoenixcoded" />
    <!-- Favicon icon -->
    <link rel="icon" href="{{ asset('dist/assets/images/favicon.ico') }}" type="image/x-icon">
    <!-- vendor css -->
    <link rel="stylesheet" href="{{ asset('dist/assets/css/style.css') }}">
    {{-- header css --}}
    <link rel="stylesheet" href="{{ asset('dist/assets/css/header.css') }}">
    {{-- font awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    
</head>

<body class="">

    {{-- nav --}}
    @include('layouts.sidebar')

    {{-- header --}}
    @include('layouts.header')

    <!-- [ Main Content ] start -->
    @yield('content')
    <!-- [ Main Content ] end -->

    <!-- Required Js -->
    <!-- Misal menggunakan CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="/path/to/vendor-all.min.js"></script>
    <script src="/path/to/bootstrap.min.js"></script>
    <script src="/path/to/pcoded.min.js"></script>
    <script src="/path/to/apexcharts.min.js"></script>
    <script src="/path/to/dashboard-main.js"></script>
    <script src="/path/to/app.js"></script>
    <script src="{{ asset('dist/js/app.js') }}" defer></script>
    <script src="{{ asset('dist/js/vendor-all.min.js') }}"></script>
    <script src="{{ asset('dist/js/plugins/bootstrap.min.js') }}"></script>
    <script src="{{ asset('dist/js/pcoded.min.js') }}"></script>
    <script src="{{ asset('dist/js/plugins/apexcharts.min.js') }}"></script>
    <script src="{{ asset('dist/js/pages/dashboard-main.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            $('#mobile-collapse').click(function(e) {
                e.preventDefault();
                $('body').toggleClass('sidebar-collapsed');
            });
        });
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>
