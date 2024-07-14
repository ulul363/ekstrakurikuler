@extends('layouts.master')

@section('content')
<div class="pcoded-content">
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Ekstrakurikuler</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="feather icon-home"></i></a></li>
                        <li class="breadcrumb-item"><a href="#!">Ekstrakurikuler</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="card card-table">
                <div class="card-body">
                    <div class="page-header">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="page-title">Ekstrakurikuler</h3>
                            </div>
                            <div class="col-auto text-end float-end ms-auto download-grp">
                                @can('ekstrakurikuler.create')
                                <button type="button" class="btn btn-outline-primary me-2" data-toggle="modal" data-target="#createModal">
                                    <i class="fas fa-plus"></i> Tambah Ekstrakurikuler Baru
                                </button>
                                @endcan
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table mb-0 border-0 star-student table-hover table-center datatable table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($ekstrakurikulers as $ekstrakurikuler)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $ekstrakurikuler->nama }}</td>
                                    <td>
                                        <form id="delete-ekstrakurikuler-{{ $ekstrakurikuler->id_ekstrakurikuler }}"
                                            action="{{ route('ekstrakurikuler.destroy', $ekstrakurikuler->id_ekstrakurikuler) }}"
                                            method="POST">
                                            @can('ekstrakurikuler.edit')
                                            <button type="button" class="btn btn-primary me-2" data-toggle="modal"
                                                data-target="#editModal{{ $ekstrakurikuler->id_ekstrakurikuler }}">
                                                Edit
                                            </button>
                                            @endcan
                                            @can('ekstrakurikuler.destroy')
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-danger"
                                                onclick="confirmDelete('delete-ekstrakurikuler-{{ $ekstrakurikuler->id_ekstrakurikuler }}')">
                                                Hapus
                                            </button>
                                            @endcan
                                        </form>
                                    </td>
                                </tr>

                                <!-- Modal Edit -->
                                <div class="modal fade" id="editModal{{ $ekstrakurikuler->id_ekstrakurikuler }}" tabindex="-1"
                                    role="dialog" aria-labelledby="editModalLabel{{ $ekstrakurikuler->id_ekstrakurikuler }}"
                                    aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title"
                                                    id="editModalLabel{{ $ekstrakurikuler->id_ekstrakurikuler }}">Edit
                                                    Ekstrakurikuler</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form
                                                    action="{{ route('ekstrakurikuler.update', $ekstrakurikuler->id_ekstrakurikuler) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="form-group">
                                                        <label for="nama">Nama Ekstrakurikuler</label>
                                                        <input type="text" class="form-control" id="nama" name="nama"
                                                            value="{{ $ekstrakurikuler->nama }}" required>
                                                    </div>
                                                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Create -->
<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Tambah Ekstrakurikuler Baru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('ekstrakurikuler.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="nama">Nama Ekstrakurikuler</label>
                        <input type="text" class="form-control" id="nama" name="nama" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
