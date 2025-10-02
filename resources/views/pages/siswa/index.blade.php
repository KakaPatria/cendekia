@extends('layouts.app')

@section('content')
<div class="container-fluid mt-5">
    <h3 class="mb-4 text-center fw-bold text-primary" style="font-size:2rem;">Daftar Seluruh Siswa</h3>
    <div class="text-center mb-2 fw-semibold text-secondary">
        Total Siswa: {{ $siswa->total() }}
    </div>
    <div class="card shadow-lg border-0 rounded-3 animate-fadein">
        <div class="card-body p-0">
            <table class="table table-hover table-bordered align-middle text-center mb-0" id="siswaTable">
                <thead class="bg-primary text-white">
                    <tr>
                        <th style="width: 50px;">No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Telepon</th>
                        <th>Asal Sekolah</th>
                        <th>Jenjang</th>
                        <th>Kelas</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($siswa as $index => $item)
                    <tr>
                        <td>{{ ($siswa->currentPage() - 1) * $siswa->perPage() + $index + 1 }}</td>
                        <td class="fw-semibold">{{ $item->name }}</td>
                        <td>
                            {{ $item->email }}
                        </td>
                        <td>{{ $item->telepon ?? '-' }}</td>
                        <td>{{ $item->asal_sekolah ?? '-' }}</td>
                        <td>{{ $item->jenjang ?? '-' }}</td>
                        </td>
                        <td>
                            @php
                                $kelasRaw = $item->kelas ?? '-';
                                preg_match('/\d+/', $kelasRaw, $match);
                                $kelasNum = $match[0] ?? $kelasRaw;
                            @endphp
                            <span class="badge bg-warning text-dark px-3 py-2 kelas-anim" style="font-size:1rem;border-radius:8px;box-shadow:0 1px 4px rgba(255,193,7,0.12);font-weight:600;">{{ $kelasNum }}</span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted">Belum ada siswa terdaftar</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="d-flex justify-content-center mt-4">
        {{ $siswa->links() }}
    </div>
</div>
@endsection

@push('styles')
<style>
    body {
        overflow-x: hidden;
        background-color: #f8f9fa;
    }
    .table th {
        font-weight: bold;
        font-size: 1.05rem;
    }
    .table td, .table th {
        vertical-align: middle;
        border: none;
    }
    .table-hover tbody tr {
        transition: background 0.4s, box-shadow 0.4s, transform 0.3s;
    }
    .table-hover tbody tr:hover {
        background-color: #e3f2fd;
        cursor: pointer;
        box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        transform: scale(1.01);
    }
    .badge.bg-warning {
        font-weight: 600;
        font-size: 1rem;
        border-radius: 8px;
        box-shadow: 0 1px 4px rgba(255,193,7,0.12);
    }
    .animate-fadein {
        animation: fadeInTable 1.2s cubic-bezier(.4,0,.2,1);
    }
    @keyframes fadeInTable {
        from { opacity: 0; transform: translateY(40px) scale(0.98); }
        to { opacity: 1; transform: translateY(0) scale(1); }
    }
    .kelas-anim {
        transition: transform 0.3s cubic-bezier(.4,0,.2,1);
    }
    .kelas-anim:hover {
        transform: scale(1.13) rotate(-6deg);
    }
</style>
@endpush
