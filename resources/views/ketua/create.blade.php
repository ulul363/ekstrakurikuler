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
                <div class="card-header">Tambah Ketua</div>

                <div class="card-body">
                    <form action="{{ route('ketua.store') }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label for="nis">NIS Ketua</label>
                            <input type="text" name="nis" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" name="nama" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="no_hp">No HP</label>
                            <input type="text" name="no_hp" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <input type="text" name="alamat" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="jk">Jenis Kelamin</label>
                            <select name="jk" class="form-control" required>
                                <option value="L">Laki-Laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="ekstrakurikuler_id">Ekstrakurikuler</label>
                            <select name="ekstrakurikuler_id" class="form-control" required>
                                @foreach($ekstrakurikuler as $item)
                                    <option value="{{ $item->id_ekstrakurikuler }}">{{ $item->nama }}</option>
                                @endforeach
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- [ Main Content ] end -->
</div>
@endsection
