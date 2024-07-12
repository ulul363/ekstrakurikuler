@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Ekstrakurikuler</div>

                <div class="card-body">
                    <form action="{{ route('ekstrakurikuler.update', $ekstrakurikuler->id_ekstrakurikuler) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="id_ekstrakurikuler">ID Ekstrakurikuler</label>
                            <input type="text" name="id_ekstrakurikuler" class="form-control" value="{{ $ekstrakurikuler->id_ekstrakurikuler }}" required>
                        </div>

                        <div class="form-group">
                            <label for="nip_pembina">NIP Pembina</label>
                            <select name="nip_pembina" class="form-control" required>
                                @foreach ($pembina as $item)
                                    <option value="{{ $item->nip_pembina }}" {{ $item->nip_pembina == $ekstrakurikuler->nip_pembina ? 'selected' : '' }}>
                                        {{ $item->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="nama_ekstrakurikuler">Nama Ekstrakurikuler</label>
                            <input type="text" name="nama_ekstrakurikuler" class="form-control" value="{{ $ekstrakurikuler->nama_ekstrakurikuler }}" required>
                        </div>

                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" name="nama" class="form-control" value="{{ $ekstrakurikuler->nama }}" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ route('ekstrakurikuler.index') }}" class="btn btn-secondary">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
