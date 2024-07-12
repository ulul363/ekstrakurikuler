@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Edit Ekstrakurikuler</div>

                    <div class="card-body">
                        <form action="{{ route('ekstrakurikuler.update', $ekstrakurikuler->id_ekstrakurikuler) }}"
                            method="POST">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="id_ekstrakurikuler">ID Ekstrakurikuler</label>
                                <input type="text" name="id_ekstrakurikuler" class="form-control"
                                    value="{{ $ekstrakurikuler->id_ekstrakurikuler }}" disabled>
                            </div>

                            <div class="form-group">
                                <label for="nip_pembina">NIP Pembina</label>
                                <select name="nip_pembina" class="form-control" required>
                                    @foreach ($pembina as $item)
                                        <option value="{{ $item->nip_pembina }}"
                                            {{ $item->nip_pembina == $ekstrakurikuler->nip_pembina ? 'selected' : '' }}>
                                            {{ $item->nip_pembina }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="nama_ekstrakurikuler">Nama Ekstrakurikuler</label>
                                <input type="text" name="nama_ekstrakurikuler" class="form-control"
                                    value="{{ $ekstrakurikuler->nama_ekstrakurikuler }}" required>
                            </div>

                            <div class="form-group">
                                <label for="nama">Nama</label>
                                <select name="nama" class="form-control" required>
                                    @foreach ($pembina as $item)
                                        <option value="{{ $item->nama }}"
                                            {{ $item->nama == $ekstrakurikuler->nama ? 'selected' : '' }}>
                                            {{ $item->nama }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#confirmModal">
                                Simpan
                            </button>
                            <a href="{{ route('ekstrakurikuler.index') }}" class="btn btn-secondary">Kembali</a>

                            <!-- Confirm Modal -->
                            <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="confirmModalLabel">Konfirmasi Simpan</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            Apakah Anda yakin ingin menyimpan perubahan ini?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
