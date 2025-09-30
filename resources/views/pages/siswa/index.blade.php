@extends('layouts.app')

@section('content')
<div class="container-fluid mt-5">
    <h3 class="mb-4 text-center fw-bold text-primary"> Daftar Seluruh Siswa</h3>

    <div class="card shadow-lg border-0 rounded-3">
        <div class="card-body p-0">
            <table class="table table-hover table-bordered align-middle text-center mb-0">
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
                        <td>
                            {{ ($siswa->currentPage() - 1) * $siswa->perPage() + $index + 1 }}
                        </td>
                        <td class="fw-semibold">{{ $item->name }}</td>
                        <td>{{ $item->email }}</td>
                        <td>{{ $item->telepon ?? '-' }}</td>
                        <td>{{ $item->asal_sekolah ?? '-' }}</td>
                        <td>{{ $item->jenjang ?? '-' }}</td>
                        <td>{{ $item->kelas ?? '-' }}</td>
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

    {{-- pagination --}}
    <div class="d-flex justify-content-center mt-3">
        {{ $siswa->links() }}
    </div>
</div>
@endsection

@push('styles')
<style>
    body {
        overflow-x: hidden; /* cegah scroll horizontal */
        background-color: #f8f9fa; /* tema background soft */
    }
    
    .table th {
        font-weight: bold;
    }
    
    .table td, .table th {
        vertical-align: middle;
    }
    
    /* Card container */
    .card {
        background: #ffffff;
        border-radius: 15px;
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card:hover {
        transform: translateY(-8px) scale(1.01);
        box-shadow: 0 12px 25px rgba(0,0,0,0.15);
    }

    /* Header tabel */
    .table thead {
        background: linear-gradient(90deg, #2563eb, #4f46e5);
    }

    .table thead th {
        color: #fff !important;
        letter-spacing: 0.5px;
        font-size: 0.95rem;
    }

    /* Hover row effect */
    .table-hover tbody tr {
        transition: background-color 0.3s ease, transform 0.2s ease;
    }

    .table-hover tbody tr:hover {
        background-color: #e9f2ff;
        transform: scale(1.01);
    }

    /* Fade-in animasi tabel */
    .table tbody tr {
        opacity: 0;
        animation: fadeInRow 0.6s forwards;
    }

    .table tbody tr:nth-child(1) { animation-delay: 0.1s; }
    .table tbody tr:nth-child(2) { animation-delay: 0.2s; }
    .table tbody tr:nth-child(3) { animation-delay: 0.3s; }
    .table tbody tr:nth-child(4) { animation-delay: 0.4s; }
    .table tbody tr:nth-child(5) { animation-delay: 0.5s; }
    .table tbody tr:nth-child(6) { animation-delay: 0.6s; }
    .table tbody tr:nth-child(7) { animation-delay: 0.7s; }

    @keyframes fadeInRow {
        from {
            opacity: 0;
            transform: translateY(10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>
@endpush
