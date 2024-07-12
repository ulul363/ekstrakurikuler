<!-- resources/views/dashboard.blade.php -->

@extends('layouts.master')
@section('content')
    <style>
        .pcoded-navbar {
            height: 100vh;
            overflow-y: auto;
            background-color: #343a40;
        }

        .navbar-wrapper {
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .navbar-content {
            flex-grow: 1;
        }
    </style>
    <div class="pcoded-main-container">
        <div class="pcoded-content">
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h5 class="m-b-10">Selamat datang <span>{{ Auth::user()->name }}</span></h5>
                            </div>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html"><i class="feather icon-home"></i></a></li>
                                <li class="breadcrumb-item"><a href="#!">Dashboard Analytics</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
