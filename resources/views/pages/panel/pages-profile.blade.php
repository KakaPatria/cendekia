@extends('layouts.panel.master')

@section('title', 'Profile')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Profile</h4>
                <p class="card-title-desc">Informasi Akun.</p>

                <div class="row">
                    <div class="col-md-6">
                        <table class="table table-borderless">
                            <tr>
                                <th>Nama</th>
                                <td>{{ $user->name ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td>{{ $user->email ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>Dibuat pada</th>
                                <td>{{ $user->created_at ? $user->created_at->format('d M Y H:i') : '-' }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <a href="{{ route('panel.user.edit', $user->id) }}" class="btn btn-primary">Edit Profile</a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
