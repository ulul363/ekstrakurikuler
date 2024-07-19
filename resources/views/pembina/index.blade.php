@extends('layouts.master')

@section('content')
    <div class="pcoded-content">

        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Pembina</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i
                                        class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="{{ route('pembina.index') }}">Pembina</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header">Pembina</div>

                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif

                        <a href="{{ route('pembina.createuser') }}" class="btn btn-primary mb-3">
                            <i class="fa fa-plus"></i> Tambah Pembina
                        </a>

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>NIP</th>
                                    <th>Nama</th>
                                    <th>Jenis Kelamin</th>
                                    <th>No HP</th>
                                    <th>Alamat</th>
                                    <th>Ekstrakurikuler</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pembina as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->nip }}</td>
                                        <td>{{ $item->nama }}</td>
                                        <td>
                                            @if ($item->jk === 'L')
                                                Laki-Laki
                                            @else
                                                Perempuan
                                            @endif
                                        </td>
                                        <td>{{ $item->no_hp }}</td>
                                        <td>{{ $item->alamat }}</td>
                                        <td>{{ $item->ekstrakurikuler->nama }}</td>
                                        <td>
                                            <form id="delete-pembina-{{ $item->id_pembina }}"
                                                action="{{ route('pembina.destroy', $item->id_pembina) }}" method="POST">
                                                @can('pembina.edit')
                                                    <a href="{{ route('pembina.edit', $item->id_pembina) }}"
                                                        class="btn btn-warning btn-sm">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                @endcan
                                                @can('pembina.destroy')
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-danger btn-sm"
                                                        onclick="confirmDelete('delete-pembina-{{ $item->id_pembina }}')">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                @endcan
                                            </form>

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
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
