@extends('layouts.siswa.master')
@section('title') Dashboard @endsection
@section('css')
<link href="{{ URL::asset('assets/libs/jsvectormap/jsvectormap.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('assets/libs/swiper/swiper.min.css')}}" rel="stylesheet" type="text/css" />
@endsection
@section('content')

@include('components.message')



<div class="row">
    <div class="col">

        <div class="h-100">
            <div class="row mb-3 pb-1">
                <div class="col-12">
                    <div class="d-flex align-items-lg-center flex-lg-row flex-column">
                        <div class="flex-grow-1">
                            <h4 class="fs-16 mb-1">Welcome {{ Auth::user()->name}}!</h4>

                        </div>

                    </div><!-- end card header -->
                </div>
                <!--end col-->
            </div>
            <!--end row-->
            <div class="text-center mb-5">
                <h3 class="mb-3 fw-semibold">Pilih Tryout Sesuai Kebutuhan Anda</h3>
                <p class="text-muted mb-4">Kami rekomendasikan tryout yang paling sesuai.</p>
            </div>
            <div class="row">
                @forelse($tryout as $data)
                <div class="col-lg-4 product-item artwork crypto-card 3d-style ribbon-box ribbon-fill " style="display: block;">
                    <div class="card  explore-box card-animate " style="{{ $data->is_can_register ? 'opacity: 0.5;pointer-events: none;' : '' }}">
                        <div class="bookmark-icon position-absolute top-0 end-0 p-2">
                            <button type="button" class="btn btn-icon active" data-bs-toggle="button" aria-pressed="true"><i class="mdi mdi-cards-heart fs-16"></i></button>
                        </div>
                        <div class="explore-place-bid-img">
                            <img src="{{Storage::url($data->tryout_banner)}}" alt="" class="card-img-top explore-img">
                            <div class="bg-overlay"></div>
                            <div class="place-bid-btn">
                                <a href="#!" class="btn btn-success"><i class="ri-auction-fill align-bottom me-1"></i> Daftar</a>
                            </div>
                        </div>
                        <div class="card-body   ">
                            @if($data->is_gratis)
                            <div class="ribbon ribbon-primary"><span>Gratis</span></div>
                            @endif
                            @if($data->is_can_register)
                            <div class="ribbon ribbon-danger ribbon-shape">Selesai</div>
                            @endif

                            <p class="fw-medium mb-0 float-end"><i class="mdi mdi-heart text-danger align-middle"></i> 10 </p>
                            <h5 class="mb-1"><a href="apps-nft-item-details.html">{{ $data->tryout_judul}}</a></h5>
                            <div class="hstack flex-wrap gap-2 fs-16">
                                @foreach($data->materi as $materi)
                                <div class="badge fw-medium badge-soft-info">{{ $materi->refMateri->ref_materi_judul}}</div>
                                @endforeach
                            </div>
                        </div>
                        <div class="card-footer border-top border-top-dashed">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1 fs-14">
                                    <i class="ri-price-tag-3-fill text-warning align-bottom me-1"></i> Terdaftar: <span class="fw-medium">10 Orang</span>
                                </div>

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
@endsection