@extends('layouts.master-without-nav')
@section('title') Landing @endsection
@section('css')
<link href="{{ URL::asset('assets/libs/swiper/swiper.min.css') }}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="{{ URL::asset('assets/libs/@simonwep/pickr/themes/classic.min.css') }}" /> <!-- 'classic' theme -->
@endsection
@section('body')

<body data-bs-spy="scroll" data-bs-target="#navbar-example">
    @endsection
    @section('content')
    <div class="layout-wrapper landing">
        <nav class="navbar navbar-expand-lg navbar-landing fixed-top job-navbar" id="navbar">
            <div class="container-fluid custom-container">
                <a class="navbar-brand" href="index">
                    <img src="{{URL::asset('assets/images/logo-cendikia.png')}}" class="card-logo card-logo-dark" alt="logo dark" height="40">
                    <img src="{{URL::asset('assets/images/logo-cendikia.png')}}" class="card-logo card-logo-light" alt="logo light" height="40">
                </a>
                <button class="navbar-toggler py-0 fs-20 text-body" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="mdi mdi-menu"></i>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mx-auto mt-2 mt-lg-0" id="navbar-example">
                        <li class="nav-item">
                            <a class="nav-link active" href="#hero">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#informasi">Informasi</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#hubungi">Hubungi</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#promo">Promo</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#tryout">Tryout</a>
                        </li>

                    </ul>

                    <div class="">
                        <a href="{{ route('login')}}" class="btn btn-soft-danger"><i class="ri-user-3-line align-bottom me-1"></i> Masuk & Daftar</a>
                    </div>
                </div>

            </div>
        </nav>
        <!-- end navbar -->

        <!-- start tryout -->
        <section class="section bg-light" id="tryout">
            <div class="bg-overlay bg-overlay-pattern"></div>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="text-center mb-5">
                            <!-- Responsive Images -->
                            <img src="{{ Storage::url($tryout->tryout_banner) }}" class="img-fluid mb-3 mt-6" alt="Responsive image">

                            <h3 class="mb-3 ff-secondary fw-semibold text-capitalize m-0 lh-base">{{ $tryout->tryout_judul}}</h3>

                            <p class="text-muted mb-4">{!! $tryout->tryout_deskripsi!!}</p>

                        </div>
                        @include('components.message')

                        <div class="mt-4">
                            
                            <form action="{{ route('daftar_tryout.store',$tryout->tryout_id)}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <h4 class="card-title mb-0 flex-grow-1">IDENTITAS</h4>
                                <div class="mb-3">
                                    <label for="nama " class="form-label">Email Aktif</label>
                                    <input type="text" class="form-control" id="input-email" name="top_email" placeholder="Masukan Nama Email" required value="{{ old('top_email') }}">
                                    @if ($errors->has('top_email'))
                                    <div class="text-danger">{{ $errors->first('top_email') }}</div>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <label for="nama " class="form-label">Nama Lengkap</label>
                                    <input type="text" class="form-control" id="input-nama" name="top_nama_siswa" placeholder="Masukan Nama Email" required value="{{ old('top_nama_siswa') }}">
                                    @if ($errors->has('top_nama_siswa'))
                                    <div class="text-danger">{{ $errors->first('top_nama_siswa') }}</div>
                                    @endif
                                </div>

                                <div class="mb-3">
                                    <label for="asal_sekolah" class="form-label">Asal Sekolah</label>
                                    <select class="form-control select2" name="top_asal_sekolah" id="asal_sekolah">
                                    </select>
                                    @if ($errors->has('top_asal_sekolah'))
                                    <div class="text-danger">{{ $errors->first('top_asal_sekolah') }}</div>
                                    @endif
                                </div>

                                <div class="mb-3">
                                    <label for="nama " class="form-label">Nomor HP/WA SISWA</label>
                                    <input type="text" class="form-control" id="input-telpon-siswa" name="top_telpon_siswa" placeholder="Masukan Nama Telepon / Wa Siswa" required value="{{ old('top_telpon_siswa') }}">
                                    @if ($errors->has('top_telpon_siswa'))
                                    <div class="text-danger">{{ $errors->first('top_telpon_siswa') }}</div>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <label for="nama " class="form-label">Nama Orang Tua / Wali</label>
                                    <input type="text" class="form-control" id="input-nama-orang-tua" name="top_nama_orang_tua" placeholder="Masukan Nama Nama Orang Tua / Wali" required value="{{ old('top_telpon_siswa') }}">
                                    @if ($errors->has('top_nama_orang_tua'))
                                    <div class="text-danger">{{ $errors->first('top_nama_orang_tua') }}</div>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <label for="nama " class="form-label">Nomor HP/WA Orang Tua/ Wali</label>
                                    <input type="text" class="form-control" id="input-telpon-orang-tua" name="top_telpon_orang_tua" placeholder="Masukan Nama Telepon / Wa Orang Tua / Wali" required value="{{ old('top_telpon_orang_tua') }}">
                                    @if ($errors->has('top_telpon_orang_tua'))
                                    <div class="text-danger">{{ $errors->first('top_telpon_orang_tua') }}</div>
                                    @endif
                                </div>
                                <hr>

                                <h4 class="card-title mb-0 flex-grow-1">PEMBAYARAN</h4>
                                <div class="mb-3">
                                    <label for="nama " class="form-label">Tanggal Bayar</label>
                                    <input type="date" class="form-control" id="input-tanggal-bayar" name="top_tanggal_bayar" data-provider="flatpickr" data-date-format="d M, Y" required value="{{ old('top_tanggal_bayar') }}">
                                    @if ($errors->has('top_tanggal_bayar'))
                                    <div class="text-danger">{{ $errors->first('top_tanggal_bayar') }}</div>
                                    @endif
                                </div>

                                <div class="mb-3">
                                    <label for="jenjang" class="form-label">Pembayaran Via</label>
                                    <select id="jenjang" class="form-control" name="top_jenis_bayar">
                                        <option value="">Pilih Jenis Pembayaran</option>
                                        <option value="Bank Transfer" {{ old('top_jenis_bayar') == 'Bank Transfer' ? 'selected' : '' }}>Bank Transfer</option>
                                        <option value="Datang Langsung Ke Kantor Cendekia" {{ old('top_jenis_bayar') == 'Datang Langsung Ke Kantor Cendekia' ? 'selected' : '' }}>Datang Langsung Ke Kantor Cendekia</option>
                                    </select>
                                    @if ($errors->has('top_jenis_bayar'))
                                    <div class="text-danger">{{ $errors->first('top_jenis_bayar') }}</div>
                                    @endif
                                </div>

                                <div class="mb-3">
                                    <label for="nama " class="form-label">Bukti Bayar</label>
                                    <input type="file" class="form-control" id="input-bukti-bayar" name="top_bukti_bayar" placeholder="Upload Bukti Bayar" required value="{{ old('top_bukti_bayar') }}">
                                    <!-- Default File Input Example -->
                                     
                                    @if ($errors->has('top_bukti_bayar'))
                                    <div class="text-danger">{{ $errors->first('top_bukti_bayar') }}</div>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <label for="nama " class="form-label">Pembayaran Atas Nama</label>
                                    <input type="text" class="form-control" id="input-nama-pembayar" name="top_nama_bayar" placeholder="Masukan Atas Nama Pembayar" required value="{{ old('top_nama_bayar') }}">
                                    @if ($errors->has('top_nama_bayar'))
                                    <div class="text-danger">{{ $errors->first('top_nama_bayar') }}</div>
                                    @endif
                                </div>


                                <div class="mt-4">
                                    <button class="btn btn-danger w-100" type="submit">Daftar</button>
                                </div>
                            </form>
                        </div>


                    </div>
                    <!-- end col -->

                </div>
                <div class="row">


                </div>

            </div>
            <!-- end container -->
        </section>
        <!-- end tryout -->

        <footer class="  py-5 position-relative" style="background-color: #e2b602;">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 mt-4">
                        <div>
                            <div>
                                <img src="{{URL::asset('assets/images/logo-cendikia.png')}}" alt="logo light" height="40" />
                            </div>
                            <div class="mt-4 fs-13">
                                <p>Selamat datang di LBB Cendekia!</p>
                                <p>Lembaga Bimbingan Belajar Cendekia, Bimbel yang melayani kebutuhan belajar kurikulum Merdeka & kurikulum 13 (K13), serta mengembangkan tipe-tipe soal menuju sukses assesmen daerah.Menekankan penguasaan konsep dan juga cara praktis dalam penyelesaian soal.
                                    Dibimbing oleh tentor senior yang sudah berpengalaman dalam menulis soal ujian nasional mulai dari tingkat provinsi sampaidengan nasional..</p>
                                <ul class="list-inline mb-0 footer-social-link">
                                    <li class="list-inline-item">
                                        <a href="javascript: void(0);" class="avatar-xs d-block">
                                            <div class="avatar-title rounded-circle">
                                                <i class="ri-facebook-fill"></i>
                                            </div>
                                        </a>
                                    </li>

                                    <li class="list-inline-item">
                                        <a href="javascript: void(0);" class="avatar-xs d-block">
                                            <div class="avatar-title rounded-circle">
                                                <i class="ri-instagram-line"></i>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-7 ms-lg-auto">
                        <div class="row">
                            <div class="col-sm-4 mt-4">
                                <h5 class="text-white mb-0">HUBUNGI KAMI</h5>
                                <div class="text-white mt-3">
                                    <ul class="list-unstyled ff-secondary footer-list">
                                        <li><strong>Telfon / WhatsApp :</strong>

                                        </li>
                                        <li><strong><a href="https://bit.ly/WA-CENDEKIA-LIA" class="text-white">Kak Lia : 081272139500&nbsp;</a></strong></li>
                                        <li> <strong><a href="https://bit.ly/WA-CENDEKIA-YENI" class="text-white">Kak Yeni : 082323356415</a></strong></li>
                                    </ul>
                                </div>
                                <hr>

                            </div>
                            <div class="col-sm-4 mt-4">
                                <h5 class="text-white mb-0">Jam Kerja</h5>
                                <div class="text-white mt-3">
                                    <ul class="list-unstyled ff-secondary footer-list">

                                        <li>Senin - Jumat : 09.00 - 20.00</li>
                                        <li>Sabtu : 09.00 - 17.00</li>
                                        <li>Ahad : Libur</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-sm-4 mt-4">
                                <h5 class="text-white mb-0">Alamat</h5>
                                <div class="text-muted mt-3">
                                    <ul class="list-unstyled ff-secondary footer-list">
                                        <li class="text-white">Barat Gedung SMPN 9 Yogyakarta</li>

                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="row text-center text-sm-start align-items-center mt-5">
                    <div class="col-sm-6">
                        <div>
                            <p class="copy-rights mb-0">
                                <script>
                                    document.write(new Date().getFullYear())
                                </script> © LBB Cendekia
                            </p>
                        </div>
                    </div>
                    {{-- <div class="col-sm-6">
                        <div class="text-sm-end mt-3 mt-sm-0">
                            <ul class="list-inline mb-0 footer-list gap-4 fs-13">
                                <li class="list-inline-item">
                                    <a href="pages-privacy-policy">Privacy Policy</a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="pages-term-conditions">Terms & Conditions</a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="pages-privacy-policy">Security</a>
                                </li>
                            </ul>
                        </div>
                    </div>--}}
                </div>
            </div>
        </footer>
        <!-- end footer -->

        <!--start back-to-top-->
        <button onclick="topFunction()" class="btn btn-warning btn-icon landing-back-top" id="back-to-top">
            <i class="ri-arrow-up-line"></i>
        </button>
        <!--end back-to-top-->

    </div>
    <!-- end layout wrapper -->
</body>

@endsection
@section('script')
<script src="{{ URL::asset('assets/libs/swiper/swiper.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/pages/job-lading.init.js') }}"></script>
<script src="{{ URL::asset('assets/libs/@simonwep/pickr/pickr.min.js') }}"></script>

<!-- init js -->
<script src="{{ URL::asset('assets/js/pages/form-pickers.init.js') }}"></script>
<script>
    $('#asal_sekolah').select2({
        placeholder: "Cari Asal Sekolah",
        allowClear: true,
        tags: true,
        minimumInputLength: 1,
        ajax: {
            url: '<?= route('ajax.cari-sekolah') ?>',
            dataType: 'json',
            delay: 250,
            data: function(params) {
                return {
                    q: params.term // search term
                };
            },
            processResults: function(data) {
                return {
                    results: data
                };
            },
            cache: true
        },

    });
     
</script>
@endsection