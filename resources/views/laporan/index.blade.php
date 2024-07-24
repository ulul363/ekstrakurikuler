@extends('layouts.master')

@section('content')
<div class="container mt-5">
    <h2>Generate Laporan</h2>

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('pdf') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="tahun_ajaran">Tahun Ajaran</label>
            <input type="number" class="form-control" id="tahun_ajaran" name="tahun_ajaran" placeholder="Contoh : 2024">
        </div>
        <button type="submit" class="btn btn-primary">Generate PDF</button>
    </form>
</div>
@endsection
