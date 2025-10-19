@extends('layouts.master-without-nav')

@section('title')
    Pilih Jenis Pendaftaran
@endsection

@section('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@section('content')
<div class="auth-page-wrapper auth-bg-cover py-5 d-flex justify-content-center align-items-center min-vh-100">
    <div class="bg-overlay" style="background-color : #fff7cc;"></div>
    <div class="auth-page-content overflow-hidden pt-lg-5">
        <div class="container">
                    <div class="card overflow-hidden">
                        <div class="row g-0">
                            {{-- BAGIAN KIRI (GAMBAR & GRADIENT KUNING) --}}
                            <div class="col-lg-6">
                                <div class="p-lg-5 p-4 auth-one-bg h-100">
                                    <div class="bg-overlay" style="background: linear-gradient(90deg,#e2b602,#f5e38f);opacity: .9;"></div>
                                    <div class="position-relative h-100 d-flex flex-column">
                                        <div class="mb-4">
                                            <a href="#" class="d-block">
                                                <img src="{{ asset('assets/images/logo-cendikia.png') }}" alt="" height="50">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- BAGIAN KANAN (FORM PENDAFTARAN) --}}
                            <div class="col-lg-6">
                                <div class="p-lg-5 p-4">
                                    <div>
                                        <h5 class="text-primary">Daftar Akun LBB CENDEKIA</h5>
                                    </div>

                                    <div class="mt-4">
                                        @if ($errors->any())
                                            <div class="alert alert-danger">
                                                <ul class="mb-0">
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif

                                        <form method="POST" action="{{ route('register.siswa') }}">
                                            @csrf
                                            {{-- Beri tanda bintang (*) pada label yang wajib --}}
                                            <div class="mb-3"><label for="name" class="form-label">Nama Lengkap <span class="text-danger">*</span></label><input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Masukkan Nama Lengkap" value="{{ old('name') }}" required>@error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror</div>
                                            <div class="mb-3"><label for="email" class="form-label">Email <span class="text-danger">*</span></label><input type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Masukkan Email" value="{{ old('email') }}" required>@error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror</div>
                                            
                                            {{-- Hapus atribut 'required' dari field opsional --}}
                                            <div class="mb-3"><label for="telepon" class="form-label">Telepon</label><input type="text" class="form-control @error('telepon') is-invalid @enderror" name="telepon" placeholder="Masukkan Telepon" value="{{ old('telepon') }}">@error('telepon')<div class="invalid-feedback">{{ $message }}</div>@enderror</div>
                                            <div class="mb-3"><label for="nama_orang_tua" class="form-label">Nama Orangtua</label><input type="text" class="form-control" name="nama_orang_tua" placeholder="Masukkan Nama Orangtua" value="{{ old('nama_orang_tua') }}"></div>
                                            <div class="mb-3"><label for="telp_orang_tua" class="form-label">Telepon Orangtua</label><input type="text" class="form-control" name="telp_orang_tua" placeholder="Masukkan Telepon Orangtua" value="{{ old('telp_orang_tua') }}"></div>
                                            <div class="mb-3"><label for="alamat" class="form-label">Alamat</label><input type="text" class="form-control" name="alamat" placeholder="Masukkan alamat" value="{{ old('alamat') }}"></div>
                                            <div class="mb-3">
                                                <label for="asal_sekolah" class="form-label">Asal Sekolah</label>
                                                <select class="form-control select2" name="asal_sekolah" id="asal_sekolah" style="width:100%">
                                                    @if(old('asal_sekolah'))
                                                        <option selected value="{{ old('asal_sekolah') }}">{{ old('asal_sekolah') }}</option>
                                                    @endif
                                                </select>
                                            </div>
                                            
                                            <div class="mb-3">
                                                <label for="jenjang" class="form-label">Jenjang</label>
                                                <select class="form-select" name="jenjang" id="jenjang">
                                                    <option value="" selected>Pilih Jenjang</option>
                                                    <option value="SD" {{ old('jenjang') == 'SD' ? 'selected' : '' }}>SD</option>
                                                    <option value="SMP" {{ old('jenjang') == 'SMP' ? 'selected' : '' }}>SMP</option>
                                                    <option value="SMA" {{ old('jenjang') == 'SMA' ? 'selected' : '' }}>SMA</option>
                                                </select>
                                            </div>

                                            <div class="mb-3">
                                                <label for="kelas" class="form-label">Kelas</label>
                                                <select class="form-select" name="kelas" id="kelas" disabled>
                                                    <option value="">Pilih Jenjang Terlebih dahulu</option>
                                                </select>
                                            </div>
                                                <div class="mb-3">
                                                    <label for="golongan" class="form-label">Golongan</label>
                                                    <select class="form-select" name="golongan" id="golongan" required>
                                                        <option value="" selected disabled>Pilih Golongan</option>
                                                        <option value="A" {{ old('golongan') == 'A' ? 'selected' : '' }}>A</option>
                                                        <option value="B" {{ old('golongan') == 'B' ? 'selected' : '' }}>B</option>
                                                        <option value="C" {{ old('golongan') == 'C' ? 'selected' : '' }}>C</option>
                                                        <option value="D" {{ old('golongan') == 'D' ? 'selected' : '' }}>D</option>
                                                    </select>
                                                </div>
                                            <div class="mb-3"><label class="form-label" for="password">Password <span class="text-danger">*</span></label><input type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Masukkan password" required>@error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror</div>
                                            <div class="mb-3"><label class="form-label" for="password_confirmation">Ulangi Password <span class="text-danger">*</span></label><input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" placeholder="Ketik ulang password" required>@error('password_confirmation')<div class="invalid-feedback">{{ $message }}</div>@enderror</div>
                                            <div class="mt-4"><button class="btn btn-danger w-100" type="submit">Daftar</button></div>
                                        </form>
                                    </div>

                                    <div class="mt-5 text-center">
                                        <p class="mb-0">Sudah Punya Akun ? <a href="{{ route('login') }}" class="fw-semibold text-primary text-decoration-underline"> Masuk</a> </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        // Init Select2 for asal_sekolah
        if ($.fn.select2) {
            $('#asal_sekolah').select2({
                placeholder: "Cari & Pilih Sekolah",
                allowClear: true,
                tags: true,
                minimumInputLength: 1,
                dropdownParent: $('body'),
                ajax: {
                    url: '{{ route('ajax.cari-sekolah') }}',
                    dataType: 'json',
                    delay: 250,
                    data: function(params) { return { q: params.term }; },
                    processResults: function(data) { return { results: data }; },
                    cache: true
                },
                width: '100%'
            });
        }

        // Dropdown kelas logic
        const jenjangDropdown = document.getElementById('jenjang');
        const kelasDropdown = document.getElementById('kelas');
        const kelasOptions = {
            'SD': ['Kelas 1', 'Kelas 2', 'Kelas 3', 'Kelas 4', 'Kelas 5', 'Kelas 6'],
            'SMP': ['Kelas 7', 'Kelas 8', 'Kelas 9'],
            'SMA': ['Kelas 10', 'Kelas 11', 'Kelas 12']
        };
        jenjangDropdown.addEventListener('change', function() {
            const selectedJenjang = this.value;
            kelasDropdown.innerHTML = '<option value="">Pilih Kelas</option>';
            if (selectedJenjang && kelasOptions[selectedJenjang]) {
                kelasDropdown.disabled = false;
                kelasOptions[selectedJenjang].forEach(function(kelas) {
                    const option = document.createElement('option');
                    option.value = kelas;
                    option.text = kelas;
                    kelasDropdown.appendChild(option);
                });
            } else {
                kelasDropdown.disabled = true;
                kelasDropdown.innerHTML = '<option value="">Pilih Jenjang Terlebih dahulu</option>';
            }
        });
    });
</script>
@endsection