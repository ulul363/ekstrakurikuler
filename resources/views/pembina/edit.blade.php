@extends('layouts.master')
@section('content')

<div class="pcoded-content">
    <div class="page-header">
        <!-- Page Header Content -->
    </div>

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">Edit Pembina</div>

                <div class="card-body">
                    <form action="{{ route('pembina.update', $pembina->id_pembina) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="user_id">User</label>
                            <input type="text" name="user_id" id="user_id" class="form-control" value="{{ $pembina->user_id }}" readonly>
                        </div>

                        <div class="form-group">
                            <label for="ekstrakurikuler_id">Ekstrakurikuler</label>
                            <select name="ekstrakurikuler_id" id="ekstrakurikuler_id" class="form-control">
                                @foreach ($ekstrakurikuler as $item)
                                    <option value="{{ $item->id_ekstrakurikuler }}" {{ $pembina->ekstrakurikuler_id == $item->id_ekstrakurikuler ? 'selected' : '' }}>
                                        {{ $item->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="nip">NIP Pembina</label>
                            <input type="text" name="nip" class="form-control" value="{{ $pembina->nip }}" required>
                        </div>

                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" name="nama" class="form-control" value="{{ $pembina->nama }}" required>
                        </div>

                        <div class="form-group">
                            <label for="no_hp">No HP</label>
                            <input type="text" name="no_hp" class="form-control" value="{{ $pembina->no_hp }}" required>
                        </div>

                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <input type="text" name="alamat" class="form-control" value="{{ $pembina->alamat }}" required>
                        </div>

                        <div class="form-group">
                            <label for="jk">Jenis Kelamin</label>
                            <select name="jk" class="form-control" required>
                                <option value="L" {{ $pembina->jk == 'L' ? 'selected' : '' }}>Laki-Laki</option>
                                <option value="P" {{ $pembina->jk == 'P' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
