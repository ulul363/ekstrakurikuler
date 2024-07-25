@extends('layouts.master')

@section('content')
    <div class="pcoded-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Laporan</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="{{ route('laporan.index') }}">Laporan</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="content-wrapper">
            <div class="container-fluid">
                <!-- Form Pencarian -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h5>Cari Laporan</h5>
                            </div>
                            <div class="card-body">
                                @if (session('error'))
                                    <div class="alert alert-danger">
                                        {{ session('error') }}
                                    </div>
                                @endif
                                <form action="{{ route('pdf') }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label for="ekstrakurikuler">Ekstrakurikuler</label>
                                        <select class="form-control" id="ekstrakurikuler" name="ekstrakurikuler" required>
                                            <option value="">Pilih Ekstrakurikuler</option>
                                            @foreach($ekstrakurikulers as $ekstrakurikulerItem)
                                                <option value="{{ $ekstrakurikulerItem->id }}">{{ $ekstrakurikulerItem->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="tahun_ajaran">Tahun Ajaran</label>
                                        <input type="number" class="form-control" id="tahun_ajaran" name="tahun_ajaran" placeholder="Masukkan Tahun Ajaran" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Generate PDF</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script>
        function confirmDelete(formId) {
            if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
                document.getElementById(formId).submit();
            }
        }
    </script>
@endsection
