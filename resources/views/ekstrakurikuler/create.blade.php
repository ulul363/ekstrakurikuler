@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Tambah Ekstrakurikuler</div>

                <div class="card-body">
                    <form action="{{ route('ekstrakurikuler.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="nip_pembina">NIP Pembina</label>
                            <select name="nip_pembina" class="form-control" required>
                                @foreach ($pembina as $item)
                                    <option value="{{ $item->nip_pembina }}">{{ $item->nama }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="nama_ekstrakurikuler">Nama Ekstrakurikuler</label>
                            <input type="text" name="nama_ekstrakurikuler" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" name="nama" class="form-control" required>
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
