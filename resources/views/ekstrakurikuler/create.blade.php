@extends('layouts.master')
@section('content')

<div class="pcoded-content">

    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Selamat Datang <span>{{ Auth::user()->name }}</span></h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html"><i class="feather icon-home"></i></a></li>
                        <li class="breadcrumb-item"><a href="#!">Dashboard Analytics</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">Tambah Ekstrakurikuler</div>

                <div class="card-body">
                    <form action="{{ route('ekstrakurikuler.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="nip_pembina">NIP Pembina</label>
                            <select name="nip_pembina" class="form-control" required>
                                @foreach ($pembina as $item)
                                    <option value="{{ $item->nip_pembina }}">{{ $item->nip_pembina }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="nama_ekstrakurikuler">Nama Ekstrakurikuler</label>
                            <input type="text" name="nama_ekstrakurikuler" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <select name="nama" class="form-control">
                                @foreach ($pembina as $item)
                                    <option value="{{ $item->nama }}">{{ "$item->nama" }}</option>
                                @endforeach
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ route('ekstrakurikuler.index') }}" class="btn btn-secondary">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- [ Main Content ] end -->
</div>
@endsection




