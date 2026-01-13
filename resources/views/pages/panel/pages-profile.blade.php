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
                    <div class="col-md-6 position-relative">
                        {{-- Action buttons fixed to bottom-right inside the card body --}}
                        <div class="position-absolute" style="right:16px; bottom:16px;">
                            <a href="{{ route('panel.dashboard') }}" class="btn btn-secondary me-2">Kembali</a>
                            <a href="{{ route('panel.user.edit', ['user' => $user->id, 'from' => 'profile']) }}" class="btn btn-primary">Edit Profile</a>
                        </div>
                        {{-- keep some min-height so the buttons have space when content is short --}}
                        <div style="min-height:80px;"></div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
