@extends('layouts.master')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Profile') }}</div>

                    <div class="card-body">
                        <table class="table">
                            <tr>
                                <th>{{ __('Name') }}</th>
                                <td>{{ $user->name }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('Email') }}</th>
                                <td>{{ $user->email }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('Role') }}</th>
                                <td>{{ $user->roles->pluck('name')->implode(', ') }}</td>
                            </tr>
                            <!-- Add other fields as needed -->
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
