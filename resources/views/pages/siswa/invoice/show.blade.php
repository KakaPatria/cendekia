@extends('layouts.siswa.master')
@section('title') Invoice @endsection
@section('css')
<link rel="stylesheet" href="{{ URL::asset('assets/libs/glightbox/glightbox.min.css') }}">
@endsection
@section('content')
@component('components.breadcrumb')
@slot('li_1') Invoice @endslot
@slot('title') Detail Invoice @endslot
@endcomponent

@include('components.message')
<div class="row justify-content-center">
    <div class="col-xxl-9">
        <div class="card" id="demo">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card-header border-bottom-dashed p-4">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <img src="{{ URL::asset('assets/images/logo-cendikia.png') }}" class="card-logo card-logo-dark" alt="logo dark" height="40">
                                <img src="{{ URL::asset('assets/images/logo-cendikia.png') }}" class="card-logo card-logo-light" alt="logo light" height="40">

                            </div>
                            <div class="flex-shrink-0 mt-sm-0 mt-3">
                                <div class="mt-sm-5 mt-4">
                                    <h6 class="text-muted text-uppercase fw-semibold">Address</h6>
                                    <p class="text-muted mb-1" id="address-details">California, United States</p>
                                    <p class="text-muted mb-0" id="zip-code"><span>Zip-code:</span> 90201</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end card-header-->
                </div>
                <!--end col-->
                <div class="col-lg-12">
                    <div class="card-body p-4">
                        <div class="row g-3">
                            <div class="col-lg-3 col-6">
                                <p class="text-muted mb-2 text-uppercase fw-semibold">Invoice No</p>
                                <h5 class="fs-14 mb-0">#VL<span id="invoice-no">{{ $inv->inv_id}}</span></h5>
                            </div>
                            <!--end col-->
                            <div class="col-lg-2 col-6">
                                <p class="text-muted mb-2 text-uppercase fw-semibold">Tanggal</p>
                                <h5 class="fs-14 mb-0"><span id="invoice-date">{{ $inv->inv_date_format}}</span> </h5>
                            </div>
                            <div class="col-lg-2 col-6">
                                <p class="text-muted mb-2 text-uppercase fw-semibold">Expired</p>
                                <h5 class="fs-14 mb-0"><span id="invoice-date">{{ $inv->due_date_format}}</span> </h5>
                            </div>
                            <!--end col-->
                            <div class="col-lg-2 col-6">
                                <p class="text-muted mb-2 text-uppercase fw-semibold"> Status Invoice</p> 
                                {!! $inv->status_badge !!}

                            </div>
                            <!--end col-->
                            <div class="col-lg-3 col-6">
                                <p class="text-muted mb-2 text-uppercase fw-semibold">Total</p>
                                <h5 class="fs-14 mb-0">Rp. <span id="total-amount">{{ $inv->amount_rp }}</span></h5>
                            </div>
                            <!--end col-->
                        </div>
                        <!--end row-->
                    </div>
                    <!--end card-body-->
                </div>
                <!--end col-->
                <div class="col-lg-12">
                    <div class="card-body p-4 border-top border-top-dashed">
                        <div class="row g-3">
                            <div class="col-6">
                                <h6 class="text-muted text-uppercase fw-semibold mb-3">Alamat Tagih</h6>
                                <p class="fw-medium mb-2" id="billing-name">{{ $inv->peserta->tryout_peserta_name}}</p>
                                <p class="text-muted mb-1" id="billing-address-line-1">{{ $inv->peserta->tryout_peserta_alamat}}</p>
                                <p class="text-muted mb-1"><span>Phone: +</span><span id="billing-phone-no">{{ $inv->peserta->tryout_peserta_telepon}}</span></p>
                                <p class="text-muted mb-0"><span>Tax: </span><span id="billing-tax-no">{{ $inv->peserta->tryout_peserta_email}} </span> </p>
                            </div>
                             
                        </div>
                        <!--end row-->
                    </div>
                    <!--end card-body-->
                </div>
                <!--end col-->
                <div class="col-lg-12">
                    <div class="card-body p-4">
                        <div class="table-responsive">
                            <table class="table table-borderless text-center table-nowrap align-middle mb-0">
                                <thead>
                                    <tr class="table-active">
                                        <th scope="col" style="width: 50px;">#</th>
                                        <th scope="col">Detail</th> 
                                        <th scope="col" class="text-end">Nominal</th>
                                    </tr>
                                </thead>
                                <tbody id="products-list">
                                    <tr>
                                        <th scope="row">01</th>
                                        <td class="text-start">
                                            <span class="fw-medium">{{ $inv->keterangan}}</span>
                                            
                                        </td> 
                                        <td class="text-end">Rp. {{ $inv->amount_rp }}</td>
                                    </tr>
                                     
                                </tbody>
                            </table>
                            <!--end table-->
                        </div>
                        <div class="border-top border-top-dashed mt-2">
                            <table class="table table-borderless table-nowrap align-middle mb-0 ms-auto" style="width:250px">
                                <tbody>
                                     
                                    <tr class="border-top border-top-dashed fs-15">
                                        <th scope="row">Total</th>
                                        <th class="text-end">Rp. {{ $inv->amount_rp}}</th>
                                    </tr>
                                </tbody>
                            </table>
                            </table>
                            <!--end table-->
                        </div>
                        <div class="mt-3">
                            <h6 class="text-muted text-uppercase fw-semibold mb-3">Silahkan melakukan pembayaran  ke rekening berikut :</h6>
                            <p class="text-muted mb-1">Atas Nama: <span class="fw-medium" id="payment-method">LBB Cendikia</span></p>
                            <p class="text-muted mb-1">BANK: <span class="fw-medium" id="card-holder-name">BCA</span></p>
                            <p class="text-muted mb-1">Nomor Rekening: <span class="fw-medium" id="card-holder-name">9867112</span></p>
                            
                            <p class="text-muted">Sejumlah: <span class="fw-medium" id="">Rp </span><span id="card-total-amount">{{ $inv->amount_rp}}</span></p>
                        </div>
                        <div class="mt-4">
                            <div class="alert alert-info">
                                <p class="mb-0"><span class="fw-semibold">NOTES:</span>
                                    <span id="note">Mohon untuk konfirmasi apabila sudah melakukan pembayaran, hubungi nomor berikut <a href="https://wa.me/c/6281272139500">6281272139500</a>
                                    </span>
                                </p>
                            </div>
                        </div>
                        <div class="hstack gap-2 justify-content-end d-print-none mt-4">
                            <a href="javascript:window.print()" class="btn btn-success"><i class="ri-printer-line align-bottom me-1"></i> Print</a>
                            <a href="javascript:void(0);" class="btn btn-primary"><i class="ri-download-2-line align-bottom me-1"></i> Download</a>
                        </div>
                    </div>
                    <!--end card-body-->
                </div>
                <!--end col-->
            </div>
            <!--end row-->
        </div>
        <!--end card-->
    </div>
    <!--end col-->
</div>
<!--end row-->
@endsection
@section('script')
<script src="{{ URL::asset('/assets/js/pages/invoicedetails.js') }}"></script>
<script src="{{ URL::asset('/assets/js/app.min.js') }}"></script>

<script>
    $('#nav-tryout').addClass('active')
</script>
@endsection