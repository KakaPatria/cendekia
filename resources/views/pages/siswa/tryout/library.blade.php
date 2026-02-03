@extends('layouts.siswa.master')
@section('title') Perpustakaan @endsection
@section('css')
<link href="{{ URL::asset('assets/libs/jsvectormap/jsvectormap.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('assets/libs/swiper/swiper.min.css')}}" rel="stylesheet" type="text/css" />
@endsection
@section('content')

@include('components.message')



<div class="row">
    <div class="col-xl-3 col-lg-4 d-none">
        <div class="card">
            <div class="card-header">
                <div class="d-flex">
                    <div class="flex-grow-1">
                        <h5 class="fs-16">Filters</h5>
                    </div>
                    <div class="flex-shrink-0">
                        <a href="{{ route('siswa.tryout.library')}}" class="text-decoration-underline" id="clearall">Hapus Filter</a>
                    </div>
                </div>
            </div>

            <div class="accordion accordion-flush filter-accordion">
                <form action="{{route('siswa.tryout.library')}}" method="get" id="filter-form">
                    <input type="hidden" name="filter" value="1">
                    <input type="hidden" name="jenjang" value="{{ request('jenjang')}}">
                    <div class="card-body border-bottom">

                        <div>
                            <p class="text-muted text-uppercase fs-12 fw-medium mb-2">Jenjang</p>
                            <ul class="list-unstyled mb-0 filter-list">
                                <li>
                                    <a href="?filter=1&jenjang=SD" class="d-flex py-1 align-items-center {{request('jenjang')== 'SD'? 'active': ''}}">
                                        <div class="flex-grow-1">
                                            <h5 class="fs-13 mb-0 listname">SD</h5>
                                        </div>
                                        @if(isset($tryout_all['SD']))
                                        <div class="flex-shrink-0 ms-2">
                                            <span class="badge bg-light text-muted">{{ count($tryout_all['SD'])}}</span>
                                        </div>
                                        @endif
                                    </a>
                                </li>
                                <li>
                                    <a href="?filter=1&jenjang=SMP" class="d-flex py-1 align-items-center {{request('jenjang')== 'SMP'? 'active': ''}}">
                                        <div class="flex-grow-1">
                                            <h5 class="fs-13 mb-0 listname">SMP</h5>
                                        </div>
                                        @if(isset($tryout_all['SMP']))
                                        <div class="flex-shrink-0 ms-2">
                                            <span class="badge bg-light text-muted">{{ count($tryout_all['SMP'])}}</span>
                                        </div>
                                        @endif
                                    </a>
                                </li>
                                <li>
                                    <a href="?filter=1&jenjang=SMA" class="d-flex py-1 align-items-center {{request('jenjang')== 'SMA'? 'active': ''}}">
                                        <div class="flex-grow-1">
                                            <h5 class="fs-13 mb-0 listname">SMA</h5>
                                        </div>
                                        @if(isset($tryout_all['SMA']))
                                        <div class="flex-shrink-0 ms-2">
                                            <span class="badge bg-light text-muted">{{ count($tryout_all['SMA'])}}</span>
                                        </div>
                                        @endif
                                    </a>
                                </li>

                            </ul>
                        </div>
                    </div>
                    @if(request('jenjang'))
                    <div class="accordion-item mt-2">
                        <div id="flush-collapseBrands" class="accordion-collapse collapse show" aria-labelledby="flush-headingBrands">
                            <div class="accordion-body text-body pt-0">
                                <div class="search-box search-box-sm">
                                    <input type="text" class="form-control bg-light border-0" id="searchBrandsList" name="q" placeholder="Cari Materi..." value="{{ request('q')}}">
                                    <i class="ri-search-line search-icon"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    @php
                    $selectedClasses = request()->input('kelas', []);
                    $selectedJenis = request()->input('jenis', []);
                    @endphp
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-headingDiscount">
                            <button class="accordion-button bg-transparent shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseDiscount" aria-expanded="true" aria-controls="flush-collapseDiscount">
                                <span class="text-muted text-uppercase fs-12 fw-medium">Kelas</span> <span class="badge bg-success rounded-pill align-middle ms-1 filter-badge" style="display: none;">0</span>
                            </button>
                        </h2>
                        <div id="flush-collapseDiscount" class="accordion-collapse collapse show" aria-labelledby="flush-headingDiscount" style="">
                            <div class="accordion-body text-body pt-1">
                                <div class="d-flex flex-column gap-2 filter-check">
                                    @if(request('jenjang')== 'SD')
                                    <div class="input-kelas-sd">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="1" id="input-kelas-1" name="kelas[]" {{ in_array('1', $selectedClasses) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="input-kelas-1">1</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="2" id="input-kelas-2" name="kelas[]" {{ in_array(2, $selectedClasses) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="input-kelas-2">2</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="3" id="input-kelas-3" name="kelas[]" {{ in_array('3', $selectedClasses) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="input-kelas-3">3</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="4" id="input-kelas-4" name="kelas[]" {{ in_array('4', $selectedClasses) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="input-kelas-4">4</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="5" id="input-kelas-5" name="kelas[]" {{ in_array('5', $selectedClasses) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="input-kelas-5">5</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="6" id="input-kelas-6" name="kelas[]" {{ in_array('6', $selectedClasses) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="input-kelas-6">6</label>
                                        </div>
                                    </div>
                                    @endif
                                    @if(request('jenjang')== 'SMP')
                                    <div class="input-kelas-smp">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="7" id="input-kelas-7" name="kelas[]" {{ in_array('7', $selectedClasses) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="input-kelas-7">7</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="8" id="input-kelas-8" name="kelas[]" {{ in_array('8', $selectedClasses) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="input-kelas-8">8</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="9" id="input-kelas-9" name="kelas[]" {{ in_array('9', $selectedClasses) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="input-kelas-9">9</label>
                                        </div>
                                    </div>
                                    @endif
                                    @if(request('jenjang')== 'SMA')
                                    <div class="input-kelas-sma">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="10" id="input-kelas-10" name="kelas[]" {{ in_array('10', $selectedClasses) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="input-kelas-10">10</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="11" id="input-kelas-11" name="kelas[]" {{ in_array('11', $selectedClasses) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="input-kelas-11">11</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="12" id="input-kelas-12" name="kelas[]" {{ in_array('12', $selectedClasses) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="input-kelas-12">12</label>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end accordion-item -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-headingDiscount">
                            <button class="accordion-button bg-transparent shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseDiscount" aria-expanded="true" aria-controls="flush-collapseDiscount">
                                <span class="text-muted text-uppercase fs-12 fw-medium">Jenis Tryout</span> <span class="badge bg-success rounded-pill align-middle ms-1 filter-badge" style="display: none;">0</span>
                            </button>
                        </h2>
                        <div id="flush-collapseDiscount" class="accordion-collapse collapse show" aria-labelledby="flush-headingDiscount" style="">
                            <div class="accordion-body text-body pt-1">
                                <div class="d-flex flex-column gap-2 filter-check">
                                    <div class="input-jenis-tryout">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="Gratis" id="input-gratis" name="jenis[]" {{ in_array('Gratis', $selectedJenis) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="input-gratis">Gratis</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="Berbayar" id="input-berbayar" name="jenis[]" {{ in_array('Berbayar', $selectedJenis) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="input-berbayar">Berbayar</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

                </form>
            </div>
        </div>
    </div>
    <div class="col-xl-9 col-lg-8">
        <div class="h-100">

            <div class="d-flex align-items-center mb-2">
                <h2 class="mb-0 fw-semibold lh-base flex-grow-1">{{ $title }}</h2>
            </div>
            <div class="row">
                @forelse($data_tryout as $data)
                <div class="col-lg-4 product-item artwork crypto-card 3d-style ribbon-box ribbon-fill right">
                    <div class="card explore-box card-animate h-100">
                        <div class="explore-place-bid-img">
                            @if($data->tryout_banner)
                            <img src="{{ asset('storage/' . $data->tryout_banner) }}" alt="{{ $data->tryout_judul }}" class="card-img-top explore-img" />
                            @else
                            <img src="{{ asset('assets/images/placeholder-tryout.jpg') }}" alt="{{ $data->tryout_judul }}" class="card-img-top explore-img" />
                            @endif
                        </div>
                        @if(!$data->is_gratis)
                        <div class="ribbon ribbon-primary"><span>Gratis</span></div>
                        @endif

                        <div class="card-body">
                            <h5 class="mb-1"><a href="{{ route('siswa.tryout.show',$data->tryout_id)}}">{{ $data->tryout_judul}}</a></h5>
                            <ul class="list-inline mb-2">
                                <li class="list-inline-item"><i class="ri-user-3-fill text-success align-middle me-1"></i> {{ $data->tryout_jenjang}} kelas {{ $data->tryout_kelas}}</li>
                                <li class="list-inline-item"><i class="ri-calendar-2-fill text-success align-middle me-1"></i> Daftar Sebelum {{ $data->tryout_register_due}}</li>
                            </ul>
                            <ul class="list-inline mb-2">
                                @foreach($data->materi as $materi)
                                <li class="list-inline-item"><span class="badge badge-soft-success fs-12">{{$materi->refMateri->ref_materi_judul}}</span></li>

                                @endforeach
                            </ul>
                        </div>
                        <div class="card-footer border-top border-top-dashed">
                            @if($data->is_gratis)

                            <div class="d-flex align-items-center mb-3">
                                <div class="flex-grow-1">
                                    @if($data->tryout_diskon)
                                    <h4 class="mb-0 fw-semibold"> <span class="badge text-bg-danger">{{ $data->tryout_diskon}}%</span>&nbsp;<del class="text-muted">Rp.{{$data->tryout_nominal}}</del></h4>


                                    @endif
                                </div>
                                <div class="ms-auto">
                                    <h4 class="mb-0 fw-semibold">Rp.{{$data->tryout_harga_jual_formatted}}</h4>

                                </div>
                            </div>
                            @endif
                            <div class="mt-4">
                                <a href="{{ route('siswa.tryout.show',$data->tryout_id)}}" class="btn btn-warning w-100 text-bold">Selengkapnya</a>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="alert alert-danger">
                    Tryout belum tersedia untuk anda
                </div>
                @endforelse
            </div>


        </div> <!-- end .h-100-->
    </div> <!-- end col -->
</div>


@endsection
@section('script')
<!-- apexcharts -->
<script src="{{ URL::asset('/assets/js/app.min.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Mengatur tindakan saat tautan jenjang diklik
        $('.form-check-input').click(function(e) {
            $('#filter-form').submit()
        });
    });
</script>

@endsection