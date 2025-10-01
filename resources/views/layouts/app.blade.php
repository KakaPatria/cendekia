<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            @php
                $tahunAwal = now()->year;
                $tahunAkhir = $tahunAwal + 1;
            @endphp

            <h5 class="fs-5 fw-bold text-white m-0">
                Daftar Siswa Baru TA {{ $tahunAwal }}-{{ $tahunAkhir }}
            </h5>
        </div>
    </nav>

    <div class="container mt-4">
        @yield('content')
    </div>
</body>
</html>
