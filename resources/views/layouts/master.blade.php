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
    <link rel="icon" href="{{ URL::to("assets/images/favicon.ico") }}" type="image/x-icon">

    <!-- vendor css -->
    <link rel="stylesheet" href="{{ URL::to("assets/css/style.css") }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">


</head>

<body class="">
    @include('layouts.sidebar')

    @include('layouts.header')

    <div class="pcoded-main-container">
        @yield('content')
    </div>

    <!-- Required Js -->
    <script src="{{ URL::to("assets/js/vendor-all.min.js") }}"></script>
    <script src="{{ URL::to("assets/js/plugins/bootstrap.min.js") }}"></script>
    <script src="{{ URL::to("assets/js/pcoded.min.js") }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<!-- Apex Chart -->
<script src="{{ URL::to("assets/js/plugins/apexcharts.min.js") }}"></script>


<!-- custom-chart js -->
<script src="{{ URL::to("assets/js/pages/dashboard-main.js") }}"></script>
</body>

</html>
