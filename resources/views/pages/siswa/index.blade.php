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

    .card {
        background: #ffffff;

}
</style>
@endpush
