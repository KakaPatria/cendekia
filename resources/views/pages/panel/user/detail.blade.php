@extends('layouts.panel.master')
@section('content')
<div class="container-fluid">
    <h4 class="mb-4">Detail Siswa</h4>

    <div class="card mb-4">
        <div class="card-body">
            <h5>{{ $user->name }}</h5>
            <p>Email: {{ $user->email }}</p>
            <p>Jenjang: {{ $user->jenjang ?? '-' }}</p>
            <p>Sekolah: {{ $user->asal_sekolah ?? '-' }}</p>
            <p><strong>Rata-rata Nilai Tryout:</strong> {{ $rataRataNilai }}</p>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header">Riwayat Tryout</div>
        <div class="card-body">
            @if($nilaiTryout->isEmpty())
                <p>Belum ada nilai tryout.</p>
            @else
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Tryout</th>
                            <th>Materi</th>
                            <th>Nilai</th>
                            <th>Benar</th>
                            <th>Salah</th>
                            <th>Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($nilaiTryout as $n)
                        <tr>
                            <td>{{ $n->masterTryout->judul ?? '-' }}</td>
                            <td>{{ $n->tryoutMateri->nama ?? '-' }}</td>
                            <td>{{ $n->nilai }}</td>
                            <td>{{ $n->jumlah_benar }}</td>
                            <td>{{ $n->jumlah_salah }}</td>
                            <td>{{ $n->created_at->format('d M Y') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</div>
@endsection
